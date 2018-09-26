<?php

namespace Modules\Warehouse\Repositories\Eloquent;

use Modules\Warehouse\Repositories\WarehouseRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Warehouse\Events\WarehouseIsCreating;
use Modules\Warehouse\Events\WarehouseWasCreated;

class EloquentWarehouseRepository extends EloquentBaseRepository implements WarehouseRepository
{
	 public function create($data)
    {
        event($event = new WarehouseIsCreating($data));
        $tag = $this->model->create($event->getAttributes());

        event(new WarehouseWasCreated($tag));

        return $tag;
    }
}
