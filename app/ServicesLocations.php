<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicesLocations extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array 
    */
    protected $fillable = [
        'location_id','service_id', 'price_per_houer','id',
        ];
     public function location()
    {
    return $this->belongsTo(locations::class);
    }
    public function service()
    {
    return $this->belongsTo(services::class);
    }
    public function order() 
    {
       return $this->hasMany(Orders::class);
    }
}
