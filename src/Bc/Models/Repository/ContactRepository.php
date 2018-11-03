<?php

    namespace Bc\Models\Repository;

    /**
     *
     *
     * @author Seif
     */
    class ContactRepository extends AbstractRepository
    {

        public function find($params)
        {
            $query = 'SELECT id, nom, prenom, email FROM contacts WHERE users_id = ?';
            return $this->getDbConnection()->executeQuery($query, $params,
                [\PDO::PARAM_INT]);

        }

        public function insert($params)
        {
            $query = 'INSERT INTO contacts (nom, prenom, email, users_id) VALUES (?, ?, ?, ?)';
            return $this->getDbConnection()->executeUpdate($query, $params);
        }

    }
