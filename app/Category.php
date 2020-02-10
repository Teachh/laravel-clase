<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
      'title',
      'description',
      'adult'
    ];
    public function movies()
    {
      return $this->hasMany('App\Movie');
    }
}
