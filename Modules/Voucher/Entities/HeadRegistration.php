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



    public function registrationsSum($coniva)
    {
         $total=0;
         $iva=0;
        foreach ($this->registrations as $r) {
                   $total+=$r->REGIST_IMPORT*$r->REGIST_CANTID;
                   $iva = $iva+$r->REGIST_IMPIVA;

        }
        if($coniva==1){
        return "$".round($total+$iva,2);

        }else{
                    return "$".round($total,2);

        }
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
        $result=$this->hasOne("Modules\\Voucher\\Entities\\Pvmprh","id_pvmprhs","id_pvmprhs");
          if($result->count()==0){
            return $this->hasOne("Modules\\Voucher\\Entities\\Pvmprh","PVMPRH_NROCTA","PVMPRH_NROCTA");
        }else{
            return $result;
        }
    }



        public function stmpdhs()
    {
        return $this->hasOne("Modules\\Voucher\\Entities\\Stmpdh","STMPDH_TIPPRO","STMPDH_TIPPRO");
    }

    public function getHeaderExist($pvmprh,$grcfor,$nrofor,$payment_method,$comentario_voucher,$id_pvmprhs){
        return $this
        ->where("PVMPRH_NROCTA",$pvmprh)
        ->where("GRCFOR_CODFOR",$grcfor)
        ->where("REGIST_NROFOR",$nrofor)
        ->where("id_pvmprhs",$id_pvmprhs)
        ->where("payment_method",$payment_method)
        ->where("comentario_voucher",$payment_method)
        ->get();
    }

    public function getRegistrationsByStatus($status,$user){
        return $this
        ->where("USERIID",$user)
        ->where("status",$status)
         ->get();
    }
}
