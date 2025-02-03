<?php

namespace App\Helper;

class SafeObjectHelper {
    public function __construct($array = []) {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                // If array keys are sequential numbers (numeric array), keep it as an array
                if (array_keys($value) === range(0, count($value) - 1)) {
                    $this->{$key} = array_map(fn($v) => is_array($v) ? new self($v) : $v, $value);
                } else {
                    $this->{$key} = new self($value);
                }
            } else {
                $this->{$key} = $value;
            }
        }
    }

    public function __get($name) {
        return null; // Return null if property doesn't exist
    }
}
