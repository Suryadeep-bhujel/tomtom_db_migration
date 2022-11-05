<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class ChatCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'chats';
    protected $primaryKey = '_id';
    protected $guarded = false;
}
