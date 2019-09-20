<?php

namespace App;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;

class CYoutube extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope());
    }

    public function license()
    {
        return $this->belongsTo('App\CStatus', 'license_id', 'id');

    }public function viewAccess()
    {
        return $this->belongsTo('App\CStatus', 'view_access_id', 'id');

    }
}
