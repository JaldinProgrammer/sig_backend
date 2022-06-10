<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinate extends Model
{
    protected $fillable = [
        'latitude', 'longitude', 'bus_id','status',
    ];
}


//$table->float('latitude');
//$table->float('longitude');
//$table->foreignId('busId')->constrained('buses');
//$table->boolean('status')->default(true);
