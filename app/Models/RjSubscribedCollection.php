<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class RjSubscribedCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'rj_subscribes';
    protected $primaryKey = '_id';
    protected $guarded = false;
}
