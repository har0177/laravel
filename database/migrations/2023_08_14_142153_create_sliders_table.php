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
    Schema::create( 'slides', function( Blueprint $table ) {
      $table->id();
      $table->enum( 'type', [ 'video', 'image' ] );
      $table->string( 'url' )->nullable();
      $table->enum( 'status', [ 'Show', 'Hide' ] )->default( 'Show' );
      $table->timestamps();
    } );
  }
  
  /**
   * Reverse the migrations.
   */
  public function down() : void
  {
    Schema::dropIfExists( 'slides' );
  }
};
