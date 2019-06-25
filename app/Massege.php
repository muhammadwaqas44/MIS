<?php

namespace App;


use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Massege extends Model
{
    protected $fillable = ['title', 'body', 'is_active'];
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope());
    }
}
