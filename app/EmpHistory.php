<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpHistory extends Model
{
    protected $fillable = ['remarks', 'job_id','user_id', 'call_id', 'dateTime', 'is_active','created_at'];
    use SoftDeletes;

    public function applicant()
    {
        return $this->belongsTo('App\JobApplication', 'job_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo('App\CallStatus', 'call_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
