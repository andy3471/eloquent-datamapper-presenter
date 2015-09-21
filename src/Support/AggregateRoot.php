<?php

namespace ProAI\Datamapper\Presenter\Support;

use ProAI\Datamapper\Contracts\AggregateRoot as AggregateRootContract;
use ProAI\Datamapper\Support\AggregateRoot as BaseAggregateRoot;
use ProAI\Datamapper\Presenter\Support\Traits\PresentableModel;
use ProAI\Datamapper\Presenter\Contracts\PresentableModel as PresentableModelContract;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

abstract class AggregateRoot extends BaseAggregateRoot implements AggregateRootContract, PresentableModelContract, Arrayable, Jsonable
{
    use PresentableModel;
}
