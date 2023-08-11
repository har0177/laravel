<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Taxonomy;
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
    
    $role = \App\Models\Role::create( [
      'name'        => 'Admin',
      'slug'        => 'admin',
      'description' => 'Administration',
      'permissions' => [ 'manage roles' ]
    ] );
    \App\Models\User::create( [
      'first_name' => 'Super',
      'last_name'  => 'Admin',
      'email'      => 'admin@admin.com',
      'username'   => 'admin',
      'phone'      => '03333333333',
      'cnic'      => '1560200000000',
      'role_id'    => $role->id,
      'password'   => Hash::make( 'admin' ),
    ] );
    \App\Models\Role::create( [
      'name'        => 'Student',
      'slug'        => 'student',
      'description' => 'Student',
      'permissions' => []
    ] );
    
    // Diplomas
    Taxonomy::create( [ 'name' => 'Veterinary Sciences', 'type' => 'diploma' ] );
    Taxonomy::create( [ 'name' => 'Agriculture Sciences', 'type' => 'diploma' ] );
    
    // Sections
    Taxonomy::create( [ 'name' => 'DVS - I', 'type' => 'section', 'parent_id' => 1 ] );
    Taxonomy::create( [ 'name' => 'DVS - II', 'type' => 'section', 'parent_id' => 1 ] );
    Taxonomy::create( [ 'name' => 'DVS - III', 'type' => 'section', 'parent_id' => 1 ] );
    Taxonomy::create( [ 'name' => 'DAS - I', 'type' => 'section', 'parent_id' => 2 ] );
    Taxonomy::create( [ 'name' => 'DAS - II', 'type' => 'section', 'parent_id' => 2 ] );
    Taxonomy::create( [ 'name' => 'DAS - III', 'type' => 'section', 'parent_id' => 2 ] );
    
    // Sessions
    Taxonomy::create( [ 'name' => '2020-21', 'type' => 'session' ] );
    Taxonomy::create( [ 'name' => '2021-22', 'type' => 'session' ] );
    Taxonomy::create( [ 'name' => '2022-23', 'type' => 'session' ] );
    Taxonomy::create( [ 'name' => '2023-24', 'type' => 'session' ] );
    Taxonomy::create( [ 'name' => '2024-25', 'type' => 'session' ] );
    Taxonomy::create( [ 'name' => '2025-26', 'type' => 'session' ] );
    Taxonomy::create( [ 'name' => '2026-27', 'type' => 'session' ] );
    Taxonomy::create( [ 'name' => '2027-28', 'type' => 'session' ] );
    Taxonomy::create( [ 'name' => '2028-29', 'type' => 'session' ] );
    Taxonomy::create( [ 'name' => '2029-30', 'type' => 'session' ] );
    
    // Blood Groups
    Taxonomy::create( [ 'name' => 'A+ve', 'type' => 'bloodGroup' ] );
    Taxonomy::create( [ 'name' => 'A-ve', 'type' => 'bloodGroup' ] );
    Taxonomy::create( [ 'name' => 'B+ve', 'type' => 'bloodGroup' ] );
    Taxonomy::create( [ 'name' => 'B-ve', 'type' => 'bloodGroup' ] );
    Taxonomy::create( [ 'name' => 'O+ve', 'type' => 'bloodGroup' ] );
    Taxonomy::create( [ 'name' => 'O-ve', 'type' => 'bloodGroup' ] );
    Taxonomy::create( [ 'name' => 'AB+ve', 'type' => 'bloodGroup' ] );
    Taxonomy::create( [ 'name' => 'AB-ve', 'type' => 'bloodGroup' ] );
    Taxonomy::create( [ 'name' => 'N/A', 'type' => 'bloodGroup' ] );
    
    //Gender
    Taxonomy::create( [ 'name' => 'Male', 'type' => 'gender' ] );
    Taxonomy::create( [ 'name' => 'Female', 'type' => 'gender' ] );
    
    //Degree
    Taxonomy::create( [ 'name' => 'SSC', 'type' => 'degree' ] );
    Taxonomy::create( [ 'name' => 'HSSC', 'type' => 'degree' ] );
    
    //Degree
    Taxonomy::create( [ 'name' => 'Science', 'type' => 'subDegree', 'parent_id' => 30 ] );
    Taxonomy::create( [ 'name' => 'Arts', 'type' => 'subDegree', 'parent_id' => 30 ] );
    Taxonomy::create( [ 'name' => 'Pre Engineering', 'type' => 'subDegree', 'parent_id' => 31 ] );
    Taxonomy::create( [ 'name' => 'Pre Medical', 'type' => 'subDegree', 'parent_id' => 31 ] );
    
  }
}
