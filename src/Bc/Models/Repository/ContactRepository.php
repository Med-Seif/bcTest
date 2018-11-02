<?php

namespace Bc\Models\Repository;

/**
 * 
 *
 * @author Seif
 */
class ContactRepository extends AbstractRepository {

    public function find($params) {
        $query = 'SELECT nom, prenom, email FROM contacts WHERE users_id = ?';
        return $this->getDbConnection()->executeQuery($query, $params, [\Home\DbMysqliAdapter::MYSQLI_PARAM_TYPE_INT]);

    }
    public function insert($params){
        $query = 'INSERT INTO contacts (nom, prenom, email, users_id) VALUES (?, ?, ?, ?)';
        return $this->getDbConnection()->executeQuery($query, $params);
    }

}
