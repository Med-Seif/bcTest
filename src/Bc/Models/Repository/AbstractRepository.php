<?php

namespace Bc\Models\Repository;

use Home\PdoMysqlAdapter;

/**
 * Description of AbstractRepository
 *
 * @author Seif
 */
abstract class AbstractRepository {

    /**
     *
     * @var PdoMysqlAdapter
     */
    protected $dbConnection;

    /**
     * 
     * @param PdoMysqlAdapter $dbConnection
     */
    public function setDbConnection(PdoMysqlAdapter $dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    /**
     * 
     * @return PdoMysqlAdapter
     */
    public function getDbConnection() {
        return $this->dbConnection;
    }

}
