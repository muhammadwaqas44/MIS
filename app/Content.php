<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $guarded = [];

    public function c_history()
    {
        return $this->hasMany('App\CHistory', 'plan_id', 'id');
    }

    public function c_history_process()
    {
        return $this->hasMany('App\CHistory', 'plan_id', 'id')->where('type_module', 1);
    }

    public function c_history_seo()
    {
        return $this->hasMany('App\CHistory', 'plan_id', 'id')->where('type_module', 2);
    }

    public function c_history_original()
    {
        return $this->hasMany('App\CHistory', 'plan_id', 'id')->where('type_module', null);
    }

    public function c_platformsUsed()
    {
        return $this->hasMany('App\CPlatformUsed', 'plan_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

    public function produceBy()
    {
        return $this->belongsTo('App\Employee', 'produce_by', 'id');
    }

    public function processBy()
    {
        return $this->belongsTo('App\Employee', 'process_by', 'id');
    }

    public function publishBy()
    {
        return $this->belongsTo('App\Employee', 'publish_by', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\ContentType', 'category_id', 'id');
    }

    public function media()
    {
        return $this->hasMany('App\CMedia', 'plan_id', 'id');
    }

    public function mediaYoutube()
    {
        return $this->hasMany('App\CMedia', 'plan_id', 'id')->where('platform_id', 2);
    }

    public function youtube()
    {
        return $this->hasOne('App\CYoutube', 'plan_id', 'id');
    }

}
