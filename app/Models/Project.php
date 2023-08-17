<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  use HasFactory;
  
  protected $guarded = [];
  
  protected $casts = [
    'quota' => 'json'
  ];
  
  public function diploma()
  {
    return $this->belongsTo( Taxonomy::class, 'diploma_id', 'id' )->whereType( Taxonomy::DIPLOMA );
  }
  
  public function applications()
  {
    return $this->hasMany( Application::class );
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
