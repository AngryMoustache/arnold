<?php

namespace AngryMoustache\Arnold;

use AngryMoustache\Arnold\Http\Livewire\PageArchitectLivewireField;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class PageArchitectServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->config();
        $this->livewire();
        $this->publishing();
        $this->views();
    }

    public function register()
    {
        //
    }

    private function config()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/arnold.php', 'arnold');
    }

    private function livewire()
    {
        Livewire::component('arnold-livewire-field', PageArchitectLivewireField::class);
    }

    private function publishing()
    {
        $this->publishes([
            __DIR__ . '/../config/arnold.php' => config_path('arnold.php'),
        ], 'arnold-config');

        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/arnold'),
        ], 'arnold-views');

        $this->publishes([
            __DIR__ . '/../public/css' => public_path('vendor/arnold/css'),
        ], 'arnold-required-assets');
    }

    private function views()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'arnold');
    }
}
