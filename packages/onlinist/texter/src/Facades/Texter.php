<?php

namespace Onlinist\Texter\Facades;

use Illuminate\Support\Facades\Facade;

class Texter extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'texter';
    }

}
