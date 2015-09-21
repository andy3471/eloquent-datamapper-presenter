<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Presenters Namespace
    |--------------------------------------------------------------------------
    |
    | If a presenters namespace is defined, only the classes in the sub-
    | namespace will be scanned by the schema commands.
    |
    */

    'presenters_namespace' => '',

    /*
    |--------------------------------------------------------------------------
    | Auto Present
    |--------------------------------------------------------------------------
    |
    | If this option is set to true, a PresentableModel object that is passed
    | to a view will be automatically converted to a presentable object.
    | Either by creating a standard presenter or a registered presenter.
    |
    */

    'auto_present' => true,

];