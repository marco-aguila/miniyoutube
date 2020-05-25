<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";

      //relacion de Muchos a uno con User
      public function user()
      {
          return $this->belongsTo('App\User','user_id');
      }
}
