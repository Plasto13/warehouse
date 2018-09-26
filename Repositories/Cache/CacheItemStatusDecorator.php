<?php

namespace Modules\Warehouse\Repositories\Cache;

use Modules\Warehouse\Repositories\ItemStatusRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheItemStatusDecorator extends BaseCacheDecorator implements ItemStatusRepository
{
    public function __construct(ItemStatusRepository $itemstatus)
    {
        parent::__construct();
        $this->entityName = 'warehouse.itemstatuses';
        $this->repository = $itemstatus;
    }
}
