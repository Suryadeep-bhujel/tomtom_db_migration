<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class SmsOtpCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'smsotps';
    protected $primaryKey = '_id';
    protected $guarded = false;
}
