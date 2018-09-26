<?php

namespace Modules\Warehouse\Repositories\Cache;

use Modules\Warehouse\Repositories\ItemRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheItemDecorator extends BaseCacheDecorator implements ItemRepository
{
    public function __construct(ItemRepository $item)
    {
        parent::__construct();
        $this->entityName = 'warehouse.items';
        $this->repository = $item;
    }
}
