<?php

namespace Modules\Warehouse\Repositories\Cache;

use Modules\Warehouse\Repositories\WarehouseRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheWarehouseDecorator extends BaseCacheDecorator implements WarehouseRepository
{
    public function __construct(WarehouseRepository $warehouse)
    {
        parent::__construct();
        $this->entityName = 'warehouse.warehouses';
        $this->repository = $warehouse;
    }
}
