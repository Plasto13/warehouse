<?php

namespace Modules\Warehouse\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface ItemRepository extends BaseRepository
{
	public function getCollumns($warehouse = null, $frontend = false);  
}
