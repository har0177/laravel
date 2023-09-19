<?php

namespace App\Livewire;

use App\Models\NewsEvents;
use App\Models\Slide;
use Livewire\Component;

class HomePage extends Component
{
  
  public $carouselItems = [];
  public $events        = [];
  
  public function mount()
  {
    $this->events = NewsEvents::where('expiry_date', '>', now())->limit(10)->get();
    
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
