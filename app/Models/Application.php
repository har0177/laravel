<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
  use HasFactory;
  
  protected $guarded = [];
  protected $casts   = [
    'quota' => 'json'
  ];
  
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
