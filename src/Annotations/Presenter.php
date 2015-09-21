<?php

namespace ProAI\DatamapperPresenter\Annotations;

use ProAI\Datamapper\Annotations\Annotation;

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
