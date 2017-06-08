<?php

namespace Modules\Voucher\Entities;

use Illuminate\Database\Eloquent\Model;

class StmpdhTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['STMPDH_TIPPRO','STMPDH_ARTCOD','STMPDH_DESCRP'];
    protected $table = 'voucher__stmpdh_translations';
}
