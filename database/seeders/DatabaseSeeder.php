<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run() : void
  {
    // \App\Models\User::factory(10)->create();
    
    \App\Models\User::create( [
      'first_name' => 'Haroon',
      'last_name'  => 'Yousaf',
      'email'      => 'admin@admin.com',
      'username'   => 'har0177',
      'phone'      => '03339471086',
      'role_id'    => User::ROLE_ADMIN,
      'password'   => Hash::make( 'admin' ),
    ] );
  }
}
