<?php

namespace Modules\Voucher\Entities;

 use Illuminate\Database\Eloquent\Model;

class HeadRegistration extends Model
{
 
    protected $table = 'voucher__registrations__head';
    public $translatedAttributes = [];
    protected $fillable = [];
    protected $guarded = array();


  	public function registrations()
    {
        return $this->hasMany("Modules\\Voucher\\Entities\\Registration","REGIST_CABITM","id");
    }

     public function cgmsbcs()
    {
        return $this->hasOne("Modules\\Voucher\\Entities\\Cgmsbc","CGMSBC_CODDIM","CGMSBC_CODDIM");
    }
}
