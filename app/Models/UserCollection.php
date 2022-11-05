<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\HasMany;
use Jenssegers\Mongodb\Relations\HasOne;

class UserCollection extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'users';
    protected $primaryKey = '_id';
    protected $guarded = false;
    public function rj(): HasMany
    {
        return $this->hasMany(RjCollection::class, 'user_id', "_id");
    }
    public function rjInfo() 
    {
        return $this->hasOne(RjCollection::class, "user_id", "_id");
    }
}
