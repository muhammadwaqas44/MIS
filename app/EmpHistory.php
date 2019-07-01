<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpHistory extends Model
{
    protected $fillable = ['remarks', 'job_id', 'call_id', 'dateTime', 'is_active'];
    use SoftDeletes;

    public function applicant()
    {
        return $this->belongsTo('App\JobApplication', 'job_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo('App\CallStatus', 'call_id', 'id');
    }
}
