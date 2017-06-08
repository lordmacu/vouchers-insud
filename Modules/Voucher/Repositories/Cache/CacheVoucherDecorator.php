<?php

namespace Modules\Voucher\Repositories\Cache;

use Modules\Voucher\Repositories\VoucherRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheVoucherDecorator extends BaseCacheDecorator implements VoucherRepository
{
    public function __construct(VoucherRepository $voucher)
    {
        parent::__construct();
        $this->entityName = 'voucher.vouchers';
        $this->repository = $voucher;
    }
}
