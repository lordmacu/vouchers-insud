<?php

namespace Modules\Voucher\Repositories\Cache;

use Modules\Voucher\Repositories\UserRegistrationRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheUserRegistrationDecorator extends BaseCacheDecorator implements UserRegistrationRepository
{
    public function __construct(UserRegistrationRepository $userregistration)
    {
        parent::__construct();
        $this->entityName = 'voucher.userregistrations';
        $this->repository = $userregistration;
    }
}
