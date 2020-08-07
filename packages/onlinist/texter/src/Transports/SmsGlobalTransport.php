<?php

namespace Onlinist\Texter\Transports;

use Onlinist\Texter\Transports\Transport;
use GuzzleHttp\Client as HttpClient;

class SmsGlobalTransport extends Transport {

    public function __construct($app, $config = []) {
        $this->app = $app;
        $this->config = array_merge((array) $this->app['config']['texter.transports.sms_global'], $config ?: []);
    }

    public function send() {
        $Guzzle = new HttpClient();
        $uri = $this->config['server'] . '/http-api.php';
        $params = array(
            'action' => 'sendsms',
            'user' => $this->config['username'],
            'password' => $this->config['password'],
            'from' => $this->from,
            'to' => $this->to,
            'text' => $this->text,
        );
        $options = array('query' => array_merge($this->options ?: [], $params));
        $response = $Guzzle->get($uri, $options);
        return $response;
    }

    public function setTo($numbers) {
        $this->to = implode(',', $numbers);
        return $this;
    }

    public function setText($text) {
        $this->text = urlencode($text);
        return $this;
    }

}
