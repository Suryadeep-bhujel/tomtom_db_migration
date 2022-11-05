<?php

namespace App\Models;

 
use Jenssegers\Mongodb\Eloquent\Model;
class StateCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'states';
    protected $primaryKey = '_id';
    protected $guarded = false;
}
