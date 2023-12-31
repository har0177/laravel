<?php

namespace App\Models;

use App\Enums\TaxonomyTypeEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
  use HasFactory;
  
  protected $dates = [ 'deleted_at' ];
  
  protected $fillable = [
    'id,', 'degree_id', 'board',
    'obtained_marks', 'total_marks',
    'percentage',
    'result_declaration_date',
    'grade',
    'roll_number',
    'user_id'
  ];
  
  public function degree()
  {
    return $this->belongsTo( Taxonomy::class, 'degree_id', 'id' )->whereType( TaxonomyTypeEnum::DEGREE );
  }
  
}