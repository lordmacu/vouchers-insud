<?php

namespace Modules\Voucher\Entities;

 use Illuminate\Database\Eloquent\Model;

class Stmpdh extends Model
{
 
    protected $table = 'voucher__stmpdhs';
    public $translatedAttributes = [];
    protected $fillable = ['STMPDH_TIPPRO','STMPDH_ARTCOD','STMPDH_DESCRP'];
}
