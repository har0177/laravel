<?php

namespace App\Providers;

use App\Models\Project;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register() : void
  {
    //
  }
  
  /**
   * Bootstrap any application services.
   */
  public function boot() : void
  {
    $projects = Project::where( 'expiry_date', '>', now() )->first();
    
    View::share( 'projects', $projects );
    
  }
}
