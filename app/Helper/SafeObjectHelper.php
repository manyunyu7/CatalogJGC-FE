<?php

namespace App\Helper;

class SafeObjectHelper {
    public function __construct($array = []) {
        foreach ($array as $key => $value) {
            $this->{$key} = is_array($value) ? new self($value) : $value;
        }
    }

    public function __get($name) {
        return null; // Return null if property doesn't exist
    }
}
