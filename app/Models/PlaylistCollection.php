<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class PlaylistCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'playlist_folders';
    protected $primaryKey = '_id';
    protected $guarded = false;
}
