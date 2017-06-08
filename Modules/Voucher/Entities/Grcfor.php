<?php

namespace Modules\Voucher\Entities;

 use Illuminate\Database\Eloquent\Model;

class Grcfor extends Model
{
 
    protected $table = 'voucher__grcfors';
    public $translatedAttributes = [];
    protected $fillable = ['GRCFOR_MODFOR','GRCFOR_CODFOR','GRCFOR_DESCRP'];
}
