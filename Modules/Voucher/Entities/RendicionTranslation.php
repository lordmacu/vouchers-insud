<?php

namespace Modules\Voucher\Entities;

use Illuminate\Database\Eloquent\Model;

class RendicionTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'voucher__rendicion_translations';
}
