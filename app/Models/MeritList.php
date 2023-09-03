<?php

namespace App\Models;

use App\Enums\TaxonomyTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MeritList extends Model
{
  use HasFactory;
  
  protected $guarded = [];
  
  public function user()
  {
    return $this->belongsTo( User::class );
  }
  
  public function district() : BelongsTo
  {
    return $this->belongsTo( Taxonomy::class )->whereType( TaxonomyTypeEnum::DISTRICT );
  }
  
  public function quota() : BelongsTo
  {
    return $this->belongsTo( Taxonomy::class )->whereType( TaxonomyTypeEnum::QUOTA );
  }
  
  public function project() : BelongsTo
  {
    return $this->belongsTo( Project::class );
  }
  
}
