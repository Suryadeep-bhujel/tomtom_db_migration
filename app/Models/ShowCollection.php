<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class ShowCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'shows';
    protected $primaryKey = '_id';
    protected $guarded = false;
}
