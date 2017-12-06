<?php

namespace App\Com\Traits;

trait JsonableTrait
{
    public function toJson($options = JSON_UNESCAPED_UNICODE)
    {
        return json_encode($this->jsonSerialize(), $options);
    }
}
