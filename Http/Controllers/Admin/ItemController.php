<?php

namespace Modules\Warehouse\Http\Controllers\Admin;

use Auth;
use Carbon\Carbon;
use Excel;
use Exporter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Media\Repositories\FileRepository;
use Modules\Notification\Services\Notification;
use Modules\Warehouse\Entities\Item;
use Modules\Warehouse\Entities\ItemStatus;
use Modules\Warehouse\Entities\Settings;
use Modules\Warehouse\Entities\Warehouse;
use Modules\Warehouse\Entities\Zebra;
use Modules\Warehouse\Http\Requests\CreateItemRequest;
use Modules\Warehouse\Http\Requests\ImportRequest;
use Modules\Warehouse\Http\Requests\UpdateItemRequest;
use Modules\Warehouse\Repositories\ItemRepository;
use Yajra\DataTables\Datatables;
use Yajra\DataTables\Html\Builder;

class ItemController extends AdminBaseController
{
    /**
     * @var ItemRepository
     */
    private $item;

    private $notification;

    private $base;


    public function __construct(ItemRepository $item,Notification $notification)
    {
        $warehouse = 0;
        parent::__construct();
        $this->item = $item;
        $this->notification = $notification;        
        if (null !== \Route::current()->parameter('warehouse')) {
            $warehouse = \Route::current()->parameter('warehouse');
            $this->base['route'] = route('admin.warehouse.item.index', $warehouse);
        }
        $this->base['filters'] = [
                        [
                        'name' => 'material_number',
                        'type' => 'select2_ajax',
                        'view' => 'base::filters.select2_ajax',
                        'values' => route('api.warehouse.item', $warehouse),
                        'label' => trans('warehouse::items.table.material_number'),
                        'currentValue' => null,
                        'placeholder' => trans('warehouse::items.table.material_number'),
                        ],
                        [
                            //route('api.warehouse.item', $warehouse),
                        'name' => 'name',
                        'type' => 'select2_ajax',
                        'view' => 'base::filters.select2_ajax',
                        'values' => route('api.warehouse.item', $warehouse),
                        'label' => trans('warehouse::items.table.name'),
                        'currentValue' => null,
                        'placeholder' => trans('warehouse::items.table.name'),
                        ],
                        [
                        'name' => 'local_name',
                        'type' => 'select2_ajax',
                        'view' => 'base::filters.select2_ajax',
                        'values' => route('api.warehouse.item', $warehouse),
                        'label' => trans('warehouse::items.table.local_name'),
                        'currentValue' => null,
                        'placeholder' => trans('warehouse::items.table.local_name'),
                        ],
                        [
                        'name' => 'specification',
                        'type' => 'select2_ajax',
                        'view' => 'base::filters.select2_ajax',
                        'values' => route('api.warehouse.item', $warehouse),
                        'label' => trans('warehouse::items.table.specification'),
                        'currentValue' => null,
                         'placeholder' => trans('warehouse::items.table.specification'),
                        ],
                        [
                        'name' => 'order_number',
                        'type' => 'select2_ajax',
                        'view' => 'base::filters.select2_ajax',
                        'values' => route('api.warehouse.item', $warehouse),
                        'label' => trans('warehouse::items.table.order_number'),
                        'currentValue' => null,
                        'placeholder' => trans('warehouse::items.table.order_number'),
                        ],
                        [
                        'name' => 'storage_position',
                        'type' => 'select2_ajax',
                        'view' => 'base::filters.select2_ajax',
                        'values' => route('api.warehouse.item', $warehouse),
                        'label' => trans('warehouse::items.table.storage_position'),
                        'currentValue' => null,
                        'placeholder' => trans('warehouse::items.table.storage_position'),
                        ],
                        [
                        'name' => 'manufacture',
                        'type' => 'select2_ajax',
                        'view' => 'base::filters.select2_ajax',
                        'label' => trans('warehouse::items.table.manufacture'),
                        'currentValue' => null,
                        'values' => route('api.warehouse.item', $warehouse),
                        'placeholder' => trans('warehouse::items.table.manufacture'),
                        ],
                        [
                        'name' => 'supplier',
                        'type' => 'select2_ajax',
                        'view' => 'base::filters.select2_ajax',
                        'label' => trans('warehouse::items.table.supplier'),
                        'currentValue' => null,
                        'values' => route('api.warehouse.item', $warehouse),
                        // 'values' => Item::pluck('supplier','supplier')->unique()->toArray(),
                        'placeholder' => trans('warehouse::items.table.supplier'),
                        ],
                                     
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Warehouse $warehouse, Builder $builder, Request $request)
    {

        $initComplete = "function () {}";
        $printerList = $warehouse->zebra()->get();

        // dd($printerList);
        if (isset($settings->item_footer_search) && $settings->item_footer_search == true) {
            $initComplete = "function () {
                                this.api().columns().every(function () {
                                    var column = this;             
                                    var input = document.createElement(\"input\");
                                    $(input).appendTo($(column.footer()).empty())
                                    .on('change', function () {
                                        column.search($(this).val(), false, false, true).draw();
                                    });
                                });
                            }";
        }

        if (request()->ajax()) {
            return DataTables::of(Item::query()->with(['files','status']))
                    ->editColumn('url', 'warehouse::admin.items.columns.url')
                    ->editColumn('photo', 'warehouse::admin.items.columns.image')
                    ->editColumn('action', function (Item $item) use($printerList)
                    {
                        return view('warehouse::admin.items.columns.action', compact('printerList','item'));
                    })
                    ->addColumn('status', function (Item $item)
                    {
                        return view('warehouse::admin.items.columns.itemstatus', compact('item'));
                    })
                    ->rawColumns(['url', 'photo', 'action', 'remarks', 'status', 'suppliers'])
                    ->filter(function ($query) use ($request) {
                        if ($name = $request->get('material_number')) {
                           $query->where('material_number', 'like', "%$name%");
                        }
                        if ($name = $request->get('name')) {
                           $query->where('name', 'like', "%$name%");
                        }
                        if ($name = $request->get('local_name')) {
                           $query->where('local_name', 'like', "%$name%");
                        }
                        if ($name = $request->get('specification')) {
                           $query->where('specification', 'like', "%$name%");
                        }
                        if ($name = $request->get('order_number')) {
                           $query->where('order_number', 'like', "%$name%");
                        }
                        if ($name = $request->get('storage_position')) {
                           $query->where('storage_position', 'like', "%$name%");
                        }
                        if ($name = $request->get('manufacture')) {
                           $query->where('manufacture', 'like', "%$name%");
                        }
                        if ($name = $request->get('supplier')) {
                           $query->where('supplier', 'like', "%$name%");
                        }
                    },true)
                    ->toJson();
        }

        $html = $builder->columns($this->item->getCollumns($warehouse))
                        ->parameters([
                                    'paging' => true,
                                    'searching' => true,
                                    'info' => false,
                                    'searchDelay' => '400',
                                    'language' => [
                                        'url' => asset("modules/core/js/vendor/datatables/".locale().".json")
                                        ],
                                    'initComplete' => $initComplete,
                                    ]);
        $base = $this->base;
        // dd($base);

        return view('warehouse::admin.items.index', compact(['html', 'warehouse', 'settings', 'base']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($warehouse)
    {
        $status = ItemStatus::pluck('title', 'id')->all();
        $number = Item::select('material_number')->where('material_number','like','S%')->get()->max();
        return view('warehouse::admin.items.create', compact('warehouse','number','status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateItemRequest $request
     * @return Response
     */
    public function store(Warehouse $warehouse, CreateItemRequest $request)
    {
        $status = $request->status;
        if (!$status[0]) {
            unset($status[0]);
        }
        $saved = $warehouse->item()->create($request->all());
        $saved->status()->sync($status);

        return redirect()->route('admin.warehouse.item.index', $warehouse)
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('warehouse::items.title.items')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Item $item
     * @return Response
     */
    public function edit($warehouse, Item $item)
    {
        $status = ItemStatus::pluck('title', 'id')->all();
        return view('warehouse::admin.items.edit', compact(['item', 'warehouse', 'status']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Item $item
     * @param  UpdateItemRequest $request
     * @return Response
     */
    public function update($warehouse, Item $item, UpdateItemRequest $request)
    {
        $status = $request->status;
        if (!$status[0]) {
            unset($status[0]);
        }
        
        // dd($status);
        $saved = $this->item->update($item, $request->all());
        $saved->status()->sync($status);

        return redirect()->route('admin.warehouse.item.index', $warehouse)
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('warehouse::items.title.items')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Item $item
     * @return Response
     */
    public function destroy($warehouse, Item $item)
    {
        $this->item->destroy($item);

        return redirect()->route('admin.warehouse.item.index', $warehouse)
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('warehouse::items.title.items')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Item $item
     * @return Response
     */
    public function import(Warehouse $warehouse,ImportRequest $request)
    {
        if ($request->hasFile('import')) {

            // ini_set("memory_limit","7G");
            // ini_set('max_execution_time', '0');
            // ini_set('max_input_time', '0');
            // ini_set('set_time_limit',0);
            // set_time_limit(0);

            if ($warehouse->item()->count()>0) {
                $warehouse->item()->delete();
            }
            ignore_user_abort(true);

            $file = $request->file('import');
            $name =$file->getClientOriginalName();
            $path = $file->storeAs('import', $name, 'public');
            $xls = storage_path('app/public/'.$path);

            $import = Excel::filter('chunk')->load($xls)->chunk(300, function ($results) use ($warehouse) {
                foreach ($results as $row) {
                    if ($row->material_number) {
                        $warehouse->item()->save(new Item($row->toArray()));
                    }
                }
            });
            
            return redirect()->route('admin.warehouse.item.index', $warehouse)
            ->withSuccess(trans('warehouse::items.messages.resource import', ['name' => trans('warehouse::items.title.items')]));
        }

        return redirect()->route('admin.warehouse.item.index', $warehouse)
            ->withError(trans('warehouse::items.messages.resource import nok', ['name' => trans('warehouse::items.title.items')]));
    }

    public function export(Warehouse $warehouse)        
    {
        $file = 'export/items/items-'.str_slug($warehouse->name).'-'.Carbon::now()->format('ymd-Hi').'.xlsx';
        $query = DB::table('warehouse__items')->where('warehouse_id',$warehouse->id);
        $excel = Exporter::make('Excel');
        $excel->loadQuery($query);
        $excel->setChunk(1000);
        $excel->save($file);
        $this->notification->to(Auth::user()->id)->push('Export items complete', 'Download Here', 'fa fa-hand-peace-o text-green', url($file));
        return redirect()->route('admin.warehouse.item.index', $warehouse);
    } 

    public function print(Warehouse $warehouse, Request $request)
    {
        $printer= $warehouse->zebra()->findOrFail($request->printer_id);
        $item = $warehouse->item()->findOrFail($request->item_id);
        for($i=0; $i < $request->num; $i++) {
            $printer->print($item);
        }
        return redirect()->back();
    }
}
