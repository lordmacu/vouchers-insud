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
        return $this->hasOne("Modules\\Voucher\\Entities\\Pvmprh","PVMPRH_NROCTA","PVMPRH_NROCTA");
    }

        public function stmpdhs()
    {
        return $this->hasOne("Modules\\Voucher\\Entities\\Stmpdh","STMPDH_TIPPRO","STMPDH_TIPPRO");
    }

}
