<?php

namespace Modules\Warehouse\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Warehouse\Entities\ItemStatus;
use Modules\Warehouse\Http\Requests\CreateItemStatusRequest;
use Modules\Warehouse\Http\Requests\UpdateItemStatusRequest;
use Modules\Warehouse\Repositories\ItemStatusRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ItemStatusController extends AdminBaseController
{
    /**
     * @var ItemStatusRepository
     */
    private $itemstatus;

    public function __construct(ItemStatusRepository $itemstatus)
    {
        parent::__construct();

        $this->itemstatus = $itemstatus;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $itemstatuses = $this->itemstatus->all();

        return view('warehouse::admin.itemstatuses.index', compact('itemstatuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('warehouse::admin.itemstatuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateItemStatusRequest $request
     * @return Response
     */
    public function store(CreateItemStatusRequest $request)
    {
        $this->itemstatus->create($request->all());

        return redirect()->route('admin.warehouse.itemstatus.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('warehouse::itemstatuses.title.itemstatuses')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ItemStatus $itemstatus
     * @return Response
     */
    public function edit(ItemStatus $itemstatus)
    {
        return view('warehouse::admin.itemstatuses.edit', compact('itemstatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ItemStatus $itemstatus
     * @param  UpdateItemStatusRequest $request
     * @return Response
     */
    public function update(ItemStatus $itemstatus, UpdateItemStatusRequest $request)
    {
        $this->itemstatus->update($itemstatus, $request->all());

        return redirect()->route('admin.warehouse.itemstatus.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('warehouse::itemstatuses.title.itemstatuses')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ItemStatus $itemstatus
     * @return Response
     */
    public function destroy(ItemStatus $itemstatus)
    {
        $this->itemstatus->destroy($itemstatus);

        return redirect()->route('admin.warehouse.itemstatus.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('warehouse::itemstatuses.title.itemstatuses')]));
    }
}
