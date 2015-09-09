<?php namespace GPUG\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer(
            'layouts.master', 'GPUG\Http\ViewComposers\LayoutComposer'
        );
    }

    public function register()
    {

    }
}