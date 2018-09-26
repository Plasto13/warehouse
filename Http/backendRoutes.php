<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/warehouse'], function (Router $router) {
    $router->bind('warehouse', function ($id) {
        return app('Modules\Warehouse\Repositories\WarehouseRepository')->find($id);
    });
    $router->get('warehouses', [
        'as' => 'admin.warehouse.warehouse.index',
        'uses' => 'WarehouseController@index',
        'middleware' => 'can:warehouse.warehouses.index'
    ]);
    $router->get('warehouses/create', [
        'as' => 'admin.warehouse.warehouse.create',
        'uses' => 'WarehouseController@create',
        'middleware' => 'can:warehouse.warehouses.create'
    ]);
    $router->get('warehouses/{warehouse}', [
        'as' => 'admin.warehouse.warehouse.show',
        'uses' => 'WarehouseController@show',
        'middleware' => 'can:warehouse.warehouses.index'
    ]);
    $router->post('warehouses', [
        'as' => 'admin.warehouse.warehouse.store',
        'uses' => 'WarehouseController@store',
        'middleware' => 'can:warehouse.warehouses.create'
    ]);
    $router->get('warehouses/{warehouse}/edit', [
        'as' => 'admin.warehouse.warehouse.edit',
        'uses' => 'WarehouseController@edit',
        'middleware' => 'can:warehouse.warehouses.edit'
    ]);
    $router->put('warehouses/{warehouse}', [
        'as' => 'admin.warehouse.warehouse.update',
        'uses' => 'WarehouseController@update',
        'middleware' => 'can:warehouse.warehouses.edit'
    ]);
    $router->delete('warehouses/{warehouse}', [
        'as' => 'admin.warehouse.warehouse.destroy',
        'uses' => 'WarehouseController@destroy',
        'middleware' => 'can:warehouse.warehouses.destroy'
    ]);
    $router->bind('warehouse/{warehouse}/item', function ($id) {
        return app('Modules\Warehouse\Repositories\ItemRepository')->find($id);
    });
    $router->get('warehouse/{warehouse}/items', [
        'as' => 'admin.warehouse.item.index',
        'uses' => 'ItemController@index',
        'middleware' => 'can:warehouse.items.index'
    ]);
    $router->get('warehouse/{warehouse}/items/create', [
        'as' => 'admin.warehouse.item.create',
        'uses' => 'ItemController@create',
        'middleware' => 'can:warehouse.items.create'
    ]);
    $router->post('warehouse/{warehouse}/items', [
        'as' => 'admin.warehouse.item.store',
        'uses' => 'ItemController@store',
        'middleware' => 'can:warehouse.items.create'
    ]);
    $router->post('warehouse/{warehouse}/items/import', [
        'as' => 'admin.warehouse.item.import',
        'uses' => 'ItemController@import',
        'middleware' => 'can:warehouse.items.create'
    ]);
    $router->post('warehouse/{warehouse}/items/print', [
        'as' => 'admin.warehouse.item.print',
        'uses' => 'ItemController@print',
        'middleware' => 'can:warehouse.items.index'
    ]);
    $router->get('warehouse/{warehouse}/items/export', [
        'as' => 'admin.warehouse.item.export',
        'uses' => 'ItemController@export',
        'middleware' => 'can:warehouse.items.create'
    ]);
    $router->get('warehouse/{warehouse}/items/{item}/edit', [
        'as' => 'admin.warehouse.item.edit',
        'uses' => 'ItemController@edit',
        'middleware' => 'can:warehouse.items.edit'
    ]);
    $router->put('warehouse/{warehouse}/items/{item}', [
        'as' => 'admin.warehouse.item.update',
        'uses' => 'ItemController@update',
        'middleware' => 'can:warehouse.items.edit'
    ]);
    $router->delete('warehouse/{warehouse}/items/{item}', [
        'as' => 'admin.warehouse.item.destroy',
        'uses' => 'ItemController@destroy',
        'middleware' => 'can:warehouse.items.destroy'
    ]);
    $router->bind('warehouse/{warehouse}/issuecard', function ($id) {
        return app('Modules\Warehouse\Repositories\IssueCardRepository')->find($id);
    });
    $router->get('warehouse/{warehouse}/issuecards', [
        'as' => 'admin.warehouse.issuecard.index',
        'uses' => 'IssueCardController@index',
        'middleware' => 'can:warehouse.issuecards.index'
    ]);
    $router->get('warehouse/{warehouse}/items/{item}/issuecards/create', [
        'as' => 'admin.warehouse.issuecard.create',
        'uses' => 'IssueCardController@create',
        'middleware' => 'can:warehouse.issuecards.create'
    ]);
    $router->post('warehouse/{warehouse}/issuecards', [
        'as' => 'admin.warehouse.issuecard.store',
        'uses' => 'IssueCardController@store',
        'middleware' => 'can:warehouse.issuecards.create'
    ]);
    $router->get('warehouse/{warehouse}/issuecards/export', [
        'as' => 'admin.warehouse.issuecard.export',
        'uses' => 'IssueCardController@export',
        'middleware' => 'can:warehouse.issuecards.index'
    ]);
    $router->post('warehouse/{warehouse}/issuecards/import/', [
        'as' => 'admin.warehouse.issuecard.import',
        'uses' => 'IssueCardController@import',
        'middleware' => 'can:warehouse.issuecards.edit'
    ]);
    $router->get('warehouse/{warehouse}/issuecards/{issuecard}/edit', [
        'as' => 'admin.warehouse.issuecard.edit',
        'uses' => 'IssueCardController@edit',
        'middleware' => 'can:warehouse.issuecards.edit'
    ]);
    $router->put('warehouse/{warehouse}/issuecards/{issuecard}', [
        'as' => 'admin.warehouse.issuecard.update',
        'uses' => 'IssueCardController@update',
        'middleware' => 'can:warehouse.issuecards.edit'
    ]);
    $router->delete('warehouse/{warehouse}/issuecards/{issuecard}', [
        'as' => 'admin.warehouse.issuecard.destroy',
        'uses' => 'IssueCardController@destroy',
        'middleware' => 'can:warehouse.issuecards.destroy'
    ]);
    $router->bind('warehouse/{warehouse}/settings', function ($id) {
        return app('Modules\Warehouse\Repositories\SettingsRepository')->find($id);
    });
    $router->get('warehouse/{warehouse}/settings', [
        'as' => 'admin.warehouse.settings.index',
        'uses' => 'SettingsController@index',
        'middleware' => 'can:warehouse.settings.index'
    ]);
    $router->get('warehouse/{warehouse}/settings/create', [
        'as' => 'admin.warehouse.settings.create',
        'uses' => 'SettingsController@create',
        'middleware' => 'can:warehouse.settings.create'
    ]);
    $router->post('warehouse/{warehouse}/settings', [
        'as' => 'admin.warehouse.settings.store',
        'uses' => 'SettingsController@store',
        'middleware' => 'can:warehouse.settings.create'
    ]);
    $router->get('warehouse/{warehouse}/settings/edit', [
        'as' => 'admin.warehouse.settings.edit',
        'uses' => 'SettingsController@edit',
        'middleware' => 'can:warehouse.settings.edit'
    ]);
    $router->put('warehouse/{warehouse}/settings', [
        'as' => 'admin.warehouse.settings.update',
        'uses' => 'SettingsController@update',
        'middleware' => 'can:warehouse.settings.edit'
    ]);
    $router->delete('warehouse/{warehouse}/settings/{settings}', [
        'as' => 'admin.warehouse.settings.destroy',
        'uses' => 'SettingsController@destroy',
        'middleware' => 'can:warehouse.settings.destroy'
    ]);
    $router->bind('itemstatus', function ($id) {
        return app('Modules\Warehouse\Repositories\ItemStatusRepository')->find($id);
    });
    $router->get('itemstatuses', [
        'as' => 'admin.warehouse.itemstatus.index',
        'uses' => 'ItemStatusController@index',
        'middleware' => 'can:warehouse.itemstatuses.index'
    ]);
    $router->get('itemstatuses/create', [
        'as' => 'admin.warehouse.itemstatus.create',
        'uses' => 'ItemStatusController@create',
        'middleware' => 'can:warehouse.itemstatuses.create'
    ]);
    $router->post('itemstatuses', [
        'as' => 'admin.warehouse.itemstatus.store',
        'uses' => 'ItemStatusController@store',
        'middleware' => 'can:warehouse.itemstatuses.create'
    ]);
    $router->get('itemstatuses/{itemstatus}/edit', [
        'as' => 'admin.warehouse.itemstatus.edit',
        'uses' => 'ItemStatusController@edit',
        'middleware' => 'can:warehouse.itemstatuses.edit'
    ]);
    $router->put('itemstatuses/{itemstatus}', [
        'as' => 'admin.warehouse.itemstatus.update',
        'uses' => 'ItemStatusController@update',
        'middleware' => 'can:warehouse.itemstatuses.edit'
    ]);
    $router->delete('itemstatuses/{itemstatus}', [
        'as' => 'admin.warehouse.itemstatus.destroy',
        'uses' => 'ItemStatusController@destroy',
        'middleware' => 'can:warehouse.itemstatuses.destroy'
    ]);
    $router->bind('warehouse/{warehouse}/costcenter', function ($id) {
        return app('Modules\Warehouse\Repositories\CostCenterRepository')->find($id);
    });
    $router->get('warehouse/{warehouse}/costcenters', [
        'as' => 'admin.warehouse.costcenter.index',
        'uses' => 'CostCenterController@index',
        'middleware' => 'can:warehouse.costcenters.index'
    ]);
    $router->get('warehouse/{warehouse}/costcenters/create', [
        'as' => 'admin.warehouse.costcenter.create',
        'uses' => 'CostCenterController@create',
        'middleware' => 'can:warehouse.costcenters.create'
    ]);
    $router->post('warehouse/{warehouse}/costcenters', [
        'as' => 'admin.warehouse.costcenter.store',
        'uses' => 'CostCenterController@store',
        'middleware' => 'can:warehouse.costcenters.create'
    ]);
    $router->get('warehouse/{warehouse}/costcenters/{costcenter}/edit', [
        'as' => 'admin.warehouse.costcenter.edit',
        'uses' => 'CostCenterController@edit',
        'middleware' => 'can:warehouse.costcenters.edit'
    ]);
    $router->put('warehouse/{warehouse}/costcenters/{costcenter}', [
        'as' => 'admin.warehouse.costcenter.update',
        'uses' => 'CostCenterController@update',
        'middleware' => 'can:warehouse.costcenters.edit'
    ]);
    $router->delete('warehouse/{warehouse}/costcenters/{costcenter}', [
        'as' => 'admin.warehouse.costcenter.destroy',
        'uses' => 'CostCenterController@destroy',
        'middleware' => 'can:warehouse.costcenters.destroy'
    ]);
    $router->bind('warehouse/{warehouse}/machinepart', function ($id) {
        return app('Modules\Warehouse\Repositories\MachinePartRepository')->find($id);
    });
    $router->get('warehouse/{warehouse}/machineparts', [
        'as' => 'admin.warehouse.machinepart.index',
        'uses' => 'MachinePartController@index',
        'middleware' => 'can:warehouse.machineparts.index'
    ]);
    $router->get('warehouse/{warehouse}/machineparts/create', [
        'as' => 'admin.warehouse.machinepart.create',
        'uses' => 'MachinePartController@create',
        'middleware' => 'can:warehouse.machineparts.create'
    ]);
    $router->post('warehouse/{warehouse}/machineparts', [
        'as' => 'admin.warehouse.machinepart.store',
        'uses' => 'MachinePartController@store',
        'middleware' => 'can:warehouse.machineparts.create'
    ]);
    $router->get('warehouse/{warehouse}/machineparts/{machinepart}/edit', [
        'as' => 'admin.warehouse.machinepart.edit',
        'uses' => 'MachinePartController@edit',
        'middleware' => 'can:warehouse.machineparts.edit'
    ]);
    $router->put('warehouse/{warehouse}/machineparts/{machinepart}', [
        'as' => 'admin.warehouse.machinepart.update',
        'uses' => 'MachinePartController@update',
        'middleware' => 'can:warehouse.machineparts.edit'
    ]);
    $router->delete('warehouse/{warehouse}/machineparts/{machinepart}', [
        'as' => 'admin.warehouse.machinepart.destroy',
        'uses' => 'MachinePartController@destroy',
        'middleware' => 'can:warehouse.machineparts.destroy'
    ]);
    $router->bind('zebra', function ($id) {
        return app('Modules\Warehouse\Repositories\ZebraRepository')->find($id);
    });
    $router->get('warehouse/{warehouse}/zebras', [
        'as' => 'admin.warehouse.zebra.index',
        'uses' => 'ZebraController@index',
        'middleware' => 'can:warehouse.zebras.index'
    ]);
    $router->get('warehouse/{warehouse}/zebras/create', [
        'as' => 'admin.warehouse.zebra.create',
        'uses' => 'ZebraController@create',
        'middleware' => 'can:warehouse.zebras.create'
    ]);
    $router->post('warehouse/{warehouse}/zebras', [
        'as' => 'admin.warehouse.zebra.store',
        'uses' => 'ZebraController@store',
        'middleware' => 'can:warehouse.zebras.create'
    ]);
    $router->get('warehouse/{warehouse}/zebras/{zebra}/edit', [
        'as' => 'admin.warehouse.zebra.edit',
        'uses' => 'ZebraController@edit',
        'middleware' => 'can:warehouse.zebras.edit'
    ]);
    $router->put('warehouse/{warehouse}/zebras/{zebra}', [
        'as' => 'admin.warehouse.zebra.update',
        'uses' => 'ZebraController@update',
        'middleware' => 'can:warehouse.zebras.edit'
    ]);
    $router->delete('warehouse/{warehouse}/zebras/{zebra}', [
        'as' => 'admin.warehouse.zebra.destroy',
        'uses' => 'ZebraController@destroy',
        'middleware' => 'can:warehouse.zebras.destroy'
    ]);
// append











});
