<?php

namespace AndyH\Datamapper\Presenter\Contracts;

interface PresentableModel
{
    /**
     * Get the presenter instance
     *
     * @return mixed
     */
    public function getPresenter();
    
    /**
     * Convert the entity instance to JSON.
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0);
    
    /**
     * Convert the entity instance to an array.
     *
     * @return array
     */
    public function toArray();
}
