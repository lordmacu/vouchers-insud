<?php

namespace Modules\Voucher\Repositories\Cache;

use Modules\Voucher\Repositories\PvmprhRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CachePvmprhDecorator extends BaseCacheDecorator implements PvmprhRepository
{
    public function __construct(PvmprhRepository $pvmprh)
    {
        parent::__construct();
        $this->entityName = 'voucher.pvmprhs';
        $this->repository = $pvmprh;
    }
}
