<?php

namespace App;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;


class CHistory extends Model
{
    protected $guarded = [];
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
        return $this->belongsTo('App\Content', 'plan_id', 'id');
    }

    public function createdByName()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

}
