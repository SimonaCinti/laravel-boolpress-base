<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoPost extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Db RELATIONS
     */

    // Infoposts - Posts  | One to One | Secondaria

    public function Post()
    {
        return $this->belongsTo('App\Post');
    }

}
