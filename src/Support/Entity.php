<?php

namespace ProAI\Datamapper\Support;

use ProAI\Datamapper\Contracts\Entity as EntityContract;
use ProAI\Datamapper\Support\ValueObject as BaseEntity;
use ProAI\DatamapperPresenter\Support\Traits\PresentableModel;
use ProAI\DatamapperPresenter\Contracts\PresentableModel as PresentableModelContract;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

abstract class Entity extends BaseEntity implements EntityContract, PresentableModelContract, Arrayable, Jsonable
{
    use PresentableModel;
}
