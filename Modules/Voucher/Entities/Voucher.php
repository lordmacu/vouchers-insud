<?php

namespace Modules\Voucher\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use Translatable;

    protected $table = 'voucher__vouchers';
    public $translatedAttributes = [];
    protected $fillable = [];
}
