<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  use HasFactory;
  
  public function diploma()
  {
    return $this->belongsTo( Taxonomy::class, 'degree_id', 'id' )->whereType( Taxonomy::DIPLOMA );
  }
  
}
