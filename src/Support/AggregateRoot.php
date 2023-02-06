<?php

namespace AndyH\Datamapper\Presenter\Support;

use AndyH\Datamapper\Contracts\AggregateRoot as AggregateRootContract;
use AndyH\Datamapper\Support\AggregateRoot as BaseAggregateRoot;
use AndyH\Datamapper\Presenter\Support\Traits\PresentableModel;
use AndyH\Datamapper\Presenter\Contracts\PresentableModel as PresentableModelContract;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

abstract class AggregateRoot extends BaseAggregateRoot implements AggregateRootContract, PresentableModelContract, Arrayable, Jsonable
{
    use PresentableModel;
}
