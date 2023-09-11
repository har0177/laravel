<?php

namespace App\Livewire;

use App\Enums\TaxonomyTypeEnum;
use App\Models\Application;
use App\Models\MeritList;
use App\Models\Project;
use App\Models\Taxonomy;
use App\Models\User;
use Livewire\Component;
use PDF;

class Merit extends Component
{
  
  public $project      = '';
  public $projectList  = '';
  public $quotaList    = '';
  public $districtList = '';
  public $meritData    = '';
  
  public function render()
  {
    $this->projectList = Project::orderByDesc( 'id' )->get();
    
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
    if( empty( $this->project ) ) {
      session()->flash( 'error', 'Please Select Project create Merit List.' );
      return false;
    }
    
    $quota = "33";
    
    $districts = Taxonomy::whereType( TaxonomyTypeEnum::DISTRICT )
                         ->get();
    
    $quotas = Taxonomy::whereType( TaxonomyTypeEnum::QUOTA )->where( 'id', '!=', '33' )
                      ->get();
    
    // Get the list of user IDs based on the specified quota.
    $userIds = Application::whereJsonContains( 'quota', $quota )
                          ->where( 'project_id', $this->project )
                          ->where( 'status', 'Paid' )
                          ->pluck( 'user_id' )
                          ->toArray();
    
    // Fetch users and their percentages.
    $usersList = User::whereIn( 'id', $userIds )
                     ->whereHas( 'student', function( $query ) {
                       $query->where( 'status', 'Pending' );
                     } )
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
    
    // MeritList::where( 'quota_id', $quota->id )->delete();
    foreach( $usersList as $key => $user ) {
      
      MeritList::updateOrCreate(
        [
          'user_id'    => $user[ 'user_id' ],
          'project_id' => $this->project
        ],
        [
          'quota_id'     => $quota,
          'merit_number' => $key + 1 // Set the status from $user
        ]
      );
      
    }
    
    foreach( $districts as $district ) {
      // Get the list of user IDs based on the specified district_id.
      $userIds = User::whereHas( 'student', function( $query ) use ( $district ) {
        $query->where( 'district_id', $district->id )->where( 'status', 'Pending' );
      } )->pluck( 'id' )->toArray();
      
      // Fetch users and their percentages.
      $usersList = User::whereIn( 'id', $userIds )
                       ->whereHas( 'applications', function( $query ) {
                         $query->where( 'status', 'Paid' )->where( 'project_id', $this->project );
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
      
      //MeritList::where( 'district_id', $district->id )->delete();
      foreach( $usersList as $key => $user ) {
        MeritList::updateOrCreate(
          [
            'user_id'    => $user[ 'user_id' ],
            'project_id' => $this->project
          ],
          [
            'district_id'     => $district->id,
            'district_number' => $key + 1 // Set the status from $user
          ]
        );
        
      }
      
    }
    
    foreach( $quotas as $quota ) {
      // Get the list of user IDs based on the specified quota.
      $userIds = Application::whereJsonContains( 'quota', (string) $quota->id )
                            ->where( 'project_id', $this->project )
                            ->where( 'status', 'Paid' )
                            ->pluck( 'user_id' )
                            ->toArray();
      
      // Fetch users and their percentages.
      $usersList = User::whereIn( 'id', $userIds )
                       ->whereHas( 'student', function( $query ) {
                         $query->where( 'status', 'Pending' );
                       } )
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
      
      // MeritList::where( 'quota_id', $quota->id )->delete();
      foreach( $usersList as $key => $user ) {
        
        MeritList::updateOrCreate(
          [
            'user_id'    => $user[ 'user_id' ],
            'project_id' => $this->project,
            'quota_id'   => $quota->id
          ],
          [
            'merit_number' => $key + 1 // Set the status from $user
          ]
        );
        
      }
      
    }
    
    session()->flash( 'success', 'Merit List created Successfully.' );
    return $this->redirect( route( 'merit-list', [ 'project' => $this->project ] ) );
  }
  
}
