<?php

namespace Axeldotdev\Insee\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Axeldotdev\Insee\Insee
 */
class Insee extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'insee';
    }
}
