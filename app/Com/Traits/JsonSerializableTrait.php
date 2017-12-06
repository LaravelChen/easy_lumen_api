<?php

namespace App\Com\Traits;

trait JsonSerializableTrait
{
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
