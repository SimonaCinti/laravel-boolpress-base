<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // Comments - Posts  | Many to One | Principale

    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
