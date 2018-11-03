<?php

    namespace Home;

    use Bc\Exceptions\ServiceNotFoundException;

    /**
     * Description of ServicesStore
     *
     * @author Seif
     */
    class ServicesStore implements \ArrayAccess
    {

        /**
         *
         * @var type
         */
        protected $services = [];

        public function offsetExists($offset)
        {
            return array_key_exists($offset, $this->services);
        }

        public function offsetGet($offset)
        {
            if (!$this->offsetExists($offset)) {
                throw new ServiceNotFoundException($offset);
            }
            if ($this->services[$offset] instanceof \Bc\Services\Factories\ServiceFactoryInterface) {
                $factoryClassName = $this->services[$offset];
                $factoryInstance = new $factoryClassName();
                $this->offsetSet(
                    $offset,
                    $factoryInstance->create($this, $offset)
                );
            }
            return $this->services[$offset];
        }

        public function offsetSet($offset, $value)
        {
            $this->services[$offset] = $value;
        }

        public function offsetUnset($offset)
        {
            if (isset($this->services[$offset])) {
                unset($this->services[$offset]);
            }
        }

        public function append($elements)
        {
            foreach ($elements as $key => $elem) {
                $this->services[$key] = $value;
            }
        }

    }
