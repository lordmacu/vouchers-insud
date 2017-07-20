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

	 public function areas()
    {
        return $this->hasOne("Modules\\Voucher\\Entities\\Areas","id","area");
    }



	public function getRegistrationUser($id){
		return $this->where("user_id",$id)
		->with("areas")
		->get();
	}

	public function getRegistrationUserOne($id){
		return $this->where("user_id",$id)
		->with("areas")
		->first();
	}

	public function getRegistrationUserId($id,$USERIID){
		return $this
		->where("user_id",$id)
		->where("USERIID",$USERIID)

		->get();
	}
}
