<?php

namespace Onlinist\Texter\Transports;

use Illuminate\Support\Manager;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Onlinist\Texter\Transports\SmsGlobalTransport;
use Onlinist\Texter\Transports\BulkSmsTransport;
use Onlinist\Texter\Transports\BulkSmsCloudTransport;
use Onlinist\Texter\Transports\AdVenturaTransport;

class TransportManager extends Manager {

    protected function createSmsGlobalDriver($config = []) {
        return new SmsGlobalTransport($this->app, $config);
    }

    protected function createBulkSmsDriver($config = []) {
        return new BulkSmsTransport($this->app, $config);
    }

    protected function createBulkSmsCloudDriver($config = []) {
        return new BulkSmsCloudTransport($this->app, $config);
    }

    protected function createAdVenturaDriver($config = []) {
        return new AdVenturaTransport($this->app, $config);
    }

    /**
     * Get a driver instance.
     *
     * @param  string  $driver
     * @return Transport
     *
     * @throws \InvalidArgumentException
     */
    public function driver($name = null, $config = []) {
        $driver = $name ?: $this->getDefaultDriver();

        if (is_null($driver)) {
            throw new InvalidArgumentException(sprintf('Unable to resolve NULL driver for [%s].', static::class));
        }

        // If the given driver has not been created before, we will create the instances
        // here and cache it so we can return it next time very quickly. If there is
        // already a driver created by this name, we'll just return that instance.
        if (!isset($this->drivers[$driver])) {
            $this->drivers[$driver] = $this->createDriver($driver, $config);
        }

        return $this->drivers[$driver];
    }

    /**
     * Create a new driver instance.
     *
     * @param  string  $driver
     * @return mixed
     *
     * @throws \InvalidArgumentException
     */
    protected function createDriver($driver, $config = []) {
        // First, we will determine if a custom driver creator exists for the given driver and
        // if it does not we will check for a creator method for the driver. Custom creator
        // callbacks allow developers to build their own "drivers" easily using Closures.
        if (isset($this->customCreators[$driver])) {
            return $this->callCustomCreator($driver, $config);
        } else {
            $method = 'create' . Str::studly($driver) . 'Driver';

            if (method_exists($this, $method)) {
                return $this->$method($config);
            }
        }
        throw new InvalidArgumentException("Driver [$driver] not supported.");
    }

    /**
     * Call a custom driver creator.
     *
     * @param  string  $driver
     * @return mixed
     */
    protected function callCustomCreator($driver, $config = []) {
        return $this->customCreators[$driver]($this->app, $config);
    }

    public function getDefaultDriver() {
        return $this->app['config']['texter.default'];
    }

    public function setDefaultDriver($name) {
        $this->app['config']['texter.default'] = $name;
    }

}
