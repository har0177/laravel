<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up() : void
  {
    Schema::create( 'user_infos', function( Blueprint $table ) {
      $table->id();
      $table->unsignedBigInteger( 'user_id' );
      $table->string( 'reg_no' )->unique()->nullable();
      $table->integer( 'class_no' )->nullable();
      $table->string( 'father_name' )->nullable();
      $table->string( 'father_nic' )->nullable();
      $table->string( 'father_contact' )->nullable();
      $table->date( 'dob' )->nullable();
      $table->unsignedBigInteger( 'blood_group_id' )->nullable();
      $table->unsignedBigInteger( 'gender_id' )->nullable();
      $table->text( 'address' )->nullable();
      $table->unsignedBigInteger( 'district_id' )->nullable();
      $table->timestamp( 'admission_date' )->useCurrent();
      $table->unsignedBigInteger( 'diploma_id' )->nullable();
      $table->unsignedBigInteger( 'session_id' )->nullable();
      $table->enum( 'status', [ 'Active', 'DeActive', 'Pending' ] )->default( 'Pending' );
      $table->boolean( 'card_status' )->default( 0 );
      $table->boolean( 'profile_status' )->default( 0 );
      $table->timestamps();
      $table->softDeletes();
    } );
  }
  
  /**
   * Reverse the migrations.
   */
  public function down() : void
  {
    Schema::dropIfExists( 'user_infos' );
  }
};
