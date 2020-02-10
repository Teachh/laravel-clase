<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
      'title',
      'year',
      'director',
      'poster',
      'synopsis'
    ];

    public function reviews()
    {
      return $this->hasMany('App\Review');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function users()
    {
      return $this->belongsToMany('App\User')->withPivot('id','user_id','movie_id');
    }
}
