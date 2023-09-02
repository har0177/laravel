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
    Schema::create( 'merit_lists', function( Blueprint $table ) {
      $table->id();
      $table->bigInteger( 'merit_number' );
      $table->unsignedBigInteger( 'user_id' );
      $table->unsignedBigInteger( 'quota_id' )->nullable();
      $table->unsignedBigInteger( 'district_id' )->nullable();
      $table->string( 'status' )->default( 'Not Admitted' );
      $table->timestamps();
    } );
  }
  
  /**
   * Reverse the migrations.
   */
  public function down() : void
  {
    Schema::dropIfExists( 'merit_lists' );
  }
};
