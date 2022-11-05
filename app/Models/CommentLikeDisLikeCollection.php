<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class CommentLikeDisLikeCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'comment_like_dislikes';
    protected $primaryKey = '_id';
    protected $guarded = false;
}
