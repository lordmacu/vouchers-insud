<?php

namespace Modules\Voucher\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface GrcforRepository extends BaseRepository
{
	    public function findByAttributes(array $attributes);

}
