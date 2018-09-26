<?php

namespace Modules\Warehouse\Repositories\Cache;

use Modules\Warehouse\Repositories\ZebraRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheZebraDecorator extends BaseCacheDecorator implements ZebraRepository
{
    public function __construct(ZebraRepository $zebra)
    {
        parent::__construct();
        $this->entityName = 'warehouse.zebras';
        $this->repository = $zebra;
    }
}
