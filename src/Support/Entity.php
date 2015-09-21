<?php

namespace ProAI\Datamapper\Presenter\Support;

use ProAI\Datamapper\Contracts\Entity as EntityContract;
use ProAI\Datamapper\Support\ValueObject as BaseEntity;
use ProAI\Datamapper\Presenter\Support\Traits\PresentableModel;
use ProAI\Datamapper\Presenter\Contracts\PresentableModel as PresentableModelContract;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

abstract class Entity extends BaseEntity implements EntityContract, PresentableModelContract, Arrayable, Jsonable
{
    use PresentableModel;
}
