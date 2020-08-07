<?php

namespace Onlinist\Json2query\Facade;

use Illuminate\Support\Facades\Facade;

class Json2queryFacade extends Facade {

    protected static function getFacadeAccessor() {
        return 'json2query';
    }

}
