<?php

namespace Modules\Warehouse\Repositories\Cache;

use Modules\Warehouse\Repositories\MachinePartRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheMachinePartDecorator extends BaseCacheDecorator implements MachinePartRepository
{
    public function __construct(MachinePartRepository $machinepart)
    {
        parent::__construct();
        $this->entityName = 'warehouse.machineparts';
        $this->repository = $machinepart;
    }
}
