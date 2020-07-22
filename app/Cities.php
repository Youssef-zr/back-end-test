<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $guarded = [];
    protected $table = 'cities';


    public function times()
    {
        return $this->belongsToMany('App\deleveryTimes', 'city_deleverytimes', 'city_id', 'delevery_id')->withTimestamps()->withPivot("status");
    }

}
