<?php

namespace Modules\Warehouse\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Warehouse\Entities\Settings;
use Modules\Warehouse\Entities\Warehouse;
use Modules\Warehouse\Http\Requests\CreateSettingsRequest;
use Modules\Warehouse\Http\Requests\UpdateSettingsRequest;
use Modules\Warehouse\Repositories\IssueCardRepository;
use Modules\Warehouse\Repositories\ItemRepository;
use Modules\Warehouse\Repositories\SettingsRepository;

class SettingsController extends AdminBaseController
{
    /**
     * @var SettingsRepository
     */
    private $settings;

    private $item;

    private $issuecard;

    public function __construct(SettingsRepository $settings,ItemRepository $item,IssueCardRepository $issuecard)
    {
        parent::__construct();

        $this->item = $item;
        $this->issuecard = $issuecard;
        $this->settings = $settings;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Warehouse $warehouse)
    {
        if ($warehouse->settings) {

            return redirect()->route('admin.warehouse.settings.edit',[$warehouse->id, $warehouse->settings->id]);
        }
        return redirect()->route('admin.warehouse.settings.create',$warehouse->id);

        return view('warehouse::admin.settings.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Warehouse $warehouse)
    {
        $itemCollumnList = array_column($this->item->getCollumns(),'name','name');
        $issuecardCollumnList = array_column($this->issuecard->getCollumns(),'name','name');

        return view('warehouse::admin.settings.create',compact('warehouse','itemCollumnList','issuecardCollumnList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateSettingsRequest $request
     * @return Response
     */
    public function store(Warehouse $warehouse,CreateSettingsRequest $request)
    {
        // dd($request->all());
        $warehouse->settings()->create($request->all());

        return redirect()->route('admin.warehouse.item.index',$warehouse->id)
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('warehouse::settings.title.settings')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Settings $settings
     * @return Response
     */
    public function edit(Warehouse $warehouse)
    {
        $itemCollumnList = array_column($this->item->getCollumns(),'name','name');
        $issuecardCollumnList = array_column($this->issuecard->getCollumns(),'name','name');
        $settings = $warehouse->settings;

        return view('warehouse::admin.settings.edit', compact('settings','warehouse','itemCollumnList','issuecardCollumnList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Settings $settings
     * @param  UpdateSettingsRequest $request
     * @return Response
     */
    public function update(Warehouse $warehouse, UpdateSettingsRequest $request)
    {
        $warehouse->settings->update($request->all());

        return redirect()->route('admin.warehouse.item.index',$warehouse->id)
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('warehouse::settings.title.settings')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Settings $settings
     * @return Response
     */
    public function destroy(Warehouse $warehouse,Settings $settings)
    {
        return back();
        $this->settings->destroy($settings);

        return redirect()->route('admin.warehouse.settings.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('warehouse::settings.title.settings')]));
    }

}
