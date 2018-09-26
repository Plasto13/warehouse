<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use Modules\Warehouse\Entities\Item;
use Modules\Warehouse\Entities\IssueCard;
use Modules\Warehouse\Entities\CostCenter;
use Modules\Warehouse\Entities\MachinePart;
use Illuminate\Support\Arr;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function item(Request $request)
    {
        $data = Item::where($request->collumn, 'like', "%$request->data%")->pluck($request->collumn,$request->collumn);
        return response($data, $status = 200);
    }

    public function issuecard(Request $request)
    {
        $data = IssueCard::where($request->collumn, 'like', "%$request->data%")->pluck($request->collumn,$request->collumn);
        return response($data, $status = 200);
    }

    public function costcenter(Request $request)
    {
        $output = [];
        $data = CostCenter::with('translations')->whereHas('translations',function ($query) use ($request) {
            $query->where('title', 'like',  "%$request->data%")->where('locale', '=', 'sk');
            })->get();

       foreach ($data as $model) {
           $output = array_add($output, $model->id, $model->title);
       }
        // dd($output);
        return response($output, $status = 200);
    }

    public function machinepart(Request $request)
    {
        $data = MachinePart::where($request->collumn, 'like', "%$request->data%")->pluck($request->collumn,'id');
        return response($data, $status = 200);
    }


}
