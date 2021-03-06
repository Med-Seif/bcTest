<?php

    namespace Bc\Models\Repository;

    /**
     *
     *
     * @author Seif
     */
    class ContactRepository extends AbstractRepository
    {
        public function findRow($id)
        {
            $query = 'SELECT id, nom, prenom, email, users_id FROM contacts WHERE id = ?';
            return array_shift(
                $this->getDbConnection()->executeQuery(
                    $query,
                    [$id],
                    [\PDO::PARAM_INT]
                )
            );
        }

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

        public function update($params)
        {
            $query = 'UPDATE contacts SET nom = ?, prenom = ?, email = ? WHERE id = ?';
            return $this->getDbConnection()->executeUpdate($query, $params);
        }
        
    }
