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
    Schema::create( 'projects', function( Blueprint $table ) {
      $table->id();
      $table->unsignedBigInteger( 'diploma_id' );
      $table->double( 'fee' );
      $table->json( 'quota' );
      $table->timestamp( 'expiry_date' );
      $table->longText( 'description' );
      $table->timestamps();
    } );
  }
  
  /**
   * Reverse the migrations.
   */
  public function down() : void
  {
    Schema::dropIfExists( 'projects' );
  }
};
