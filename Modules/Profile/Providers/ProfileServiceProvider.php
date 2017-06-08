<?php

namespace Modules\Profile\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;

class ProfileServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
    }

    public function boot()
    {
        $this->publishConfig('profile', 'permissions');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Profile\Repositories\ProfileRepository',
            function () {
                $repository = new \Modules\Profile\Repositories\Eloquent\EloquentProfileRepository(new \Modules\Profile\Entities\Profile());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Profile\Repositories\Cache\CacheProfileDecorator($repository);
            }
        );
// add bindings

    }
}
