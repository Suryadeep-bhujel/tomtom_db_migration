<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class NotificationCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'notifications';
    protected $primaryKey = '_id';
    protected $guarded = false;
}
