<?php

namespace Modules\Warehouse\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Warehouse\Entities\Zebra;
use Modules\Warehouse\Entities\Warehouse;
use Modules\Warehouse\Http\Requests\CreateZebraRequest;
use Modules\Warehouse\Http\Requests\UpdateZebraRequest;
use Modules\Warehouse\Repositories\ZebraRepository;
use Modules\Warehouse\Repositories\ItemRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ZebraController extends AdminBaseController
{
    /**
     * @var ZebraRepository
     */
    private $zebra;

    /**
     * @var ItemRepsitory
     */
    private $item;

    public function __construct(ZebraRepository $zebra, ItemRepository $item)
    {
        parent::__construct();

        $this->zebra = $zebra;
        $this->item = $item;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Warehouse $warehouse)
    {
        $zebras = $this->zebra->all();

        return view('warehouse::admin.zebras.index', compact('zebras', 'warehouse'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Warehouse $warehouse)
    {
        $itemCollumnList = array_column($this->item->getCollumns(), 'name', 'name');
        return view('warehouse::admin.zebras.create', compact('warehouse', 'itemCollumnList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateZebraRequest $request
     * @return Response
     */
    public function store(Warehouse $warehouse, CreateZebraRequest $request)
    {
        if ($request->default) {
            $old = $warehouse->zebra()->where('default',1)->first();
            if ($old) {
                $old->default = false;
                $old->save();
            }
            
        }
        // dd($request->all());
        $warehouse->zebra()->create($request->all());

        return redirect()->route('admin.warehouse.zebra.index', $warehouse->id)
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('warehouse::zebras.title.zebras')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Zebra $zebra
     * @return Response
     */
    public function edit(Warehouse $warehouse, Zebra $zebra)
    {
        $itemCollumnList = array_column($this->item->getCollumns(), 'name', 'name');
        return view('warehouse::admin.zebras.edit', compact('zebra', 'warehouse', 'itemCollumnList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Zebra $zebra
     * @param  UpdateZebraRequest $request
     * @return Response
     */
    public function update(Warehouse $warehouse, Zebra $zebra, UpdateZebraRequest $request)
    {
        if ($request->default) {
            $old = $warehouse->zebra()->where('default',1)->first();
            if ($old) {
                $old->default = false;
                $old->save();
            }           
        }
        $this->zebra->update($zebra, $request->all());

        return redirect()->route('admin.warehouse.zebra.index',$warehouse->id)
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('warehouse::zebras.title.zebras')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Zebra $zebra
     * @return Response
     */
    public function destroy(Warehouse $warehouse, Zebra $zebra)
    {
        $this->zebra->destroy($zebra);

        return redirect()->route('admin.warehouse.zebra.index',$warehouse->id)
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('warehouse::zebras.title.zebras')]));
    }
}
