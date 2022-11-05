<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class PodcastDisLikeCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'podcast_like_dislikes';
    protected $primaryKey = '_id';
    protected $guarded = false;
}
