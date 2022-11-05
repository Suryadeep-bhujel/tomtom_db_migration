<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class GenericTokenCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'generic_tokens';
    protected $primaryKey = '_id';
    protected $guarded = false;
}
