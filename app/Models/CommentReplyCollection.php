<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class CommentReplyCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'comment_replies';
    protected $primaryKey = '_id';
    protected $guarded = false;
}
