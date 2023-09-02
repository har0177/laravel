<?php

namespace App\Livewire;

use App\Enums\TaxonomyTypeEnum;
use App\Models\Application;
use App\Models\MeritList;
use App\Models\Taxonomy;
use App\Models\User;
use Livewire\Component;

class Merit extends Component
{
  
  public $quota        = '';
  public $district     = '';
  public $quotaList    = '';
  public $districtList = '';
  
  public function render()
  {
    $this->quotaList = Taxonomy::whereType( TaxonomyTypeEnum::QUOTA )->get();
    
    $districts = User::join( 'user_infos', 'users.id', '=', 'user_infos.user_id' )
                     ->join( 'applications', 'users.id', '=', 'applications.user_id' )
                     ->where( 'applications.status', 'Paid' ) // Filter by application status
                     ->select( 'user_infos.district_id' )
                     ->distinct()
                     ->pluck( 'user_infos.district_id' )
                     ->toArray();
    
    $this->districtList = Taxonomy::whereType( TaxonomyTypeEnum::DISTRICT )
                                  ->whereIn( 'id', $districts )
                                  ->get();
    
    return view( 'livewire.merit-lists' );
  }
  
  public function toggleSection()
  {
    $this->resetForm();
  }
  
  public function resetForm()
  {
    $this->reset( [ 'quota', 'district' ] );
  }
  
  public function generateMeritList()
  {
    if( empty( $this->quota ) && empty( $this->district ) ) {
      session()->flash( 'error', 'Please Select Quota / District to create Merit List.' );
      return false;
    }
    
    if( !empty( $this->quota ) ) {
      // Get the list of user IDs based on the specified quota.
      $userIds = Application::whereJsonContains( 'quota', $this->quota )->where( 'status',
        'Paid' )->pluck( 'user_id' )->toArray();
      
      // Fetch users and their percentages.
      $usersList = User::whereIn( 'id', $userIds )
                       ->with( [
                         'education' => function( $query ) {
                           $query->orderBy( 'percentage', 'desc' )->first();
                         }
                       ] )
                       ->get()
                       ->map( function( $user ) {
                         return [
                           'user_id'    => $user->id,
                           'percentage' => optional( $user->education->first() )->percentage,
                         ];
                       } )
                       ->sortByDesc( 'percentage' )
                       ->values()
                       ->all();
  
      MeritList::where('quota_id', $this->quota)
               ->where('status', 'Not Admitted')
               ->delete();
      foreach ($usersList as $key => $user) {
        // Check if the user's status in the MeritList is "Admitted" before creating a new entry
        $existingMeritList = MeritList::where('user_id', $user['user_id'])
                                      ->where('quota_id', $this->quota)
                                      ->first();
    
        if (!$existingMeritList || $existingMeritList->status !== 'Admitted') {
          MeritList::updateOrCreate(
            [
              'user_id' => $user['user_id'],
              'quota_id' => $this->quota,
            ],
            [
              'merit_number' => $key + 1 // Set the status from $user
            ]
          );
        }
      }
    }
    
    if( !empty( $this->district ) ) {
      // Get the list of user IDs based on the specified district_id.
      $userIds = User::whereHas( 'userInfo', function( $query ) {
        $query->where( 'district_id', $this->district );
      } )
                     ->pluck( 'id' )
                     ->toArray();
      
      // Fetch users and their percentages.
      $usersList = User::whereIn( 'id', $userIds )
                       ->whereHas( 'applications', function( $query ) {
                         $query->where( 'status', 'Paid' );
                       } )
                       ->with( [
                         'education' => function( $query ) {
                           $query->orderBy( 'percentage', 'desc' )->first();
                         },
                       ] )
                       ->get()
                       ->map( function( $user ) {
                         return [
                           'user_id'    => $user->id,
                           'percentage' => optional( $user->education->first() )->percentage,
                         ];
                       } )
                       ->sortByDesc( 'percentage' )
                       ->values()
                       ->all();
  
  
      MeritList::where('district_id', $this->district)
               ->where('status', 'Not Admitted')
               ->delete();
      foreach ($usersList as $key => $user) {
        // Check if the user's status in the MeritList is "Admitted" before creating a new entry
        $existingMeritList = MeritList::where('user_id', $user['user_id'])
                                      ->where('district_id', $this->district)
                                      ->first();
    
        if (!$existingMeritList || $existingMeritList->status !== 'Admitted') {
          MeritList::updateOrCreate(
            [
              'user_id' => $user['user_id'],
              'district_id'  => $this->district,
            ],
            [
              'merit_number' => $key + 1 // Set the status from $user
            ]
          );
        }
      }
      
    }
    session()->flash( 'success', 'Merit List created Successfully.' );
  }
  
}
