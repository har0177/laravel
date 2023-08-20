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
      'permissions' => [ 'manage roles', 'manage users', 'manage students', 'manage projects', 'manage slides', 'manage events' ]
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
    Taxonomy::create( [ 'name' => 'Diploma In Veterinary Sciences', 'type' => 'diploma' ] );
    Taxonomy::create( [ 'name' => 'Diploma In Agriculture Sciences', 'type' => 'diploma' ] );
    
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
    Taxonomy::create( [ 'name' => 'Disabled Quota', 'type' => 'quota' ] );
    
    //Province
    Taxonomy::create( [ 'name' => 'Khyber Pakhtunkhwa', 'type' => 'province' ] );
    Taxonomy::create( [ 'name' => 'Gilgit Baltistan', 'type' => 'province' ] );
    
    //District
    Taxonomy::create( [ 'name' => 'Abbottabad', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Bannu', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Battagram', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Buner', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Charsadda', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Chitral Lower', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Chitral Upper', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Dera Ismail Khan', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Dir Lower', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Dir Upper	', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Hangu', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Haripur', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Kohat', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Kohistan Lower', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Kohistan Upper', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Kolai Palas	', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Lakki Marwat', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Malakand', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Mansehra', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Mardan', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Nowshera', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Peshawar', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Shangla', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Swabi', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Swat Lower', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Swat Upper', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Tor Ghar', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Bajaur', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Khyber', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Kurram', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Mohmand', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Orakzai', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'North Waziristan', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'South Waziristan', 'type' => 'district', 'parent_id' => 40 ] );
    Taxonomy::create( [ 'name' => 'Astore', 'type' => 'district', 'parent_id' => 41 ] );
    Taxonomy::create( [ 'name' => 'Darel', 'type' => 'district', 'parent_id' => 41 ] );
    Taxonomy::create( [ 'name' => 'Diamer', 'type' => 'district', 'parent_id' => 41 ] );
    Taxonomy::create( [ 'name' => 'Ghanche', 'type' => 'district', 'parent_id' => 41 ] );
    Taxonomy::create( [ 'name' => 'Ghizer', 'type' => 'district', 'parent_id' => 41 ] );
    Taxonomy::create( [ 'name' => 'Gilgit', 'type' => 'district', 'parent_id' => 41 ] );
    Taxonomy::create( [ 'name' => 'Gupis Yasin', 'type' => 'district', 'parent_id' => 41 ] );
    Taxonomy::create( [ 'name' => 'Hunza', 'type' => 'district', 'parent_id' => 41 ] );
    Taxonomy::create( [ 'name' => 'Kharmang', 'type' => 'district', 'parent_id' => 41 ] );
    Taxonomy::create( [ 'name' => 'Nagar', 'type' => 'district', 'parent_id' => 41 ] );
    Taxonomy::create( [ 'name' => 'Roundu', 'type' => 'district', 'parent_id' => 41 ] );
    Taxonomy::create( [ 'name' => 'Shigar', 'type' => 'district', 'parent_id' => 41 ] );
    Taxonomy::create( [ 'name' => 'Skardu', 'type' => 'district', 'parent_id' => 41 ] );
    Taxonomy::create( [ 'name' => 'Tangir', 'type' => 'district', 'parent_id' => 41 ] );
    
  }
}
