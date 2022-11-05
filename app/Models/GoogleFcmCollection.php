<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class GoogleFcmCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'google_fcms';
    protected $primaryKey = '_id';
    protected $guarded = false;
}
