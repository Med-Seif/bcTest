<?php

namespace Home;

/**
 *
 * @author Seif
 */
interface DbAdapterInterface {

    public static function createConnection(array $params);
}
