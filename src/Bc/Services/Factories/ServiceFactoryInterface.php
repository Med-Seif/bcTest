<?php

namespace Bc\Services\Factories;

use Home\ServicesStore;

/**
 *
 * @author Seif
 */
interface ServiceFactoryInterface {

    public function create(\ArrayAccess $serviceStore, $serviceID = null);
}
