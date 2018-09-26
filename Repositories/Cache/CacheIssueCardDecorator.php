<?php

namespace Modules\Warehouse\Repositories\Cache;

use Modules\Warehouse\Repositories\IssueCardRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheIssueCardDecorator extends BaseCacheDecorator implements IssueCardRepository
{
    public function __construct(IssueCardRepository $issuecard)
    {
        parent::__construct();
        $this->entityName = 'warehouse.issuecards';
        $this->repository = $issuecard;
    }
}
