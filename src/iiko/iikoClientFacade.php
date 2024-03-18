<?php

namespace IikoApiLibrary\iiko;

use Illuminate\Support\Facades\Facade;
use IikoApiLibrary\iiko\api\iikoClient;

/**
 * @method static iikoClient create()
 */
class iikoClientFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'iikoClient';
    }

}

