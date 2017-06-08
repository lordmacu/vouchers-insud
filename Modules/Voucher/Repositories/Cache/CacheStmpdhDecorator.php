<?php

namespace Modules\Voucher\Repositories\Cache;

use Modules\Voucher\Repositories\StmpdhRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheStmpdhDecorator extends BaseCacheDecorator implements StmpdhRepository
{
    public function __construct(StmpdhRepository $stmpdh)
    {
        parent::__construct();
        $this->entityName = 'voucher.stmpdhs';
        $this->repository = $stmpdh;
    }
}
