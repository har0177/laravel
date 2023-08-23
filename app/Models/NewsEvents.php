<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class NewsEvents extends Model implements HasMedia
{
  use HasFactory, InteractsWithMedia, Sluggable;
  
  protected $guarded = [];
  
  public function sluggable() : array
  {
    return [
      'slug' => [
        'source' => 'title'
      ]
    ];
  }
}
