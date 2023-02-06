<?php

namespace AndyH\Datamapper\Presenter\Providers;

use Illuminate\Support\ServiceProvider;
use AndyH\Datamapper\Presenter\Metadata\PresenterScanner;
use AndyH\Datamapper\Presenter\Console\PresenterRegisterCommand;
use AndyH\Datamapper\Presenter\Console\PresenterClearCommand;

class CommandsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register('AndyH\Datamapper\Providers\MetadataServiceProvider');

        $this->app->register('AndyH\Datamapper\Presenter\Providers\MetadataServiceProvider');

        $this->registerScanner();

        $this->registerCommands();
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
