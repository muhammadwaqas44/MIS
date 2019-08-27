<?php

namespace App;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventHis extends Model
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

    public function employeeName()
    {
        return $this->belongsTo('App\Employee', 'employee_id', 'id');
    }
  public function StatusName()
    {
        return $this->belongsTo('App\InventoryStatus', 'status_id', 'id');
    }

}
