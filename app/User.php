<?php

namespace App;

use App\Scopes\ActiveScope;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'user_phone', 'skype_no', 'landline_no', 'address', 'gender', 'profile_image', 'is_active',
        'city_id', 'state_id', 'country_id', 'role_id'
    ];
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope());
    }

    public function role()
    {
        return $this->belongsTo('App\Role', 'role_id', 'id');
    }

    public function getProfileImageAttribute($profile_image)
    {

        if ($profile_image != null) {
            return asset($profile_image);
        } else {
            return asset('images/user.png');
        }

    }

    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
