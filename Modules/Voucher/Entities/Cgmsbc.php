<?php

namespace Modules\Voucher\Entities;

 use Illuminate\Database\Eloquent\Model;

class Cgmsbc extends Model
{
 
    protected $table = 'voucher__cgmsbcs';
    public $translatedAttributes = [];
    protected $fillable = ['CGMSBC_CODDIM','CGMSBC_SUBCUE','CGMSBC_DESCRP'];

    public function registrations()
    {
        return $this->hasMany("Modules\\Voucher\\Entities\\Registration","CGMSBC_SUBCUE","CGMSBC_SUBCUE");
    }
}
