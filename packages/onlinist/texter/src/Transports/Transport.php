<?php

namespace Onlinist\Texter\Transports;

abstract class Transport {

    protected $app;
    protected $config;
    protected $client;
    protected $from;
    protected $to;
    protected $text;
    protected $options;

    public function setFrom($text) {
        $this->from = $text;
        return $this;
    }

    public function setTo($numbers) {
        $this->to = $numbers;
        return $this;
    }

    public function setText($text) {
        $this->text = $text;
        return $this;
    }

    public function setOptions($options) {
        $this->options = $options;
        return $this;
    }

    abstract public function send();
}
