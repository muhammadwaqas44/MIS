<?php

namespace App;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
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
        return $this->belongsTo('App\InventoryType', 'type_id', 'id');
    }
}
