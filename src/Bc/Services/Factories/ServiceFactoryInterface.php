<?php

namespace Bc\Services\Factories;

/**
 *
 * @author Seif
 */
interface ServiceFactoryInterface {

    public function create($container, $serviceID = null);
}
