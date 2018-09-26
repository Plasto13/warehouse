<?php

namespace Modules\Warehouse\Repositories\Cache;

use Modules\Warehouse\Repositories\CostCenterRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCostCenterDecorator extends BaseCacheDecorator implements CostCenterRepository
{
    public function __construct(CostCenterRepository $costcenter)
    {
        parent::__construct();
        $this->entityName = 'warehouse.costcenters';
        $this->repository = $costcenter;
    }
}
