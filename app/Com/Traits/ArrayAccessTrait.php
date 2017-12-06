<?php

namespace App\Com\Traits;

trait ArrayAccessTrait
{
    public function getAttribute($key)
    {
        return $this->offsetExistsOrigin($key) ?
            $this->offsetGetOrigin($key) :
            $this->offsetGetOrigin($this->getCamel($key));
    }

    public function setAttribute($key, $value)
    {
        $this->offsetExistsOrigin($key) ?
            $this->offsetSetOrigin($key, $value) :
            $this->offsetSetOrigin($this->getCamel($key), $value);

        return $this;
    }

    public function __get($key)
    {
        return $this->getAttribute($key);
    }

    public function __set($key, $value)
    {
        $this->setAttribute($key, $value);
    }


    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }

    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }

    protected function getCamel($offset)
    {
        return camel_case($offset);
    }

    protected function offsetExistsOrigin($offset)
    {
        return isset($this->$offset);
    }

    protected function offsetGetOrigin($offset)
    {
        return $this->$offset;
    }

    protected function offsetSetOrigin($offset, $value)
    {
        $this->$offset = $value;
    }
}
