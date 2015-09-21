<?php

namespace ProAI\DatamapperPresenter;

use Illuminate\Support\ServiceProvider;
use ProAI\DatamapperPresenter\Presenter\Repository;
use ProAI\DatamapperPresenter\Presenter\Decorator;

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

        $app['view']->composer('*', function ($view) use ($app) {
            $data = array_merge($view->getFactory()->getShared(), $view->getData());

            foreach ($data as $key => $item) {
                $view[$key] = Decorator::decorate($item);
            }
        });
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

        $this->app->register('ProAI\DatamapperPresenter\Providers\CommandsServiceProvider');
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

        $this->publishes([$configPath => config_path('datamapper.php')], 'config');
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

    /**
     * Register the scanner implementation.
     *
     * @return void
     */
    protected function registerScanner()
    {
        $this->app->singleton('datamapper.presenter.scanner', function ($app) {
            $reader = $app['datamapper.annotationreader'];

            return new PresenterScanner($reader);
        });
    }

    /**
     * Register all of the migration commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        // create singletons of each command
        $commands = array('Register', 'Clear');

        foreach ($commands as $command) {
            $this->{'register'.$command.'Command'}();
        }

        // register commands
        $this->commands(
            'command.presenter.register',
            'command.presenter.clear'
        );
    }

    /**
     * Register the "presenter:register" command.
     *
     * @return void
     */
    protected function registerRegisterCommand()
    {
        $this->app->singleton('command.presenter.register', function ($app) {
            return new PresenterRegisterCommand(
                $app['datamapper.classfinder'],
                $app['datamapper.presenter.scanner'],
                $app['datamapper.presenter.repository'],
                $app['config']['datamapper']
            );
        });
    }

    /**
     * Register the "presenter:clear" command.
     *
     * @return void
     */
    protected function registerClearCommand()
    {
        $this->app->singleton('command.presenter.clear', function ($app) {
            return new PresenterClearCommand(
                $app['datamapper.classfinder'],
                $app['datamapper.presenter.scanner'],
                $app['datamapper.presenter.repository'],
                $app['config']['datamapper']
            );
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'datamapper.presenter.scanner',
            'command.presenter.register',
            'command.presenter.clear'
        ];
    }
}
