<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class TomtomModel extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'related_products';
     
    // protected $primaryKey = 'id';
}
