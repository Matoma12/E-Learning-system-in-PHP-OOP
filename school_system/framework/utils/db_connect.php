<?php 
include_once dirname(__FILE__) .'/../../config.php';

class Db_Connect {
    private function connect() {   
        $servername = DB_HOST;
        $username = DB_USERNAME;
        $password = DB_PASSWORD;
        $db_name = DB_NAME;

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function sql($sql, $type) {
        $con = $this->connect();
        $res = $con->query($sql);
        switch($type) {
            case 'insert': // could use enums
                return $con->lastInsertId() > 0;
            case 'update':
                return $res->rowCount() > 0;
            case 'delete':
                return $res->rowCount() > 0;
            default:
                return $res->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}

?>