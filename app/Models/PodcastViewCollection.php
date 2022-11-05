<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class PodcastViewCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'podcast_views';
    protected $primaryKey = '_id';
    protected $guarded = false;
}
