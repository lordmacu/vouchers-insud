<?php

namespace Modules\Voucher\Entities;

 use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
 	protected $guarded = array();

    protected $table = 'voucher__registrations';
    public $translatedAttributes = [];
    protected $fillable = [];


     public function cgmsbcs()
    {
        return $this->hasOne("Modules\\Voucher\\Entities\\Cgmsbc","CGMSBC_CODDIM","CGMSBC_CODDIM");
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
