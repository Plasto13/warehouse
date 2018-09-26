<?php

namespace Modules\Warehouse\Repositories\Eloquent;

use Modules\Warehouse\Repositories\ItemRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Warehouse\Events\ItemWasCreated;
use Modules\Warehouse\Events\ItemWasUpdated;
use Modules\Warehouse\Events\ItemWasDeleted;

class EloquentItemRepository extends EloquentBaseRepository implements ItemRepository
{
	protected $model;

	public function create($data)
    {
        $item = $this->model->create($data);
        event(new ItemWasCreated($item, $data));
        return $item;
    }
    public function update($item, $data)
    {
        $item->update($data);
        event(new ItemWasUpdated($item, $data));
        return $item;
    }
    public function destroy($item)
    {
        event(new ItemWasDeleted($item));
        return $item->delete();
    }

    public function getCollumns($warehouse = null,$frontend = false)
    {
        $settings = null;
        if (is_object($warehouse)) {
            $settings = $warehouse->settings;
        }
        if(is_array($warehouse)){
            $settings = $warehouse;
        }
        
        $collumns = [
            'id' => [
                'name' => 'id',
                'data' => 'id',
                'title' => trans('warehouse::items.table.id'),
                'searchable' => false,
                'orderable' => true,
                // 'render' => 'function(){}',
                'footer' => trans('warehouse::items.table.id'),
                'exportable' => true,
                'printable' => true,
                'visible' => true,
                ],
        'material_number' => [
                'name' => 'material_number',
                'data' => 'material_number',
                'title' => trans('warehouse::items.table.material_number'),
                'searchable' => true,
                'orderable' => true,
                // 'render' => 'function(){}',
                'footer' => trans('warehouse::items.table.material_number'),
                'exportable' => true,
                'printable' => true,
                'visible' => true,
                ],
        'name' => [
                'name' => 'name',
                'data' => 'name',
                'title' => trans('warehouse::items.table.name'),
                'searchable' => true,
                'orderable' => true,
                // 'render' => 'function(){}',
                'footer' => trans('warehouse::items.table.name'),
                'exportable' => true,
                'printable' => true,
                'visible' => true,
                ],
        'local_name' => [
                'name' => 'local_name',
                'data' => 'local_name',
                'title' => trans('warehouse::items.table.local_name'),
                'searchable' => true,
                'orderable' => true,
                // 'render' => 'function(){}',
                'footer' => trans('warehouse::items.table.local_name'),
                'exportable' => true,
                'printable' => true,
                'visible' => true,
                ],
        'quantity' => [
                'name' => 'quantity',
                'data' => 'quantity',
                'title' => trans('warehouse::items.table.quantity'),
                'searchable' => true,
                'orderable' => false,
                // 'render' => 'function(){}',
                'footer' => trans('warehouse::items.table.quantity'),
                'exportable' => true,
                'printable' => true,
                'visible' => true,
                ],
        'minimum' => [
                'name' => 'minimum',
                'data' => 'minimum',
                'title' => trans('warehouse::items.table.minimum'),
                'searchable' => true,
                'orderable' => true,
                // 'render' => 'function(){}',
                'footer' => trans('warehouse::items.table.minimum'),
                'exportable' => true,
                'printable' => true,
                'visible' => true,
                ],
            'maximum' => [
                'name' => 'maximum',
                'data' => 'maximum',
                'title' => trans('warehouse::items.table.maximum'),
                'searchable' => true,
                'orderable' => true,
                // 'render' => 'function(){}',
                'footer' => trans('warehouse::items.table.maximum'),
                'exportable' => true,
                'printable' => true,
                'visible' => true,
                ],
            'status'=> [
                'name' => 'status',
                'data' => 'status',
                'title' => trans('warehouse::items.table.status'),
                'searchable' => false,
                'orderable' => false,
                // 'render' => 'function(){}',
                'footer' => trans('warehouse::items.table.status'),
                'exportable' => true,
                'printable' => true,
                'visible' => true,
                ],
        'specification' => [
                'name' => 'specification',
                'data' => 'specification',
                'title' => trans('warehouse::items.table.specification'),
                'searchable' => true,
                'orderable' => true,
                // 'render' => 'function(){}',
                'footer' => trans('warehouse::items.table.specification'),
                'exportable' => true,
                'printable' => true,
                'visible' => true,
                ],
        'order_number' => [
                'name' => 'order_number',
                'data' => 'order_number',
                'title' => trans('warehouse::items.table.order_number'),
                'searchable' => true,
                'orderable' => true,
                // 'render' => 'function(){}',
                'footer' => trans('warehouse::items.table.order_number'),
                'exportable' => true,
                'printable' => true,
                'visible' => true,
                ],
        'price' => [
                'name' => 'price',
                'data' => 'price',
                'title' => trans('warehouse::items.table.price'),
                'searchable' => true,
                'orderable' => true,
                // 'render' => 'function(){}',
                'footer' => trans('warehouse::items.table.price'),
                'exportable' => true,
                'printable' => true,
                'visible' => true,
                ],
        'storage_position' => [
                'name' => 'storage_position',
                'data' => 'storage_position',
                'title' => trans('warehouse::items.table.storage_position'),
                'searchable' => true,
                'orderable' => true,
                // 'render' => 'function(){}',
                'footer' => trans('warehouse::items.table.storage_position'),
                'exportable' => true,
                'printable' => true,
                'visible' => true,
                ],
        'manufacture' => [
                'name' => 'manufacture',
                'data' => 'manufacture',
                'title' => trans('warehouse::items.table.manufacture'),
                'searchable' => true,
                'orderable' => true,
                // 'render' => 'function(){}',
                'footer' => trans('warehouse::items.table.manufacture'),
                'exportable' => true,
                'printable' => true,
                'visible' => true,
                ],
        'supplier' => [
                'name' => 'supplier',
                'data' => 'supplier',
                'title' => trans('warehouse::items.table.supplier'),
                'searchable' => true,
                'orderable' => true,
                // 'render' => 'function(){}',
                'footer' => trans('warehouse::items.table.supplier'),
                'exportable' => true,
                'printable' => true,
                'visible' => true,
        ],
        'suppliers' => [
                'name' => 'suppliers',
                'data' => 'suppliers',
                'title' => trans('warehouse::items.table.suppliers'),
                'searchable' => true,
                'orderable' => true,
                // 'render' => 'function(){}',
                'footer' => trans('warehouse::items.table.suppliers'),
                'exportable' => true,
                'printable' => true,
                'visible' => true,
                ],
        'documentation_number' => [
                'name' => 'documentation_number',
                'data' => 'documentation_number',
                'title' => trans('warehouse::items.table.documentation_number'),
                'searchable' => true,
                'orderable' => true,
                // 'render' => 'function(){}',
                'footer' => trans('warehouse::items.table.documentation_number'),
                'exportable' => true,
                'printable' => true,
                'visible' => true,
                ],
        'remarks' => [
                'name' => 'remarks',
                'data' => 'remarks',
                'title' => trans('warehouse::items.table.remarks'),
                'searchable' => true,
                'orderable' => true,
                // 'render' => 'function(){}',
                'footer' => trans('warehouse::items.table.remarks'),
                'exportable' => true,
                'printable' => true,
                'visible' => true,
                ],
        'photo' => [
                'name' => 'photo',
                'data' => 'photo',
                'title' => trans('warehouse::items.table.photo'),
                'searchable' => false,
                'orderable' => false,
                'footer' => trans('warehouse::items.table.photo'),
                'exportable' => true,
                'printable' => true,
        ],
        'url' => [
                'name' => 'url',
                'data' => 'url',
                'title' => trans('warehouse::items.table.url'),
                'searchable' => false,
                'orderable' => false,              
                'footer' => trans('warehouse::items.table.url'),
                'exportable' => true,
                'printable' => true,
                'visible' => true,
                ],
        'action' => [
                'defaultContent' => '',
                'data'           => 'action',
                'name'           => 'action',
                'title'          => trans('warehouse::items.table.action'),
                'render'         => null,
                'orderable'      => false,
                'searchable'     => false,
                'exportable'     => false,
                'printable'      => true,
                'footer'         => trans('warehouse::items.table.action'),
                ],
        ];
        if (is_object($settings)) {
            if ($frontend && $settings->item_guest_disabled_fields) {
                return array_only($collumns,$settings->item_guest_disabled_fields);
            }
            return array_only($collumns,$settings->disiabled_fileds);
        }
        if(is_array($settings)){
            return array_only($collumns,$settings);
        }
        return $collumns;
    }
}
