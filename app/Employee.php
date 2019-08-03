<?php

namespace App;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    protected $guarded = [];
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope());
    }

    public function employeePersonalDoc()
    {
        return $this->hasOne('App\EmployeePersonalDoc', 'employee_id', 'id');
    }

    public function employeeOfficialDoc()
    {
        return $this->hasOne('App\EmployeeOfficialDoc', 'employee_id', 'id');
    }

    public function applicant()
    {
        return $this->belongsTo('App\JobApplication', 'job_id', 'id');
    }

    public function designationName()
    {
        return $this->belongsTo('App\Designation', 'designation_id', 'id');
    }

    public function departmentName()
    {
        return $this->belongsTo('App\Department', 'department_id', 'id');
    }

    public function locationName()
    {
        return $this->belongsTo('App\LocationOffice', 'location_id', 'id');
    }

    public function employeeReview()
    {
        return $this->belongsTo('App\EmployeeReview', 'review_id', 'id');
    }

    public function nationalityCountry()
    {
        return $this->belongsTo('App\Country', 'nationality', 'id');
    }

    public function currentCountry()
    {
        return $this->belongsTo('App\Country', 'current_country', 'id');
    }

    public function currentCity()
    {
        return $this->belongsTo('App\City', 'current_city', 'id');
    }

    public function currentState()
    {
        return $this->belongsTo('App\State', 'current_state', 'id');
    }

    public function permanentCountry()
    {
        return $this->belongsTo('App\Country', 'permanent_country', 'id');
    }

    public function permanentCity()
    {
        return $this->belongsTo('App\City', 'permanent_city', 'id');
    }

    public function permanentState()
    {
        return $this->belongsTo('App\State', 'permanent_state', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function documentsPersonal()
    {
        return $this->hasMany(DocumentsPersonal::class, 'employee_id');
    }

    public function documentsOfficial()
    {
        return $this->hasMany(DocumentsOfficial::class, 'employee_id');
    }
}
