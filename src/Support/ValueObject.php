<?php

namespace AndyH\Datamapper\Presenter\Support;

use AndyH\Datamapper\Contracts\ValueObject as ValueObjectContract;
use AndyH\Datamapper\Support\ValueObject as BaseValueObject;
use AndyH\Datamapper\Presenter\Support\Traits\PresentableModel;
use AndyH\Datamapper\Presenter\Contracts\PresentableModel as PresentableModelContract;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

abstract class ValueObject extends BaseValueObject implements ValueObjectContract, PresentableModelContract, Arrayable, Jsonable
{
    use PresentableModel;
}
