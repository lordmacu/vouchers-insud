<?php

namespace Modules\Voucher\Repositories\Cache;

use Modules\Voucher\Repositories\RegistrationRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheRegistrationDecorator extends BaseCacheDecorator implements RegistrationRepository
{
    public function __construct(RegistrationRepository $registration)
    {
        parent::__construct();
        $this->entityName = 'voucher.registrations';
        $this->repository = $registration;
    }
}
