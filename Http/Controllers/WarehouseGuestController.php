<?php

namespace Modules\Warehouse\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Warehouse\Repositories\WarehouseRepository;


class WarehouseGuestController extends Controller
{
     /**
     * @var WarehouseRepository
     */
    private $warehouse;

    public function __construct(WarehouseRepository $warehouse)
    {
        $this->warehouse = $warehouse;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $warehouses = $this->warehouse->all();
        return view('warehouse::guest.warehouses.index',compact('warehouses'));
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
