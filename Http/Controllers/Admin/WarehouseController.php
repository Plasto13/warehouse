<?php

namespace Modules\Warehouse\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Warehouse\Entities\Warehouse;
use Modules\Warehouse\Http\Requests\CreateWarehouseRequest;
use Modules\Warehouse\Http\Requests\UpdateWarehouseRequest;
use Modules\Warehouse\Repositories\WarehouseRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class WarehouseController extends AdminBaseController
{
    /**
     * @var WarehouseRepository
     */
    private $warehouse;

    public function __construct(WarehouseRepository $warehouse)
    {
        parent::__construct();

        $this->warehouse = $warehouse;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $warehouses = $this->warehouse->all();

        return view('warehouse::admin.warehouses.index', compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('warehouse::admin.warehouses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateWarehouseRequest $request
     * @return Response
     */
    public function store(CreateWarehouseRequest $request)
    {
        // dd($request->all());

        $this->warehouse->create($request->all());

        return redirect()->route('admin.warehouse.warehouse.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('warehouse::warehouses.title.warehouses')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Warehouse $warehouse
     * @return Response
     */
    public function edit(Warehouse $warehouse)
    {
        // dd($warehouse);
        return view('warehouse::admin.warehouses.edit', compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Warehouse $warehouse
     * @param  UpdateWarehouseRequest $request
     * @return Response
     */
    public function update(Warehouse $warehouse, UpdateWarehouseRequest $request)
    {
        $this->warehouse->update($warehouse, $request->all());

        return redirect()->route('admin.warehouse.warehouse.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('warehouse::warehouses.title.warehouses')]));
    }

    public function show(Warehouse $warehouse)
    {
        return $warehouse;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Warehouse $warehouse
     * @return Response
     */
    public function destroy(Warehouse $warehouse)
    {
        $this->warehouse->destroy($warehouse);

        return redirect()->route('admin.warehouse.warehouse.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('warehouse::warehouses.title.warehouses')]));
    }
}
