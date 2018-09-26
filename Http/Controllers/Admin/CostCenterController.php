<?php

namespace Modules\Warehouse\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Warehouse\Entities\CostCenter;
use Modules\Warehouse\Entities\Warehouse;
use Modules\Warehouse\Http\Requests\CreateCostCenterRequest;
use Modules\Warehouse\Http\Requests\UpdateCostCenterRequest;
use Modules\Warehouse\Repositories\CostCenterRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class CostCenterController extends AdminBaseController
{
    /**
     * @var CostCenterRepository
     */
    private $costcenter;

    public function __construct(CostCenterRepository $costcenter)
    {
        parent::__construct();

        $this->costcenter = $costcenter;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Warehouse $warehouse)
    {
    
        $costcenters = $warehouse->costCenter()->get();

        return view('warehouse::admin.costcenters.index', compact('costcenters','warehouse'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Warehouse $warehouse)
    {
        return view('warehouse::admin.costcenters.create',compact('warehouse'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCostCenterRequest $request
     * @return Response
     */
    public function store(Warehouse $warehouse,CreateCostCenterRequest $request)
    {
        $warehouse->costCenter()->create($request->all());

        return redirect()->route('admin.warehouse.costcenter.index',$warehouse->id)
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('warehouse::costcenters.title.costcenters')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  CostCenter $costcenter
     * @return Response
     */
    public function edit(Warehouse $warehouse,CostCenter $costcenter)
    {
        return view('warehouse::admin.costcenters.edit', compact('costcenter','warehouse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CostCenter $costcenter
     * @param  UpdateCostCenterRequest $request
     * @return Response
     */
    public function update(Warehouse $warehouse,CostCenter $costcenter, UpdateCostCenterRequest $request)
    {
        $this->costcenter->update($costcenter, $request->all());

        return redirect()->route('admin.warehouse.costcenter.index',$warehouse->id)
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('warehouse::costcenters.title.costcenters')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  CostCenter $costcenter
     * @return Response
     */
    public function destroy(Warehouse $warehouse,CostCenter $costcenter)
    {
        $this->costcenter->destroy($costcenter);

        return redirect()->route('admin.warehouse.costcenter.index',$warehouse->id)
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('warehouse::costcenters.title.costcenters')]));
    }
}
