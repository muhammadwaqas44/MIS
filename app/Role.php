<?php

namespace App;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope());
    }
}
