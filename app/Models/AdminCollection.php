<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
class AdminCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'admins';
    protected $primaryKey = '_id';
    protected $guarded = false;
}
