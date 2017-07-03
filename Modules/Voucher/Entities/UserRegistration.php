<?php

namespace Modules\Voucher\Entities;

 use Illuminate\Database\Eloquent\Model;

class UserRegistration extends Model
{
 
    protected $table = 'voucher__userregistrations';
    public $translatedAttributes = [];
    protected $fillable = [];


   	public function user()
	{
	    $driver = config('asgard.user.users.driver');

	    return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User");
	}




	public function getRegistrationUser($id){
		return $this->where("user_id",$id)
		
		->get();
	}



	public function getRegistrationUserId($id,$USERIID){
		return $this
		->where("user_id",$id)
		->where("USERIID",$USERIID)

		->get();
	}
}
