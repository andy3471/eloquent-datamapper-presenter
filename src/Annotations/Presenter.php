<?php

namespace AndyH\Datamapper\Presenter\Annotations;

use AndyH\Datamapper\Annotations\Annotation;

/**
 * @Annotation
 * @Target("CLASS")
 */
final class Presenter implements Annotation
{
    /**
     * @var string
     */
    public $class;
}
