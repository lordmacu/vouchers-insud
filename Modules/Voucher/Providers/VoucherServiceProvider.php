<?php

namespace Modules\Voucher\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;

class VoucherServiceProvider extends ServiceProvider
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
        $this->publishConfig('voucher', 'permissions');
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
            'Modules\Voucher\Repositories\VoucherRepository',
            function () {
                $repository = new \Modules\Voucher\Repositories\Eloquent\EloquentVoucherRepository(new \Modules\Voucher\Entities\Voucher());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Voucher\Repositories\Cache\CacheVoucherDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Voucher\Repositories\PvmprhRepository',
            function () {
                $repository = new \Modules\Voucher\Repositories\Eloquent\EloquentPvmprhRepository(new \Modules\Voucher\Entities\Pvmprh());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Voucher\Repositories\Cache\CachePvmprhDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Voucher\Repositories\StmpdhRepository',
            function () {
                $repository = new \Modules\Voucher\Repositories\Eloquent\EloquentStmpdhRepository(new \Modules\Voucher\Entities\Stmpdh());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Voucher\Repositories\Cache\CacheStmpdhDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Voucher\Repositories\CgmsbcRepository',
            function () {
                $repository = new \Modules\Voucher\Repositories\Eloquent\EloquentCgmsbcRepository(new \Modules\Voucher\Entities\Cgmsbc());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Voucher\Repositories\Cache\CacheCgmsbcDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Voucher\Repositories\GrcforRepository',
            function () {
                $repository = new \Modules\Voucher\Repositories\Eloquent\EloquentGrcforRepository(new \Modules\Voucher\Entities\Grcfor());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Voucher\Repositories\Cache\CacheGrcforDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Voucher\Repositories\RegistrationRepository',
            function () {
                $repository = new \Modules\Voucher\Repositories\Eloquent\EloquentRegistrationRepository(new \Modules\Voucher\Entities\Registration());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Voucher\Repositories\Cache\CacheRegistrationDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Voucher\Repositories\UserRegistrationRepository',
            function () {
                $repository = new \Modules\Voucher\Repositories\Eloquent\EloquentUserRegistrationRepository(new \Modules\Voucher\Entities\UserRegistration());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Voucher\Repositories\Cache\CacheUserRegistrationDecorator($repository);
            }
        );
// add bindings







    }
}
