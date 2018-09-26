<?php

namespace Modules\Warehouse\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface IssueCardRepository extends BaseRepository
{
	public function getCollumns($warehouse = null,$frontend = false);
}
