<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'videos';

    //relacion OneToMany dentro de un video hay muchos comentarios
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    //relacion de Muchos a uno con User
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
