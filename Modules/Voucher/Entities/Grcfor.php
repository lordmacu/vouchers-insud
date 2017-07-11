<?php

namespace Modules\Voucher\Entities;

 use Illuminate\Database\Eloquent\Model;

class Grcfor extends Model
{
 
    protected $table = 'voucher__grcfors';
    public $translatedAttributes = [];
    protected $fillable = ['GRCFOR_MODFOR','GRCFOR_CODFOR','GRCFOR_DESCRP'];


      public function searchByName($q){
    	return $this->where("GRCFOR_DESCRP","LIKE","%".$q."%")->get();
    }
}
