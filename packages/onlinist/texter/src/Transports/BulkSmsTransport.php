<?php

namespace Onlinist\Texter\Transports;

use Onlinist\Texter\Transports\Transport;
use GuzzleHttp\Client as HttpClient;

class BulkSmsTransport extends Transport {

    public function __construct($app, $config = []) {
        $this->app = $app;
        $this->config = array_merge((array) $this->app['config']['texter.transports.bulk_sms'], $config ?: []);
    }

    public function send() {
        $token = $this->config['username'] . ':' . $this->config['password'];
        $headers = array(
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($token)
        );
        $Guzzle = new HttpClient(['headers' => $headers]);
        $uri = $this->config['server'] . '/messages';
        $params = array(
            'from' => $this->from,
            'to' => $this->to,
            'body' => $this->text,
        );
        $options = array('json' => array_merge($this->options ?: [], $params));
        $response = $Guzzle->post($uri, $options);
        return $response;
    }

}
