<?php

namespace AndyH\Datamapper\Presenter\Console;

use Illuminate\Console\Command;
use AndyH\Datamapper\Metadata\ClassFinder;
use AndyH\Datamapper\Presenter\Metadata\PresenterScanner;
use AndyH\Datamapper\Presenter\Presenter\Repository;
use UnexpectedValueException;

abstract class PresenterCommand extends Command
{
    /**
     * The class finder instance.
     *
     * @var \AndyH\Datamapper\Metadata\ClassFinder
     */
    protected $finder;

    /**
     * The presenter scanner instance.
     *
     * @var \AndyH\Datamapper\Metadata\PresenterScanner
     */
    protected $scanner;

    /**
     * The presenter repository instance.
     *
     * @var \AndyH\Datamapper\Presenter\Repository
     */
    protected $repository;

    /**
     * The config of the datamapper package.
     *
     * @var array
     */
    protected $config;

    /**
     * Create a new migration install command instance.
     *
     * @param \AndyH\Datamapper\Metadata\ClassFinder $finder
     * @param \AndyH\Datamapper\Metadata\PresenterScanner $scanner
     * @param \AndyH\Datamapper\Presenter\Repository $schema
     * @param array $config
     * @return void
     */
    public function __construct(ClassFinder $finder, PresenterScanner $scanner, Repository $repository, $config)
    {
        parent::__construct();

        $this->finder = $finder;
        $this->scanner = $scanner;
        $this->repository = $repository;
        $this->config = $config;
    }
}
