<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Taxonomy extends Model
{
  use HasFactory, SoftDeletes;
  
  const DIPLOMA    = 'diploma';
  const SECTION    = 'section';
  const SESSION    = 'session';
  const DEGREE     = 'degree';
  const BLOODGROUP = 'bloodGroup';
  const GENDER     = 'gender';
  const DISTRICT   = 'district';
  const QUOTA      = 'quota';
  
  protected $fillable = [ 'type', 'name', 'parent_id' ];
  
  public function parent()
  {
    return $this->belongsTo( self::class, 'parent_id' );
  }
  
}
