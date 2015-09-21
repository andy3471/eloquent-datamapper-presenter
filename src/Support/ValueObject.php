<?php

namespace ProAI\DatamapperPresenter\Support;

use ProAI\Datamapper\Contracts\ValueObject as ValueObjectContract;
use ProAI\Datamapper\Support\ValueObject as BaseValueObject;
use ProAI\DatamapperPresenter\Support\Traits\PresentableModel;
use ProAI\DatamapperPresenter\Contracts\PresentableModel as PresentableModelContract;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

abstract class ValueObject extends BaseValueObject implements ValueObjectContract, PresentableModelContract, Arrayable, Jsonable
{
    use PresentableModel;
}
