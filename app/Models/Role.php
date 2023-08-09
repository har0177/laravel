<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  use HasFactory;
  use Sluggable;
  
  protected $fillable = [
    'name', 'slug', 'description', 'permissions'
  ];
  
  protected $casts = [
    'permissions' => 'json'
  ];
  
  public function users()
  {
    return $this->hasMany( User::class );
  }
  
  public function sluggable() : array
  {
    return [
      'slug' => [
        'source' => 'name'
      ]
    ];
  }
  
}
