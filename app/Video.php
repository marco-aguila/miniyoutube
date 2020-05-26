<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Video extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status', 'path_video', 'description',
    ];

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
