<?php

namespace App;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Winner extends Model
{
    protected $guarded = [];
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope());
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function createdByName()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

    public function role()
    {
        return $this->belongsTo('App\Role', 'role_id', 'id');
    }

    public function statusName()
    {
        return $this->belongsTo('App\CallStatus', 'status', 'id');
    }

    public function prizeName()
    {
        return $this->belongsTo('App\Prize', 'prize', 'id');
    }
}
