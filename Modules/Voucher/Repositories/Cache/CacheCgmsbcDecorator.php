<?php

namespace Modules\Voucher\Repositories\Cache;

use Modules\Voucher\Repositories\CgmsbcRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCgmsbcDecorator extends BaseCacheDecorator implements CgmsbcRepository
{
    public function __construct(CgmsbcRepository $cgmsbc)
    {
        parent::__construct();
        $this->entityName = 'voucher.cgmsbcs';
        $this->repository = $cgmsbc;
    }
}
