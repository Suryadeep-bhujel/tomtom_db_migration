<?php

namespace App\Models;

 
use Jenssegers\Mongodb\Eloquent\Model;
class CategoryCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'categories';
    protected $primaryKey = '_id';
    protected $guarded = false;
}
