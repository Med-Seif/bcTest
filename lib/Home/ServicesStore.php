<?php

namespace Home;

/**
 * Description of ServicesStore
 *
 * @author Seif
 */
class ServicesStore implements \ArrayAccess {

    /**
     *
     * @var type 
     */
    protected $services = [];

    public function offsetExists($offset) {
        return isset($this->services[$offset]);
    }

    public function offsetGet($offset) {
        if (!$this->offsetExists($offset)) {
            throw new \ServiceNotFoundException();
        }
        return $this->services[$offset];
    }

    public function offsetSet($offset, $value) {
        $this->services[$offset] = $value;
    }

    public function offsetUnset($offset) {
        unset($this->services[$offset]);
    }

}
