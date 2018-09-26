<?php

namespace Modules\Warehouse\Repositories\Cache;

use Modules\Warehouse\Repositories\SettingsRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheSettingsDecorator extends BaseCacheDecorator implements SettingsRepository
{
    public function __construct(SettingsRepository $settings)
    {
        parent::__construct();
        $this->entityName = 'warehouse.settings';
        $this->repository = $settings;
    }
}
