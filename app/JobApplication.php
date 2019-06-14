<?php

namespace App;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobApplication extends Model
{
    protected $fillable = ['name', 'email', 'user_phone', 'address', 'city_name', 'resume', 'channel_id', 'designation_id', 'experience_id', 'is_active'];
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope());
    }

    public function channel()
    {
        return $this->belongsTo('App\Channel', 'channel_id', 'id');
    }

    public function designation()
    {
        return $this->belongsTo('App\Designation', 'designation_id', 'id');
    }

    public function experience()
    {
        return $this->belongsTo('App\Experience', 'experience_id', 'id');
    }
}
