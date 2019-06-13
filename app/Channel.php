<?php

namespace App;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $guarded = [];


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope());
    }
}
