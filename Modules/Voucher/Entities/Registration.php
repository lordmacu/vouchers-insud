<?php

namespace Modules\Voucher\Entities;

 use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // <-- This is required

class Registration extends Model
{
 	protected $guarded = array();

    protected $table = 'voucher__registrations';
    public $translatedAttributes = [];
    protected $fillable = [];
    use SoftDeletes; // <-- Use This Instead Of SoftDeletingTrait
    

     public function cgmsbcs()
    {
        return $this->hasOne("Modules\\Voucher\\Entities\\Cgmsbc","CGMSBC_SUBCUE","CGMSBC_SUBCUE");
    }


        public function grcfors()
    {
        return $this->hasOne("Modules\\Voucher\\Entities\\Grcfor","GRCFOR_MODFOR","GRCFOR_MODFOR");
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
        return $this->hasOne("Modules\\Voucher\\Entities\\Stmpdh","STMPDH_ARTCOD","STMPDH_ARTCOD");
    }


    public function getVouchersPerHeaderId($id){
        return $this->where("REGIST_CABITM",$id)->count();
    }
}
