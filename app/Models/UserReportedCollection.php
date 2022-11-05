<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class UserReportedCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'user_reporteds';
    protected $primaryKey = '_id';
    protected $guarded = false;
}
