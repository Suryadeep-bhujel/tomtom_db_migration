<?php

namespace App\Models;

 
use Jenssegers\Mongodb\Eloquent\Model;
class CountryCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'countries';
    protected $primaryKey = '_id';
    protected $guarded = false;
}
