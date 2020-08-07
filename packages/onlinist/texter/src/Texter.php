<?php

namespace Onlinist\Texter;

use Onlinist\Texter\Contracts\Texter as TexterContract;
use Onlinist\Texter\Transports\TransportManager;

class Texter implements TexterContract {

    protected $app;
    /*
     * Transports\Transport
     */
    protected $transporter;
    protected $from;
    protected $to;
    protected $text;
    protected $options;
    protected $localCountryCode;

    public function __construct($transporter = null, $config = []) {
        $this->transporter($transporter, $config);
    }

    public function transporter($name = null, $config = []) {
        $this->app = app();
        $this->localCountryCode = !empty($config['local_country_code']) ? $config['local_country_code'] : $this->app['config']['texter.local_country_code'];
        $manager = new TransportManager($this->app);
        $this->transporter = $manager->driver($name, $config);
        return $this->transporter;
    }

    public function from($text) {
        $this->from = $text;
        return $this;
    }

    public function to($numbers) {
        $this->to = is_array($numbers) ? $numbers : func_get_args();
        foreach ($this->to as $key => $val) {
            $this->to[$key] = $this->sanitizePhoneNumber($val);
        }
        return $this;
    }

    public function text($text) {
        $this->text = $text;
        return $this;
    }

    public function options($options) {
        $this->options = $options;
    }

    public function send() {
        $this->transporter->setFrom($this->from);
        $this->transporter->setTo($this->to);
        $this->transporter->setText($this->text);
        $this->transporter->setOptions($this->options);
        return $this->transporter->send();
    }

    protected function sanitizePhoneNumber($phone) {
        $number = ltrim(preg_replace('/\D+/', '', $phone), '0');
        if (strlen($number) < 11) {
            $number .= $this->localCountryCode . $number;
        }
        return $number;
    }

}
