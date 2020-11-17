<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppsTwitter extends Model
{
    
    function PerfilesTwitter(){
        return $this->hasMany('App\PerfilesTwitter');
    }
}
