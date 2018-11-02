<?php

namespace Bc\Models\Repository;

/**
 * 
 *
 * @author Seif
 */
class UserRepository extends AbstractRepository {

    public function findRow($id) {
        $query = 'SELECT login FROM users WHERE id = ?';
        return $this->getDbConnection()->executeQuery($query, [$id], [\Home\DbMysqliAdapter::MYSQLI_PARAM_TYPE_INT]);
    }

}
