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
    Schema::create( 'education', function( Blueprint $table ) {
      $table->id();
      $table->unsignedBigInteger( 'degree_id' );
      $table->text( 'board' );
      $table->bigInteger( 'obtained_marks' );
      $table->bigInteger( 'total_marks' );
      $table->double( 'percentage' );
      $table->date( 'result_declaration_date' );
      $table->text( 'grade' );
      $table->unsignedBigInteger( 'user_id' );
      $table->timestamps();
    } );
  }
  
  /**
   * Reverse the migrations.
   */
  public function down() : void
  {
    Schema::dropIfExists( 'education' );
  }
};
