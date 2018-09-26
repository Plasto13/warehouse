<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => '/v1/warehouse'], function (Router $router) {
    $router->get('{warehouse}/item', [
        'as' => 'api.warehouse.item',
        'uses' => 'WarehouseController@item',
    ]);
    $router->get('{warehouse}/issuecard', [
        'as' => 'api.warehouse.issuecard',
        'uses' => 'WarehouseController@issuecard',
    ]);
     $router->get('{warehouse}/costcenter', [
        'as' => 'api.warehouse.costcenter',
        'uses' => 'WarehouseController@costcenter',
    ]);
   
});

