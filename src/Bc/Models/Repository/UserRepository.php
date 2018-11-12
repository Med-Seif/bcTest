<?php

    namespace Bc\Models\Repository;

    /**
     *
     *
     * @author Seif
     */
    class UserRepository extends AbstractRepository
    {
        /**
         * @param $userID
         * @return mixed
         */
        public function findRow($userID)
        {
            $query = 'SELECT login FROM users WHERE id = ?';
            return $this->getDbConnection()->executeQuery(
                $query,
                [$userID],
                [\PDO::PARAM_INT]
            );
        }

        public function authenticateUser($login, $mdp)
        {
            $query = 'SELECT id FROM users WHERE login = ? AND password = md5(?)';
            $result = $this->getDbConnection()->executeQuery(
                $query,
                [$login, $mdp],
                [\PDO::PARAM_STR, \PDO::PARAM_STR,]
            );
            return $result[0]['id'];
        }

    }
