<?php

namespace ProAI\Datamapper\Presenter\Support;

use ProAI\Datamapper\Contracts\ValueObject as ValueObjectContract;
use ProAI\Datamapper\Support\ValueObject as BaseValueObject;
use ProAI\Datamapper\Presenter\Support\Traits\PresentableModel;
use ProAI\Datamapper\Presenter\Contracts\PresentableModel as PresentableModelContract;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

abstract class ValueObject extends BaseValueObject implements ValueObjectContract, PresentableModelContract, Arrayable, Jsonable
{
    use PresentableModel;
}
