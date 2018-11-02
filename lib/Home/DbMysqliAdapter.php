<?php

namespace Home;

/**
 * Description of DbConnection
 *
 * @author Seif
 */
class DbMysqliAdapter implements DbAdapterInterface {

    const MYSQLI_PARAM_TYPE_INT = 'i'; // entier
    const MYSQLI_PARAM_TYPE_FLOAT = 'd'; // décimal
    const MYSQLI_PARAM_TYPE_TEXT = 's'; // chaîne de caractères
    const MYSQLI_PARAM_TYPE_BLOB = 'b'; // BLOB

    protected $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    /**
     *
     * @param array $params
     */
    public static function createConnection(array $params) {
        $connection = new \mysqli(
                $params['hostname'], $params['user'], $params['password'], $params['database']
        );
        return new self($connection);
    }

    public function executeQuery($query, $params = [], $types = []) {
        $stmt = $this->connection->prepare($query);
        if ($params) {
            foreach ($params as $param) {
                $type = array_shift($types) ?? self::MYSQLI_PARAM_TYPE_TEXT;
                $stmt->bind_param($type, $param);
            }
        }
        $stmt->execute();
        $res = $stmt->get_result();var_dump($res);
        return $res->fetch_all(MYSQLI_ASSOC);
    }

}
