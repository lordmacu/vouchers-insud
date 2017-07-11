<?php

namespace Modules\Voucher\Entities;

 use Illuminate\Database\Eloquent\Model;

class Pvmprh extends Model
{
  
    protected $table = 'voucher__pvmprhs';
    public $translatedAttributes = [];
    protected $fillable = ['PVMPRH_NROCTA','PVMPRH_NOMBRE','PVMPRH_NRODOC'];


    public function validateCuit ($nrodoc){

    	return $this->where("PVMPRH_NRODOC",$nrodoc)->get();

    }


    public function searchByName($q){
    	return $this->where("PVMPRH_NOMBRE","LIKE","%".$q."%")->get();
    }
}
