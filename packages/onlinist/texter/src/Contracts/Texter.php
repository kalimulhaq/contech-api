<?php

namespace Onlinist\Texter\Contracts;

interface Texter {

    public function from($text);

    public function to($numbers);

    public function text($text);

    public function options($param);
}
