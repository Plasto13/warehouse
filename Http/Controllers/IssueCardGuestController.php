<?php

namespace Modules\Warehouse\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Warehouse\Entities\CostCenter;
use Modules\Warehouse\Entities\IssueCard;
use Modules\Warehouse\Entities\Item;
use Modules\Warehouse\Entities\MachinePart;
use Modules\Warehouse\Entities\Warehouse;
use Modules\Warehouse\Http\Requests\CreateIssueCardRequest;
use Modules\Warehouse\Repositories\IssueCardRepository;
use Yajra\DataTables\Datatables;
use Yajra\DataTables\Html\Builder;

class IssueCardGuestController extends Controller
{
    /**
     * @var IssueCardRepository
     */
    private $issuecard;

    public function __construct(IssueCardRepository $issuecard)
    {
        $this->issuecard = $issuecard;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Warehouse $warehouse, Builder $builder)
    {
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
            return DataTables::of(IssueCard::query())
                    ->editColumn('url', 'warehouse::admin.items.columns.url')
                    ->editColumn('exported', 'warehouse::admin.issuecards.columns.exported')
                    ->editColumn('costcenter_id', function (IssueCard $issuecard) use ($warehouse) {
                        return view('warehouse::admin.issuecards.columns.costcenter')->with(['warehouse'=>$warehouse,'issuecard' => $issuecard]);
                    })
                    ->editColumn('machinepart_id', function (IssueCard $issuecard) use ($warehouse) {
                        return view('warehouse::admin.issuecards.columns.machinepart')->with(['warehouse'=>$warehouse,'issuecard' => $issuecard]);
                    })
                   
                    ->editColumn('action', 'warehouse::guest.issuecards.action')
                    ->rawColumns(['url','action','exported','costcenter_id'])
                    ->toJson();
        }
        
        $html = $builder->columns($this->issuecard->getCollumns($warehouse, true))
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

        return view('warehouse::guest.issuecards.index', compact('html', 'warehouse'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Warehouse $warehouse, Item $item)
    {
        $costcenters = CostCenter::listsTranslations('title')->where('warehouse_id', '=', $warehouse->id)->pluck('title', 'id')->toArray();
        $machineparts = MachinePart::listsTranslations('title')->where('warehouse_id', '=', $warehouse->id)->pluck('title', 'id')->toArray();

        return view('warehouse::guest.issuecards.create', compact('warehouse', 'item', 'costcenters', 'machineparts'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Warehouse $warehouse, CreateIssueCardRequest $request)
    {
        $item = $warehouse->item()->findOrFail($request->item_id);
        // dd($item);
        $item->quantity = $item->quantity - $request->issuing_volume;
        $item->save();
        $warehouse->issueCard()->create($request->all());
        alert()->flash('Polozka vydana', 'success', [
                'text' => 'Polozka bola vydana, pre vratenie do skladu odstrante vydajku!',
                'timer' => 7000,
                'showConfirmButton'=>true
                ]);

        return redirect()->route('warehouse.guest.item.index', $warehouse->id);
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
    public function destroy(Warehouse $warehouse, IssueCard $issuecard)
    {
        if ($issuecard->exported) {
            alert()->flash('Polozka vydana', 'error', [
                'text' => 'Polozka nebola odstranena, Pre Opravu kontaktujte Skladnika!',
                'timer' => 7000,
                'showConfirmButton'=>true
                ]);

            return redirect()->route('warehouse.guest.issuecard.index', $warehouse->id);
        }
        alert()->flash('Nemozne', 'error', [
                'text' => 'Polozka nebola odstranena, Pre Opravu kontaktujte Skladnika!',
                'timer' => 7000,
                'showConfirmButton'=>true
                ]);
        $item = Item::where('material_number', '=', $issuecard->material_number)->first();
        $item->quantity = $item->quantity + $issuecard->issuing_volume;
        $item->save();
        $this->issuecard->destroy($issuecard);

        alert()->flash('Uspech', 'success', [
                'text' => 'Polozka vratena do skladu!',
                'timer' => 7000,
                'showConfirmButton'=>true
                ]);

        return redirect()->route('warehouse.guest.item.index', $warehouse->id);
    }
}
