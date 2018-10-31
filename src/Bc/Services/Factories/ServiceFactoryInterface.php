<?php

/**
 *
 * @author Seif
 */
interface ServiceFactoryInterface {

    public function create($container, $serviceID = null);
}
