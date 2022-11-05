<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class PodcastBookmarkCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'podcast_bookmarks';
    protected $primaryKey = '_id';
    protected $guarded = false;
}
