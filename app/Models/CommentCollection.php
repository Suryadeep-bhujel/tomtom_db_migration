<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class CommentCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'comments';
    protected $primaryKey = '_id';
    protected $guarded = false;
}
