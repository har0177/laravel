<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
class Application extends Model implements HasMedia
{
  use HasFactory, InteractsWithMedia;
  
  protected $guarded = [];
  protected $casts   = [
    'quota' => 'json'
  ];
  
  protected $with = [ 'project' ];
  
  public function project()
  {
    return $this->belongsTo( Project::class );
  }
  
  public function user()
  {
    return $this->belongsTo( User::class );
  }
  
  public function getquotaNameAttribute()
  {
    $list = [];
    foreach( $this->quota as $quota ) {
      $list[] = Taxonomy::where( 'id', (int) $quota )->first()?->name;
    }
    return $list;
  }
}
