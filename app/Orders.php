<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
     /**
    * The attributes that are mass assignable.
    *
    * @var array 
    */
    protected $fillable = [
        'reparirmen_id','customer_id','location_service_id'
        ];

        public function serviceLocation()
        {
            return $this->belongsTo(ServicesLocations::class, 'id');
        }
    }
