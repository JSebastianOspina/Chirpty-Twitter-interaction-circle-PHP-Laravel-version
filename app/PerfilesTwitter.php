<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerfilesTwitter extends Model
{
    function AppsTwitter(){
        return belongsTo('App\AppsTwitter');
    }
}
