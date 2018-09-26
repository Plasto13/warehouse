<?php

namespace Modules\Warehouse\Events;

use Modules\Core\Contracts\EntityIsChanging;
use Modules\Core\Events\AbstractEntityHook;

class WarehouseIsCreating extends AbstractEntityHook implements EntityIsChanging
{
}