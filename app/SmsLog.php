<?php

namespace App;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmsLog extends Model
{
    protected $guarded = [];
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope());
    }

    public function sentBy()
    {
        return $this->belongsTo('App\User', 'sent_by', 'id');
    }
}
