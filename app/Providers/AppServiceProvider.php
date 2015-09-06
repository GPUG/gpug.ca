<?php

namespace GPUG\Providers;

use GuzzleHttp\Client as HttpClient;
use SocialNorm\Meetup\MeetupProvider;
use Illuminate\Support\ServiceProvider;
use SocialNorm\Request as SocialNormRequest;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // bind and register the SocialNorm MeetupProvider with EloquentOAuth
        $this->app->bind(MeetupProvider::class, function ($app) {
            return new MeetupProvider (
                $app['config']->get('eloquent-oauth.providers')['meetup'],
                new HttpClient(),
                new SocialNormRequest($app['request']->all())
            );
        });

        $this->app['adamwathan.oauth']->registerProvider('meetup', $this->app[MeetupProvider::class]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
