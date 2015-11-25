<?php

namespace ProAI\Datamapper\Presenter;

use Illuminate\Support\ServiceProvider;
use ProAI\Datamapper\Presenter\Presenter\Repository;
use ProAI\Datamapper\Presenter\Presenter\Decorator;

class PresenterServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $app = $this->app;
        
        if(! empty($app['config']['datamapper.auto_present'])) {

            $app['view']->composer('*', function ($view) use ($app) {
                $data = array_merge($view->getFactory()->getShared(), $view->getData());

                foreach ($data as $key => $item) {
                    $view[$key] = Decorator::decorate($item);
                }
            });
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();

        $this->registerPresenters();

        $this->app->register('ProAI\Datamapper\Presenter\Providers\CommandsServiceProvider');
    }

    /**
     * Register the config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $configPath = __DIR__ . '/../config/datamapper.php';

        $this->mergeConfigFrom($configPath, 'datamapper');

        $this->publishes([$configPath => config_path('datamapper.php')], 'datamapper');
    }

    /**
     * Register all presenters.
     *
     * @return void
     */
    protected function registerPresenters()
    {
        $app = $this->app;

        $app->singleton('datamapper.presenter.repository', function ($app) {
            $path = $app['path.storage'] . '/framework/presenters.json';

            return new Repository($app['files'], $path);
        });

        $app['datamapper.presenter.repository']->load();
    }
}
