<?php

namespace App\Livewire;

use App\Models\Slider;
use Livewire\Component;

class HomePage extends Component
{
  
  public $openModel     = false;
  public $carouselItems = [];
  
  public function mount()
  {
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
    
    $carouselItemsData = Slider::whereStatus( 'show' )->get();
    
    $this->carouselItems = $carouselItemsData->map( function( $item ) {
      $url = $item->url;
      if( $item->type === 'image' ) {
        $url = $item->hasMedia( 'slider' ) ? $item->getFirstMediaUrl( 'slider' ) : '';
      }
      if( !empty( $url ) ) {
        return [
          'type' => $item->type,
          'url'  => $url,
        ];
      }
    } )->toArray();
  }
  
  public function dismissModel()
  {
    $this->openModel = false;
  }
  
  public function render()
  {
    return view( 'livewire.home-page' );
  }
}
