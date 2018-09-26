<?php

namespace Modules\Warehouse\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Warehouse\Entities\Warehouse;

class WarehouseWasCreated
{
      /**
     * @var Tag
     */
    public $warehouse;

    public function __construct(Warehouse $warehouse)
    {
        $this->warehouse = $warehouse;
    }
}
