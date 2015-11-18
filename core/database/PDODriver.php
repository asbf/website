<?php

require_once __DIR__ . '/../config/Config.php';

class PDODriver {

    private static $pdoInstance;
    private static $selfInstance;

    private function __construct() {}

    public static function getDriver() {
        if (!isset(self::$selfInstance)) {
            self::$selfInstance = new self();
        }

        return self::$selfInstance;
    }

    private static function getInstance() {
        if (!isset(self::$pdoInstance)) {
            try {
                self::$pdoInstance = new PDO('mysql:host=' . Config::$dbAddress . ';port=' . Config::$dbPort . ';dbname=' . Config::$dbName, Config::$dbUser, Config::$dbPassword);
                self::$pdoInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $pdoException) {
                die($pdoException->getCode() . ' : '. $pdoException->getMessage());
            }
        }

        return self::$pdoInstance;
    }

    private function queryDatabase($statement, array $values, $unique) {
        try {
            $sql = self::getInstance()->prepare($statement);
            $sql->execute($values);

            if ($unique === true) {
                return $sql->fetch(PDO::FETCH_OBJ);
            }
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $pdoException) {
            die($pdoException->getMessage());
        }
    }

    public function query($statement, array $values = []) {
        return $this->queryDatabase($statement, $values, false);
    }

    public function queryOne($statement, array $values = []) {
        return $this->queryDatabase($statement, $values, true);
    }

    public function execute($statement, array $values = []) {
        try {
            $sql = $this->getInstance()->prepare($statement);
            $sql->execute($values);
        } catch (PDOException $pdoException) {
            die($pdoException->getMessage());
        }
    }

}
