<?php

namespace App;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;

class CPlatformUsed extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope());
    }
    public function c_platforms()
    {
        return $this->belongsTo('App\CPlatform', 'platform_id', 'id');
    }
}
