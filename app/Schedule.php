<?php

namespace App;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    protected $fillable = ['remarks','job_id','call_id','dateTime','is_active'];
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope());
    }

    public function applicant()
    {
        return $this->belongsTo('App\JobApplication', 'job_id', 'id');
    }
    public function status()
    {
        return $this->belongsTo('App\CallStatus', 'call_id', 'id');
    }
}
