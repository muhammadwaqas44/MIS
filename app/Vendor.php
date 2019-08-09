<?php

namespace App;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    protected $guarded = [];
    use SoftDeletes;


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope());
    }

    public function city()
    {
        return $this->belongsTo('App\City', 'city_id', 'id');
    }

    public function professional()
    {
        return $this->belongsTo('App\Professional', 'professional_id', 'id');
    }


    public function user()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
}
