<?php

namespace Modules\Voucher\Entities;
use Illuminate\Database\Eloquent\SoftDeletes; // <-- This is required

 use Illuminate\Database\Eloquent\Model;

class HeadRegistration extends Model
{
 
    protected $table = 'voucher__registrations__head';
    public $translatedAttributes = [];
    protected $fillable = [];
    protected $guarded = array();
    use SoftDeletes; // <-- Use This Instead Of SoftDeletingTrait


  	public function registrations()
    {
        return $this->hasMany("Modules\\Voucher\\Entities\\Registration","REGIST_CABITM","id");
    }

     public function cgmsbcs()
    {
        return $this->hasOne("Modules\\Voucher\\Entities\\Cgmsbc","CGMSBC_SUBCUE","CGMSBC_SUBCUE");
    }


 


        public function grcfors()
    {
        return $this->hasOne("Modules\\Voucher\\Entities\\Grcfor","GRCFOR_CODFOR","GRCFOR_CODFOR");
    }

        public function pvmprhs()
    {
        return $this->hasOne("Modules\\Voucher\\Entities\\Pvmprh","PVMPRH_NROCTA","PVMPRH_NROCTA");
    }

        public function stmpdhs()
    {
        return $this->hasOne("Modules\\Voucher\\Entities\\Stmpdh","STMPDH_TIPPRO","STMPDH_TIPPRO");
    }

    public function getHeaderExist($pvmprh,$grcfor,$nrofor,$payment_method){
        return $this
        ->where("PVMPRH_NROCTA",$pvmprh)
        ->where("GRCFOR_CODFOR",$grcfor)
        ->where("REGIST_NROFOR",$nrofor)
        ->where("REGIST_NROFOR",$nrofor)
        ->where("payment_method",$payment_method)
        ->get();
    }
}
