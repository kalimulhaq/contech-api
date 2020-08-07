<?php

namespace Onlinist\Texter\Transports;

use Onlinist\Texter\Transports\Transport;
use GuzzleHttp\Client as HttpClient;

class BulkSmsCloudTransport extends Transport {

    public function __construct($app, $config = []) {
        $this->app = $app;
        $this->config = array_merge((array) $this->app['config']['texter.transports.bulk_sms_cloud'], $config ?: []);
    }

    public function send() {
        $headers = array(
            'Content-Type' => 'application/x-www-form-urlencoded'
        );
        $Guzzle = new HttpClient(['headers' => $headers]);
        $uri = $this->config['server'] . '/API_SendBulkSMS.aspx';
        $params = array(
            'User' => $this->config['username'],
            'passwd' => $this->config['password'],
            'mobilenumber' => $this->to,
            'message' => $this->text,
            'sid' => $this->from,
            'mtype' => 'N',
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
