<?php

namespace Modules\Profile\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use Translatable;

    protected $table = 'profile__profiles';
    public $translatedAttributes = [];
    protected $fillable = [];


	    public function user()
	{
	    $driver = config('asgard.user.users.driver');

	    return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User");
	}
}
