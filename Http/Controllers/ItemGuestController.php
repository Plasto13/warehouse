<?php

namespace Modules\Warehouse\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Warehouse\Entities\Item;
use Modules\Warehouse\Entities\Warehouse;
use Modules\Warehouse\Repositories\ItemRepository;
use Yajra\DataTables\Datatables;
use Yajra\DataTables\Html\Builder;

class ItemGuestController extends Controller
{
    /**
     * @var ItemRepository
     */
    private $item;

    private $base;


    public function __construct(ItemRepository $item)
    {
        $warehouse = 0;
        $this->item = $item;
        if (null !== \Route::current()->parameter('warehouse')) {
            $warehouse = \Route::current()->parameter('warehouse');
            $this->base['route'] = route('warehouse.guest.item.index', $warehouse);
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
                        'placeholder' => trans('warehouse::items.table.supplier'),
                        ],
                                     
        ];
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Warehouse $warehouse, Builder $builder, Request $request)
    {
        $initComplete = "function () {}";

        $settings = $warehouse->settings()->first();
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
            return DataTables::of(Item::query()->with('files'))
                    ->editColumn('url', 'warehouse::admin.items.columns.url')
                    ->editColumn('photo', 'warehouse::admin.items.columns.image')
                    ->editColumn('action', 'warehouse::guest.items.columns.action')
                    ->rawColumns(['url','photo','action','remarks'])
                     ->filter(function ($query) use ($request) {
                        if ($name = $request->get('materialnumber')) {
                           $query->where('material_number', 'like', "%$name%");
                        }
                        if ($name = $request->get('name')) {
                           $query->where('name', 'like', "%$name%");
                        }
                        if ($name = $request->get('localname')) {
                           $query->where('local_name', 'like', "%$name%");
                        }
                        if ($name = $request->get('specification')) {
                           $query->where('specification', 'like', "%$name%");
                        }
                        if ($name = $request->get('ordernumber')) {
                           $query->where('order_number', 'like', "%$name%");
                        }
                        if ($name = $request->get('storageposition')) {
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
        
        $html = $builder->columns($this->item->getCollumns($warehouse,true))
                        ->parameters([
                                    'paging' => true,
                                    'searching' => true,
                                    'info' => false,
                                    'language' => [
                                        'url' => asset("modules/core/js/vendor/datatables/".locale().".json")
                                        ],
                                    'initComplete' => $initComplete,

                                    ]);


        $base = $this->base;
        return view('warehouse::guest.items.index',compact('warehouse', 'html', 'base'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('warehouse::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('warehouse::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('warehouse::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
