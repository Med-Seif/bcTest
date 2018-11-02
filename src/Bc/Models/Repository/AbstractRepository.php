<?php

namespace Bc\Models\Repository;

use Home\DbMysqliAdapter;

/**
 * Description of AbstractRepository
 *
 * @author Seif
 */
abstract class AbstractRepository {

    /**
     *
     * @var DbMysqliAdapter
     */
    protected $dbConnection;

    /**
     * 
     * @param DbMysqliAdapter $dbConnection
     */
    public function setDbConnection(DbMysqliAdapter $dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    /**
     * 
     * @return DbMysqliAdapter
     */
    public function getDbConnection() {
        return $this->dbConnection;
    }

}
