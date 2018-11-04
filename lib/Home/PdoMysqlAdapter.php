<?php

    namespace Home;

    use Bc\Exceptions\DatabaseErrorException;

    /**
     * Description of DbConnection
     *
     * @author Seif
     */
    class PdoMysqlAdapter implements DbAdapterInterface
    {

        protected $connection;

        public function __construct($connection)
        {
            $this->connection = $connection;
        }

        public static function createConnection(array $params)
        {
            $dsn = "mysql:host=" . $params['hostname'] . ";dbname=" . $params['database'] . ";charset=UTF8";
            $connection = new \PDO(
                $dsn,
                $params['user'],
                $params['password']
            );
            return new self($connection);
        }

        private function execute($query, $params = [], $types = [])
        {
            $stmt = $this->connection->prepare($query);
            if ($params) {
                $i = 1;
                foreach ($params as $paramValue) {
                    $type = array_shift($types) ?? \PDO::PARAM_STR;
                    $stmt->bindValue($i, $paramValue, $type);
                    $i = $i + 1;
                }
            }
            if (!$stmt->execute()) {
                throw new DatabaseErrorException(implode('|', $stmt->errorInfo()));
            }
            return $stmt;
        }

        public function executeQuery($query, $params = [], $types = [])
        {
            if (!is_array($params)) {
                $params = [$params];
            }
            return $this->execute($query, $params, $types)->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function executeUpdate($query, $params = [], $types = [])
        {
            return $this->execute($query, $params, $types)->rowCount();
        }
    }
