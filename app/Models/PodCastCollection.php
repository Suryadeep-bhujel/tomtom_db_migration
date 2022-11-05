<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class PodCastCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'podcasts';
    protected $primaryKey = '_id';
    protected $guarded = false;
}
