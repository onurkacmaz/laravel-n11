<?php

namespace Onurkacmaz\LaravelN11;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Onurkacmaz\LaravelN11\Skeleton\SkeletonClass
 */
class LaravelN11Facade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-n11';
    }
}
