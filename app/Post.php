<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    /**
     *  MASS ASSIGN
     */ 

     protected $fillable =[
         'title',
         'body',
         'slug',
         'path_img'
     ];

     /**
      * Db Relations
      */

      // Posts - Tags
      public function tags(){
          return $this->belongsToMany('App\Tag');
      }
}
