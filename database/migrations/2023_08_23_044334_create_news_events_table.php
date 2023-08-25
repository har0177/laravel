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
    Schema::create( 'news_events', function( Blueprint $table ) {
      $table->id();
      $table->enum( 'type', [ 'Text', 'File' ] );
      $table->text( 'title' );
      $table->string( 'slug' )->unique();
      $table->date( 'expiry_date' );
      $table->longText( 'description' )->nullable();
      $table->timestamps();
    } );
  }
  
  /**
   * Reverse the migrations.
   */
  public function down() : void
  {
    Schema::dropIfExists( 'news_events' );
  }
};