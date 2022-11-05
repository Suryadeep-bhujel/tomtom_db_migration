<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class AddSpot extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'add_spots';
    protected $primaryKey = '_id';
    protected $guarded = false; 
     
}
