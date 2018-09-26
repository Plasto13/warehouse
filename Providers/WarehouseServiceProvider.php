<?php

namespace Modules\Warehouse\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Warehouse\Events\Handlers\RegisterWarehouseSidebar;

class WarehouseServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterWarehouseSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('warehouses', array_dot(trans('warehouse::warehouses')));
            $event->load('items', array_dot(trans('warehouse::items')));
            $event->load('issuecards', array_dot(trans('warehouse::issuecards')));
            $event->load('settings', array_dot(trans('warehouse::settings')));
            $event->load('itemstatuses', array_dot(trans('warehouse::itemstatuses')));
            $event->load('costcenters', array_dot(trans('warehouse::costcenters')));
            $event->load('machineparts', array_dot(trans('warehouse::machineparts')));
            $event->load('zebras', array_dot(trans('warehouse::zebras')));
            // append translations











        });
    }

    public function boot()
    {
        $this->publishConfig('warehouse', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
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
            'Modules\Warehouse\Repositories\WarehouseRepository',
            function () {
                $repository = new \Modules\Warehouse\Repositories\Eloquent\EloquentWarehouseRepository(new \Modules\Warehouse\Entities\Warehouse());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Warehouse\Repositories\Cache\CacheWarehouseDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Warehouse\Repositories\ItemRepository',
            function () {
                $repository = new \Modules\Warehouse\Repositories\Eloquent\EloquentItemRepository(new \Modules\Warehouse\Entities\Item());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Warehouse\Repositories\Cache\CacheItemDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Warehouse\Repositories\IssueCardRepository',
            function () {
                $repository = new \Modules\Warehouse\Repositories\Eloquent\EloquentIssueCardRepository(new \Modules\Warehouse\Entities\IssueCard());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Warehouse\Repositories\Cache\CacheIssueCardDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Warehouse\Repositories\SettingsRepository',
            function () {
                $repository = new \Modules\Warehouse\Repositories\Eloquent\EloquentSettingsRepository(new \Modules\Warehouse\Entities\Settings());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Warehouse\Repositories\Cache\CacheSettingsDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Warehouse\Repositories\ItemStatusRepository',
            function () {
                $repository = new \Modules\Warehouse\Repositories\Eloquent\EloquentItemStatusRepository(new \Modules\Warehouse\Entities\ItemStatus());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Warehouse\Repositories\Cache\CacheItemStatusDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Warehouse\Repositories\CostCenterRepository',
            function () {
                $repository = new \Modules\Warehouse\Repositories\Eloquent\EloquentCostCenterRepository(new \Modules\Warehouse\Entities\CostCenter());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Warehouse\Repositories\Cache\CacheCostCenterDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Warehouse\Repositories\MachinePartRepository',
            function () {
                $repository = new \Modules\Warehouse\Repositories\Eloquent\EloquentMachinePartRepository(new \Modules\Warehouse\Entities\MachinePart());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Warehouse\Repositories\Cache\CacheMachinePartDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Warehouse\Repositories\IssueCardSerialiserRepository',
            function () {
                $repository = new \Modules\Warehouse\Repositories\Eloquent\EloquentIssueCardSerialiserRepository(new \Modules\Warehouse\Entities\IssueCardSerialiser());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Warehouse\Repositories\Cache\CacheIssueCardSerialiserDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Warehouse\Repositories\ZebraRepository',
            function () {
                $repository = new \Modules\Warehouse\Repositories\Eloquent\EloquentZebraRepository(new \Modules\Warehouse\Entities\Zebra());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Warehouse\Repositories\Cache\CacheZebraDecorator($repository);
            }
        );
// add bindings











    }
}
