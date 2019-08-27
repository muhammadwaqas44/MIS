<?php

namespace App;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    protected $guarded = [];
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope());
    }

    public function c_history()
    {
        return $this->hasOne('App\CHistory', 'content_id', 'id');
    }

    public function c_platformsUsed()
    {
        return $this->hasMany('App\CPlatformUsed', 'content_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function produceBy()
    {
        return $this->belongsTo('App\User', 'produce_by', 'id');
    }

    public function processBy()
    {
        return $this->belongsTo('App\User', 'process_by', 'id');
    }

    public function publishBy()
    {
        return $this->belongsTo('App\User', 'publish_by', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\ContentType', 'category_id', 'id');
    }
}
