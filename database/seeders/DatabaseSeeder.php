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
      'cnic'       => '1560200000000',
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
    Taxonomy::create( [ 'name' => 'SSC Science', 'type' => 'degree' ] );
    Taxonomy::create( [ 'name' => 'SSC Arts', 'type' => 'degree' ] );
    Taxonomy::create( [ 'name' => 'SSC Computer Science', 'type' => 'degree' ] );
    
    //Quota
    Taxonomy::create( [ 'name' => 'Open Merit', 'type' => 'quota' ] );
    Taxonomy::create( [ 'name' => 'Female Quota', 'type' => 'quota' ] );
    Taxonomy::create( [ 'name' => 'Gilgit Baltistan Quota', 'type' => 'quota' ] );
    Taxonomy::create( [ 'name' => 'Erstwhile Fata Quota', 'type' => 'quota' ] );
    Taxonomy::create( [ 'name' => 'Employees Son Quota', 'type' => 'quota' ] );
    Taxonomy::create( [ 'name' => 'Waziristan Quota', 'type' => 'quota' ] );
    
    //District
    Taxonomy::create( [ 'name' => 'Abbottabad', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Bannu', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Battagram', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Buner', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Charsadda', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Chitral Lower', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Chitral Upper', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Dera Ismail Khan', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Dir Lower', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Dir Upper	', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Hangu', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Haripur', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Kohat', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Kohistan Lower', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Kohistan Upper', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Kolai Palas	', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Lakki Marwat', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Malakand', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Mansehra', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Mardan', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Nowshera', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Peshawar', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Shangla', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Swabi', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Swat Lower', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Swat Upper', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Tor Ghar', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Bajaur', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Khyber', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Kurram', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Mohmand', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'Orakzai', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'North Waziristan', 'type' => 'district' ] );
    Taxonomy::create( [ 'name' => 'South Waziristan', 'type' => 'district' ] );
    
  }
}
