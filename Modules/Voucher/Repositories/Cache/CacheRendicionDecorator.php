<?php

namespace Modules\Voucher\Repositories\Cache;

use Modules\Voucher\Repositories\RendicionRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheRendicionDecorator extends BaseCacheDecorator implements RendicionRepository
{
    public function __construct(RendicionRepository $rendicion)
    {
        parent::__construct();
        $this->entityName = 'voucher.rendicions';
        $this->repository = $rendicion;
    }
}
