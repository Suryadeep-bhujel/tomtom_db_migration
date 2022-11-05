<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class PlaylistFolderFileCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'playlist_folder_files';
    protected $primaryKey = '_id';
    protected $guarded = false;
}
