<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobApplication extends Model
{
    protected $fillable = ['name', 'email', 'user_phone', 'address','apply_for' ,'city_name', 'resume', 'channel_id', 'created_at','designation_id', 'experience_id', 'is_active','skype_id','expected_salary'];
    use SoftDeletes;

    public function channel()
    {
        return $this->belongsTo('App\Channel', 'channel_id', 'id');
    }

    public function designation()
    {
        return $this->belongsTo('App\Designation', 'designation_id','id');
    }

    public function experience()
    {
        return $this->belongsTo('App\Experience', 'experience_id', 'id');
    }

    public function history()
    {
        return $this->hasOne('App\EmpHistory', 'job_id', 'id');
    }
}
