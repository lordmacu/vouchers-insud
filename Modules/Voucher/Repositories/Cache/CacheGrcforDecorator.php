<?php

namespace Modules\Voucher\Repositories\Cache;

use Modules\Voucher\Repositories\GrcforRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheGrcforDecorator extends BaseCacheDecorator implements GrcforRepository
{
    public function __construct(GrcforRepository $grcfor)
    {
        parent::__construct();
        $this->entityName = 'voucher.grcfors';
        $this->repository = $grcfor;
    }
}
