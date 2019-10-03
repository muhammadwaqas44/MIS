<?php

namespace App;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    protected $guarded = [];
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope());
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function typeName()
    {
        return $this->belongsTo('App\ExpType', 'exp_type_id', 'id');
    }

    public function categoryName()
    {
        return $this->belongsTo('App\ExpCategory', 'expCategory_id', 'id');
    }

    public function empName()
    {
        return $this->belongsTo('App\User', 'employee_id', 'id');
    }
}
