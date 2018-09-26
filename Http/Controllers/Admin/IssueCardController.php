<?php

namespace Modules\Warehouse\Http\Controllers\Admin;

use Auth;
use Carbon\Carbon;
use Excel;
use Exporter;
use Storage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Notification\Services\Notification;
use Modules\Warehouse\Entities\CostCenter;
use Modules\Warehouse\Entities\IssueCard;
use Modules\Warehouse\Entities\Item;
use Modules\Warehouse\Entities\MachinePart;
use Modules\Warehouse\Entities\Warehouse;
use Modules\Warehouse\Serialiser\IssueCardSerialiser;
use Modules\Warehouse\Http\Requests\CreateIssueCardRequest;
use Modules\Warehouse\Http\Requests\UpdateIssueCardRequest;
use Modules\Warehouse\Repositories\IssueCardRepository;
use Yajra\DataTables\Datatables;
use Yajra\DataTables\Html\Builder;
use Illuminate\Support\Facades\DB;

class IssueCardController extends AdminBaseController
{
    /**
     * @var IssueCardRepository
     */
    private $issuecard;

    private $notification;

    private $settings;

    protected $base;

    public function __construct(IssueCardRepository $issuecard, Notification $notification)
    {
        parent::__construct();
        $this->issuecard = $issuecard;
        $this->notification = $notification;

        if (null !== \Route::current()->parameter('warehouse')) {
            $warehouse = \Route::current()->parameter('warehouse');
            $this->base['route'] = route('admin.warehouse.issuecard.index', $warehouse);
        }
        $this->base['filters'] = [
                        [
                        'name' => 'material_number',
                        'type' => 'select2_ajax',
                        'view' => 'base::filters.select2_ajax',
                        'values' => route('api.warehouse.issuecard', $warehouse),
                        'label' => trans('warehouse::items.table.material_number'),
                        'currentValue' => null,
                        'placeholder' => trans('warehouse::items.table.material_number'),
                        ],
                        [
                        'name' => 'name',
                        'type' => 'select2_ajax',
                        'view' => 'base::filters.select2_ajax',
                        'values' => route('api.warehouse.issuecard', $warehouse),
                        'label' => trans('warehouse::items.table.name'),
                        'currentValue' => null,
                        'placeholder' => trans('warehouse::items.table.name'),
                        ],
                        [
                        'name' => 'local_name',
                        'type' => 'select2_ajax',
                        'view' => 'base::filters.select2_ajax',
                        'values' => route('api.warehouse.issuecard', $warehouse),
                        'label' => trans('warehouse::items.table.local_name'),
                        'currentValue' => null,
                        'placeholder' => trans('warehouse::items.table.local_name'),
                        ],
                        [
                        'name' => 'specification',
                        'type' => 'select2_ajax',
                        'view' => 'base::filters.select2_ajax',
                        'values' => route('api.warehouse.issuecard', $warehouse),
                        'label' => trans('warehouse::items.table.specification'),
                        'currentValue' => null,
                         'placeholder' => trans('warehouse::items.table.specification'),
                        ],
                        [
                        'name' => 'order_number',
                        'type' => 'select2_ajax',
                        'view' => 'base::filters.select2_ajax',
                        'values' => route('api.warehouse.issuecard', $warehouse),
                        'label' => trans('warehouse::items.table.order_number'),
                        'currentValue' => null,
                        'placeholder' => trans('warehouse::items.table.order_number'),
                        ],
                        [
                        'name' => 'user_full_name',
                        'type' => 'select2_ajax',
                        'view' => 'base::filters.select2_ajax',
                        'values' => route('api.warehouse.issuecard', $warehouse),
                        'label' => trans('warehouse::issuecards.form.user_full_name'),
                        'currentValue' => null,
                        'placeholder' => trans('warehouse::issuecards.form.user_full_name'),
                        ],
                        [
                        'name' => 'costcenter_id',
                        'type' => 'select2_ajax',
                        'view' => 'base::filters.select2_ajax',
                        'values' => route('api.warehouse.costcenter', $warehouse),
                        'label' => trans('warehouse::issuecards.form.costcenter'),
                        'currentValue' => null,
                        'placeholder' => trans('warehouse::issuecards.form.costcenter'),
                        ],
                        [
                        'name' => 'manufacture',
                        'type' => 'select2_ajax',
                        'view' => 'base::filters.select2_ajax',
                        'label' => trans('warehouse::items.table.manufacture'),
                        'currentValue' => null,
                        'values' => route('api.warehouse.issuecard', $warehouse),
                        'placeholder' => trans('warehouse::items.table.manufacture'),
                        ],
                        [
                        'name' => 'supplier',
                        'type' => 'select2_ajax',
                        'view' => 'base::filters.select2_ajax',
                        'label' => trans('warehouse::items.table.supplier'),
                        'currentValue' => null,
                        'values' => route('api.warehouse.issuecard', $warehouse),
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
    public function index(Warehouse $warehouse, Request $request, Builder $builder)
    {
        // dd($warehouse->issueCard()->where('exported','=','0')->get());
        $initComplete = "function () {}";


        $settings = $warehouse->settings;
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
            return DataTables::of(IssueCard::with('item.status')->selectRaw('distinct warehouse__issuecards.*'))
                    ->setRowClass(function ($issuecard) {
                        return $issuecard->quantity - $issuecard->issuing_volume > $issuecard->minimum ? '' : 'alert-error';
                    })
                    ->editColumn('url', 'warehouse::admin.items.columns.url')
                    ->editColumn('exported', 'warehouse::admin.issuecards.columns.exported')
                    ->editColumn('costcenter_id', function (IssueCard $issuecard) use ($warehouse) {
                        return view('warehouse::admin.issuecards.columns.costcenter')->with(['warehouse'=>$warehouse,'issuecard' => $issuecard]);
                    })
                    ->editColumn('machinepart_id', function (IssueCard $issuecard) use ($warehouse) {
                        return view('warehouse::admin.issuecards.columns.machinepart')->with(['warehouse'=>$warehouse,'issuecard' => $issuecard]);
                    })
                   
                    ->editColumn('action', 'warehouse::admin.issuecards.columns.action')
                    ->addColumn('status', function (IssueCard $issuecard){
                        $item = $issuecard->item;
                        return view('warehouse::admin.issuecards.columns.itemstatus')->with(['item' => $item]);
                    })
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
                        if ($name = $request->get('user_full_name')) {
                           $query->where('user_full_name', 'like', "%$name%");
                        }
                        if ($name = $request->get('manufacture')) {
                           $query->where('manufacture', 'like', "%$name%");
                        }
                        if ($name = $request->get('costcenter_id')) {
                           $query->where('costcenter_id', '=', $name);
                        }
                        if ($name = $request->get('supplier')) {
                           $query->where('supplier', 'like', "%$name%");
                        }
                    },true)
                    ->rawColumns(['url','action','exported','costcenter_id','status'])
                    ->toJson();
        }
        
        $html = $builder->columns($this->issuecard->getCollumns($warehouse))
                        ->parameters([
                                    'paging' => true,
                                    'searching' => true,
                                    'info' => false,
                                    'language' => [
                                        'url' => asset("modules/core/js/vendor/datatables/".locale().".json")
                                        ],
                                    'initComplete' => $initComplete,
                                    'order' => [0,'desc'],

                                    ]);
                        $base = $this->base;


        return view('warehouse::admin.issuecards.index', compact('warehouse', 'issuecards', 'html', 'base'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Warehouse $warehouse, Item $item)
    {
        $costcenters = CostCenter::listsTranslations('title')->where('warehouse_id', '=', $warehouse->id)->pluck('title', 'id')->toArray();
        $machineparts = MachinePart::listsTranslations('title')->where('warehouse_id', '=', $warehouse->id)->pluck('title', 'id')->toArray();

        return view('warehouse::admin.issuecards.create', compact('warehouse', 'item', 'costcenters', 'machineparts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateIssueCardRequest $request
     * @return Response
     */
    public function store(Warehouse $warehouse, CreateIssueCardRequest $request)
    {
        $item = $warehouse->item()->findOrFail($request->item_id);
        $item->quantity = $item->quantity - $request->issuing_volume;
        $item->save();
        $warehouse->issueCard()->create($request->all());

        return redirect()->route('admin.warehouse.item.index', $warehouse->id)
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('warehouse::issuecards.title.issuecards')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  IssueCard $issuecard
     * @return Response
     */
    public function edit(Warehouse $warehouse, IssueCard $issuecard)
    {
        $costcenters = CostCenter::listsTranslations('title')->where('warehouse_id', '=', $warehouse->id)->pluck('title', 'id')->toArray();
        $machineparts = MachinePart::listsTranslations('title')->where('warehouse_id', '=', $warehouse->id)->pluck('title', 'id')->toArray();
        $item = $issuecard->item;
        return view('warehouse::admin.issuecards.edit', compact('warehouse', 'issuecard', 'item', 'costcenters', 'machineparts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  IssueCard $issuecard
     * @param  UpdateIssueCardRequest $request
     * @return Response
     */
    public function update(Warehouse $warehouse, IssueCard $issuecard, UpdateIssueCardRequest $request)
    {
        $this->issuecard->update($issuecard, $request->all());

        return redirect()->route('admin.warehouse.issuecard.index', $warehouse->id)
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('warehouse::issuecards.title.issuecards')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  IssueCard $issuecard
     * @return Response
     */
    public function destroy(Warehouse $warehouse, IssueCard $issuecard)
    {
        $item = Item::where('material_number', '=', $issuecard->material_number)->first();
        $item->quantity = $item->quantity + $issuecard->issuing_volume;
        $item->save();
        $this->issuecard->destroy($issuecard);

        return redirect()->route('admin.warehouse.issuecard.index', $warehouse->id)
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('warehouse::issuecards.title.issuecards')]));
    }

    public function export(Warehouse $warehouse, IssueCardSerialiser $serialiser)
    {
        $settings = $warehouse->settings;

        $file = 'export/issuecards/issuecards-'.str_slug($warehouse->name).'-'.Carbon::now()->format('ymd-Hi').'.xlsx';
        //upravit do settings where like
        $query = DB::table('warehouse__issuecards')->select($settings->issue_card_sap_export)->where('warehouse_id', $warehouse->id)->where('exported', 0)
                    ->where(function($query){
                        $query->where('material_number','like','%y%')
                        ->orWhere('material_number','like','%h%');
                    });
        $excel = Exporter::make('Excel');
        $excel->loadQuery($query);
        $excel->setChunk(1000);
        $excel->setSerialiser($serialiser);
        $excel->save($file);
        $this->notification->to(Auth::user()->id)->push('Export issue card complete', 'Download Here', 'fa fa-hand-peace-o text-green', url($file));
        foreach ($warehouse->issueCard()->where('exported', 0)->get() as $i) {
            $i->exported = 1;
            $i->save();
        }
        
        return redirect()->route('admin.warehouse.issuecard.index', $warehouse->id)
            ->withSuccess(trans('warehouse::issuecards.messages.resource exported', ['name' => trans('warehouse::issuecards.title.issuecards')]));
    }
      
    public function import(Warehouse $warehouse, Request $request)
    {
        if ($request->hasFile('import')) {
            $file = $request->file('import');
            $name =$file->getClientOriginalName();
            $path = $file->storeAs('import/issuecards', $name, 'public');
            $xls = storage_path('app/public/'.$path);

            Excel::filter('chunk')->load($xls)->chunk(300, function ($results) use ($warehouse) {
                foreach ($results as $row) {
                    if ($row) {
                        $warehouse->issueCard()->create($row->toArray());
                    }
                }
            });
            
            return redirect()->route('admin.warehouse.issuecard.index', $warehouse)
            ->withSuccess(trans('warehouse::items.messages.resource import', ['name' => trans('warehouse::items.title.items')]));
        }

        return redirect()->route('admin.warehouse.issuecard.index', $warehouse)
            ->withError(trans('warehouse::items.messages.resource import nok', ['name' => trans('warehouse::items.title.items')]));
    }
}
