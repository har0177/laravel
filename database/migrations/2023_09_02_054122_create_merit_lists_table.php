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
      $table->bigInteger( 'merit_number' )->nullable();
      $table->unsignedBigInteger( 'project_id' );
      $table->unsignedBigInteger( 'user_id' );
      $table->unsignedBigInteger( 'quota_id' )->nullable();
      $table->bigInteger( 'district_number' )->nullable();
      $table->unsignedBigInteger( 'district_id' )->nullable();
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
