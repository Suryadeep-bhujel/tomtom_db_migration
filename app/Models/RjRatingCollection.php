<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class RjRatingCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'rj_ratings';
    protected $primaryKey = '_id';
    protected $guarded = false;
}
