<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\Slide;
use Livewire\Component;

class HomePage extends Component
{
  
  public $carouselItems = [];
  public $projects      = [];
  
  public function mount()
  {
    
    $this->projects = Project::where( 'expiry_date', '>', now() )->get();
    // Simulating dynamic data for carousel items
    $this->carouselItems = [
      [
        'type' => 'video',
        'url'  => 'https://www.youtube.com/embed/B-Nt6ohJDqY?rel=0',
      ],
      [
        'type' => 'image',
        'url'  => 'images/1.webp',
      ],
      [
        'type' => 'image',
        'url'  => 'images/1 (1).webp',
      ],
      // Add more items as needed...
    ];
    
    $carouselItemsData = Slide::whereStatus( 'show' )->get();
    
    $this->carouselItems = $carouselItemsData->map( function( $item ) {
      $url = $item->url;
      if( $item->type === 'image' ) {
        $url = $item->hasMedia( 'slides' ) ? $item->getFirstMediaUrl( 'slides' ) : '';
      }
      if( !empty( $url ) ) {
        return [
          'type' => $item->type,
          'url'  => $url,
        ];
      }
    } )->toArray();
  }

  public function render()
  {
    return view( 'livewire.home-page' );
  }
}
