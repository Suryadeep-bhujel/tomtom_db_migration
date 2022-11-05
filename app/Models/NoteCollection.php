<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class NoteCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'notes';
    protected $primaryKey = '_id';
    protected $guarded = false;
}
