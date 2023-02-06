<?php

namespace AndyH\Datamapper\Presenter\Presenter;

use AndyH\Datamapper\Presenter\Contracts\PresentableModel;
use AndyH\Datamapper\Contracts\Proxy;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\Paginator;
use Exception;

class Decorator
{
    /**
     * @var array
     */
    public static $decoratedObjects = [];

    /**
     * Decorate an item.
     *
     * @param  mixed  $item
     * @param  boolean  $toArray
     * @return mixed
     */
    public static function decorateArray($item)
    {
        // prevent endless loops by remember already decorated objects
        $hash = spl_object_hash($item);
        if (in_array($hash, self::$decoratedObjects)) {
            return null;
        }
        self::$decoratedObjects[] = $hash;

        $array = self::decorate($item, true);

        self::$decoratedObjects = [];

        return $array;
    }

    /**
     * Decorate an item.
     *
     * @param  mixed  $item
     * @param  boolean  $toArray
     * @return mixed
     */
    public static function decorate($item, $toArray=false)
    {
        // make item presentable
        if ($item instanceof PresentableModel) {
            if ($toArray) {
                if ($item instanceof Arrayable) {
                    return $item->toArray();
                }
            } else {
                return $item->getPresenter();
            }
        }

        // item is collection/paginator
        if (self::isCollection($item)) {
            // decorate collection items
            foreach ($item as $key => $collectionItem) {
                $item[$key] = self::decorate($collectionItem, $toArray);
            }

            if ($toArray) {
                return $item->toArray();
            } else {
                return $item;
            }
        }

        // throw exception if unknown item was not converted in case of array conversion
        if ($toArray && is_object($item) && ! self::isCollection($item)) {
            // item is proxy
            if ($item instanceof Proxy) {
                return $item->toArray();
            }

            throw new Exception('Array conversion failed, because object "'.get_class($item).'" was not converted.');
        }

        return $item;
    }

    /**
     * Check if item is collection.
     *
     * @param  mixed  $item
     * @return boolean
     */
    protected static function isCollection($item)
    {
        if ($item instanceof Collection) {
            return true;
        }

        if ($item instanceof Paginator) {
            return true;
        }

        return false;
    }
}
