<?php

namespace AndyH\Datamapper\Presenter\Providers;

use Illuminate\Support\ServiceProvider;
use AndyH\Datamapper\Metadata\ClassFinder;
use Illuminate\Filesystem\ClassFinder as FilesystemClassFinder;
use AndyH\Datamapper\Metadata\AnnotationLoader;
use Doctrine\Common\Annotations\AnnotationReader;

class MetadataServiceProvider extends ServiceProvider
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
        $this->registerAnnotations();
    }

    /**
     * Registers all annotation classes
     *
     * @return void
     */
    public function registerAnnotations()
    {
        $app = $this->app;

        $loader = new AnnotationLoader($app['files'], __DIR__ . '/../Annotations');

        $loader->registerAll();
    }
}
