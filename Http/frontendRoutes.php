<?php

use Illuminate\Routing\Router;

$router->group(['prefix' =>'/warehouse'], function (Router $router) {
$router->bind('warehouse', function ($id) {
        return app('Modules\Warehouse\Repositories\WarehouseRepository')->find($id);
    });
    $router->get('warehouses', [
        'as' => 'warehouses.guest.index',
        'uses' => 'WarehouseGuestController@index',
        // 'middleware' => 'can:warehouse.warehouses.index'
    ]);

    $router->bind('warehouse/{warehouse}/item', function ($id) {
        return app('Modules\Warehouse\Repositories\ItemRepository')->find($id);
    });
    $router->get('warehouse/{warehouse}/items', [
        'as' => 'warehouse.guest.item.index',
        'uses' => 'ItemGuestController@index',
        // 'middleware' => 'can:warehouse.items.index'
    ]);

    $router->bind('warehouse/{warehouse}/issuecard', function ($id) {
        return app('Modules\Warehouse\Repositories\IssueCardRepository')->find($id);
    });
    $router->get('warehouse/{warehouse}/issuecards', [
        'as' => 'warehouse.guest.issuecard.index',
        'uses' => 'IssueCardGuestController@index',
        // 'middleware' => 'can:warehouse.issuecards.index'
    ]);
    $router->get('warehouse/{warehouse}/items/{item}/issuecards/create', [
        'as' => 'warehouse.guest.issuecard.create',
        'uses' => 'IssueCardGuestController@create',
        // 'middleware' => 'can:warehouse.issuecards.create'
    ]);
    $router->post('warehouse/{warehouse}/issuecards', [
        'as' => 'warehouse.guest.issuecard.store',
        'uses' => 'IssueCardGuestController@store',
        // 'middleware' => 'can:warehouse.issuecards.create'
    ]);
    $router->delete('warehouse/{warehouse}/issuecards/{issuecard}', [
        'as' => 'warehouse.guest.issuecard.destroy',
        'uses' => 'IssueCardGuestController@destroy',
        // 'middleware' => 'can:warehouse.issuecards.destroy'
    ]);


});