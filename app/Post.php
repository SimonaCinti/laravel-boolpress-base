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
      * Db RELATIONS
      */

      // Posts - Infoposts | One to One | Principale

      Public function infoPost(){
          return $this->hasone('App\InfoPost');
      }

      // Posts - Tags | Many to Many
      public function tags(){
          return $this->belongsToMany('App\Tag');
      }
}
