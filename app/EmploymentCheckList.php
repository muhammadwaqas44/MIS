<?php

namespace App;

//use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmploymentCheckList extends Model
{
    protected $guarded = [];
    use SoftDeletes;

//    protected static function boot()
//    {
//        parent::boot();
//
//        static::addGlobalScope(new ActiveScope());
//    }


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo('App\Employee', 'employee_id', 'id');
    }
}
