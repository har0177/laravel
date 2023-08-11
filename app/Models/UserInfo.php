<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class UserInfo extends Model
{
  use Notifiable, SoftDeletes;
  
  protected $fillable = [
    'user_id',
    'reg_no',
    'class_no',
    'cnic',
    'father_name',
    'father_nic',
    'father_contact',
    'phone',
    'dob',
    'blood_group_id',
    'gender_id',
    'address',
    'district_id',
    'diploma_id',
    'session_id',
    'status',
    'card_status'
  ];
  
  protected $casts = [
    'created_at'     => 'datetime:m-d-Y H:i:s',
    'updated_at'     => 'datetime:m-d-Y H:i:s',
    'admission_date' => 'datetime:Y-m-d\TH:i',
  ];
  
  public function user()
  {
    return $this->belongsTo( User::class );
  }
  
  public function diploma() : BelongsTo
  {
    return $this->belongsTo( Taxonomy::class )->whereType( 'diploma' );
  }
  
  public function bloodGroup() : BelongsTo
  {
    return $this->belongsTo( Taxonomy::class )->whereType( 'bloodGroup' );
  }
  
  public function gender() : BelongsTo
  {
    return $this->belongsTo( Taxonomy::class )->whereType( 'gender' );
  }
  
  public function district() : BelongsTo
  {
    return $this->belongsTo( Taxonomy::class )->whereType( 'district' );
  }
  
  public function session() : BelongsTo
  {
    return $this->belongsTo( Taxonomy::class )->whereType( 'session' );
  }
  
}
