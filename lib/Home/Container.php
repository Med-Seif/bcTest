<?php

namespace Home;

use Psr\Container\ContainerInterface;

/**
 * Description of Container
 *
 * @author Seif
 */
final class Container implements ContainerInterface
{

    /**
     *
     * @var ServicesStore
     */
    private $servicesStore;

    public function __construct(ServicesStore $serviceStore)
    {
        $this->servicesStore = $serviceStore;
    }

    /**
     *
     * @param integer $id
     * @throws \ServiceNotFoundException
     */
    public function get($id)
    {
        return $this->servicesStore->offsetGet($id);
    }

    /**
     *
     * @param integer $id
     * @return mixed
     */
    public function has($id)
    {
        return $this->servicesStore->offsetExists($id);
    }

    //put your code here
}
