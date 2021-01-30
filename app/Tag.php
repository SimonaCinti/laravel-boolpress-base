<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * Db Relations
     */

    // Tags - Posts | Many to Many
    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }
}
