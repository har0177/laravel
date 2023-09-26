<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up() : void
  {
    Schema::create( 'employees', function( Blueprint $table ) {
      $table->id()->autoIncrement();
      $table->text( 'full_name' );
      $table->text( 'father_name' );
      $table->text( 'designation' );
      $table->text( 'bps' );
      $table->text( 'personal_number' );
      $table->text( 'contact_number' );
      $table->text( 'emergency_number' )->nullable();
      $table->text( 'nic' );
      $table->text( 'dob' );
      $table->text( 'address' );
      $table->string( 'image' )->nullable( true );
      $table->unsignedBigInteger( 'blood_group_id' )->nullable();
      $table->unsignedBigInteger( 'gender_id' )->nullable();
      $table->boolean( 'status' )->default( 1 );
      $table->timestamps();
    } );
  }
  
  /**
   * Reverse the migrations.
   */
  public function down() : void
  {
    Schema::dropIfExists( 'employees' );
  }
};
