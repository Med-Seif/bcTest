<?php

namespace Bc\Services\Factories;

/**
 * Description of RepositoryFactory
 *
 * @author Seif
 */
class RepositoryFactory implements ServiceFactoryInterface {

    public function create(\ArrayAccess $serviceStore, $serviceID = null) {
        if (!class_exists($serviceID)) {
            throw new \Bc\Exceptions\InvalidClassNameException();
        }
        $instance = new $serviceID();
        $instance->setDbConnection($serviceStore['db_connection']);
        return $instance;
    }

}
