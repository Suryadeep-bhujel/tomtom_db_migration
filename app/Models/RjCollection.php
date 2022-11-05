<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class RjCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'rjs';
    protected $primaryKey = '_id';
    protected $guarded = false;
}
