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

        public function userExists($userID)
        {
            $userRow = $this->findRow($userID);
            if (!is_array($userRow)) {
                return false;
            }
            return (count($userRow) > 0);
        }

    }
