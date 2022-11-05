<?php

namespace App\Models;

 
use Jenssegers\Mongodb\Eloquent\Model;

class LanguageCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'languages';
    protected $primaryKey = '_id';
    protected $guarded = false;
}
