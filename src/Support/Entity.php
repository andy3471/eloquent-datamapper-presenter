<?php

namespace AndyH\Datamapper\Presenter\Support;

use AndyH\Datamapper\Contracts\Entity as EntityContract;
use AndyH\Datamapper\Support\ValueObject as BaseEntity;
use AndyH\Datamapper\Presenter\Support\Traits\PresentableModel;
use AndyH\Datamapper\Presenter\Contracts\PresentableModel as PresentableModelContract;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

abstract class Entity extends BaseEntity implements EntityContract, PresentableModelContract, Arrayable, Jsonable
{
    use PresentableModel;
}
