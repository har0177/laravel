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
    Schema::create( 'applications', function( Blueprint $table ) {
      $table->id();
      $table->unsignedBigInteger( 'user_id' );
      $table->unsignedBigInteger( 'project_id' );
      $table->text( 'challan_number' )->nullable();
      $table->text( 'application_number' );
      $table->enum( 'status', [ 'Pending Payment', 'Paid' ] )->default( 'Pending Payment' );
      $table->json( 'quota' );
      $table->timestamps();
    } );
  }
  
  /**
   * Reverse the migrations.
   */
  public function down() : void
  {
    Schema::dropIfExists( 'applications' );
  }
};
