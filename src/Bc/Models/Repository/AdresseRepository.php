<?php

    namespace Bc\Models\Repository;

    /**
     *
     *
     * @author Seif
     */
    class AdresseRepository extends AbstractRepository
    {
        public function findRow($id)
        {
            $query = 'SELECT id, libelle, contacts_id FROM adresses WHERE id = ?';
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
            $query = 'SELECT id, libelle, contacts_id FROM adresses  WHERE contacts_id = ?';
            return $this->getDbConnection()->executeQuery($query, $params,
                [\PDO::PARAM_INT]);

        }

        public function insert($params)
        {
            $query = 'INSERT INTO adresses (libelle, contacts_id) VALUES (?, ?)';
            return $this->getDbConnection()->executeUpdate($query, $params);
        }

        public function update($params)
        {
            $query = 'UPDATE adresses SET libelle = ? WHERE id = ?';
            return $this->getDbConnection()->executeUpdate($query, $params);
        }


    }
