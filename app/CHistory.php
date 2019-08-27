<?php

namespace App;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CHistory extends Model
{
    protected $guarded = [];
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope());
    }

    public function c_status()
    {
        return $this->belongsTo('App\CStatus', 'c_status_id', 'id');
    }

    public function content()
    {
        return $this->belongsTo('App\Content', 'content_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
