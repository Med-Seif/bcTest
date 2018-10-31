<?php

namespace Bc\Model\Repository;

use Home\DbConnection;

/**
 * Description of AbstractRepository
 *
 * @author Seif
 */
abstract class AbstractRepository {

    /**
     *
     * @var DbConnection
     */
    protected $dbConnection;

    /**
     * 
     * @param DbConnection $dbConnection
     */
    public function setDbConnection(DbConnection $dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    /**
     * 
     * @return DbConnection
     */
    public function getDbConnection() {
        return $this->dbConnection;
    }

}
