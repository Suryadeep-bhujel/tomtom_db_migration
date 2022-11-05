<?php

namespace App\Models;

 
use Jenssegers\Mongodb\Eloquent\Model;
class ReportedMasterCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'master_reporteds';
    protected $primaryKey = '_id';
    protected $guarded = false;
}
