<?php

namespace Modules\Voucher\Entities;

 use Illuminate\Database\Eloquent\Model;

class UsrAgrp extends Model
{
 
    protected $table = 'voucher__usr_agrp01';
    public $translatedAttributes = [];
 
     public function getUsrAgrpByid ($cod){
     	return $this->where("USR_AGRP01_CODIGO",$cod)->get();
     }
}
