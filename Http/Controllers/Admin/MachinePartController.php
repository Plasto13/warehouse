<?php

namespace Modules\Warehouse\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Warehouse\Entities\MachinePart;
use Modules\Warehouse\Entities\Warehouse;
use Modules\Warehouse\Http\Requests\CreateMachinePartRequest;
use Modules\Warehouse\Http\Requests\UpdateMachinePartRequest;
use Modules\Warehouse\Repositories\MachinePartRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class MachinePartController extends AdminBaseController
{
    /**
     * @var MachinePartRepository
     */
    private $machinepart;

    public function __construct(MachinePartRepository $machinepart)
    {
        parent::__construct();

        $this->machinepart = $machinepart;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Warehouse $warehouse)
    {
        $machineparts = $warehouse->machinePart()->get();

        return view('warehouse::admin.machineparts.index', compact('machineparts','warehouse'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Warehouse $warehouse)
    {
        return view('warehouse::admin.machineparts.create',compact('warehouse'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateMachinePartRequest $request
     * @return Response
     */
    public function store(Warehouse $warehouse,CreateMachinePartRequest $request)
    {
        $warehouse->machinePart()->create($request->all());

        return redirect()->route('admin.warehouse.machinepart.index',$warehouse->id)
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('warehouse::machineparts.title.machineparts')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  MachinePart $machinepart
     * @return Response
     */
    public function edit(Warehouse $warehouse,MachinePart $machinepart)
    {
        return view('warehouse::admin.machineparts.edit', compact('warehouse','machinepart'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MachinePart $machinepart
     * @param  UpdateMachinePartRequest $request
     * @return Response
     */
    public function update(Warehouse $warehouse,MachinePart $machinepart, UpdateMachinePartRequest $request)
    {
        $this->machinepart->update($machinepart, $request->all());

        return redirect()->route('admin.warehouse.machinepart.index',$warehouse->id)
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('warehouse::machineparts.title.machineparts')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  MachinePart $machinepart
     * @return Response
     */
    public function destroy(Warehouse $warehouse,MachinePart $machinepart)
    {
        $this->machinepart->destroy($machinepart);

        return redirect()->route('admin.warehouse.machinepart.index',$warehouse->id)
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('warehouse::machineparts.title.machineparts')]));
    }
}
