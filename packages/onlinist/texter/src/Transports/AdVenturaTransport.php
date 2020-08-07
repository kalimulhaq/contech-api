<?php

namespace Onlinist\Texter\Transports;

use Onlinist\Texter\Transports\Transport;
use GuzzleHttp\Client as HttpClient;

class AdVenturaTransport extends Transport {

    public function __construct($app, $config = []) {
        $this->app = $app;
        $this->config = array_merge((array) $this->app['config']['texter.transports.ad_ventura'], $config ?: []);
    }

    public function send() {
        $headers = array(
            'Content-Type' => 'application/x-www-form-urlencoded'
        );
        $Guzzle = new HttpClient(['headers' => $headers]);
        $uri = $this->config['server'] . '/smsapi/index.php';
        $params = array(
            'key' => $this->config['api_key'],
            'campaign' => $this->config['campaign'],
            'routeid' => $this->config['routeid'],
            'contacts' => $this->to,
            'msg' => $this->text,
            'senderid' => $this->from,
            'type' => 'text',
        );
        $options = array('form_params' => array_merge($this->options ?: [], $params));
        $response = $Guzzle->post($uri, $options);
        return $response;
    }

    public function setTo($numbers) {
        $this->to = implode(',', $numbers);
        return $this;
    }

}
