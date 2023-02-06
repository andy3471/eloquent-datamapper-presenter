# Laravel Datamapper Presenter

[![Latest Stable Version](https://poser.pugx.org/AndyH/laravel-datamapper-presenter/v/stable)](https://packagist.org/packages/AndyH/laravel-datamapper-presenter) [![Total Downloads](https://poser.pugx.org/AndyH/laravel-datamapper-presenter/downloads)](https://packagist.org/packages/AndyH/laravel-datamapper-presenter) [![Latest Unstable Version](https://poser.pugx.org/AndyH/laravel-datamapper-presenter/v/unstable)](https://packagist.org/packages/AndyH/laravel-datamapper-presenter) [![License](https://poser.pugx.org/AndyH/laravel-datamapper-presenter/license)](https://packagist.org/packages/AndyH/laravel-datamapper-presenter)

This package extends the [Laravel Datamapper](https://github.com/AndyH/laravel-datamapper) package by presenter classes. The following is a notice for the Laravel Datamapper package, but also fit to this package:

**Important: This package is unmaintained and never hit production stage. I decided that it is not worse to develop a datamapper package, because there is no real advantage over using the Laravel Eloquent orm. Nevertheless this package is [well documented](https://AndyH.github.io/laravel-datamapper) and basically all features should work out of the box. So if someone is interested in using the datamapper pattern with Laravel, this package is a good starting point.**

## Installation

Laravel Datamapper Presenter is distributed as a composer package. So you first have to add the package to your `composer.json` file:

```
"AndyH/laravel-datamapper-presenter": "~1.0@dev"
```

Then you have to run `composer update` to install the package. Once this is completed, you have to add the service provider to the providers array in `config/app.php`:

```
'AndyH\Datamapper\Presenter\Datamapper\PresenterServiceProvider'
```

Run `php artisan vendor:publish` to publish this package configuration. Afterwards you can edit the file `config/datamapper.php`.

## Usage

If you extend your models (i. e. entities and value objects) by

* `AndyH\Datamapper\Presenter\Support\AggregateRoot`,
* `AndyH\Datamapper\Presenter\Support\Entity` or
* `AndyH\Datamapper\Presenter\Support\ValueObject`

your model is presentable and you can use the presenter.

You can use the `$hidden` and `$visible` variables to hide or show attributes from presentation (same as in Eloquent, see example).

All presentable models are automatically converted to presenters for views. If you want to get the presenter of a model manually you can use `$model->getPresenter()`.

Also you can define methods in a presenter to define or update attributes only for presentation. So if you define a method `fullName()` for a `User` model, you can access this method in a view via $user->fullName().

### Serialization

Presentable models can also be converted to an array or to json. Use `$model->toArray()` or `$model->toJson()` to do this. The attributes are converted to snake case in arrays/json, so you can access for example `$model->firstName` as `$model['first_name']` after array conversion.

For AJAX responses the models will be converted automatically to json.

### Commands

* Use `php artisan presenter:register` to register all presenters that have the `@Presenter` annotation.
* Use `php artisan presenter:clear` to clear the registered presenters file.

### Example

```php
<?php

namespace Acme\Presenters;

use AndyH\Datamapper\Annotations as DM;
use AndyH\Datamapper\Support\Presenter;
use Illuminate\Contracts\Auth\Guard;

/**
 * @DM\Presenter(class="Acme\Models\User")
 */
class UserPresenter extends Presenter
{
    public function __construct(Guard $auth)
    {
        $this->hidden = ['password'];

        $this->auth = $auth;
    }

    public function fullName()
    {
        return $this->model->firstName() . ' ' . $this->model->lastName();
    }

    public function isLoggedInUser()
    {
        return $this->model->id() == $this->auth->user()->id();
    }
}
```

## Support

Bugs and feature requests are tracked on [GitHub](https://github.com/AndyH/laravel-datamapper-presenter/issues).

## License

This package is released under the [MIT License](LICENSE).
