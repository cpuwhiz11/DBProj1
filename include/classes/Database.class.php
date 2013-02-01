<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Database
 *
 * @author Ryan
 */
class Database {

    private $host = "db453524503.db.1and1.com";
    private $username = "dbo453524503";
    private $password = "gWhUiMLgGPV7";
    private $db;
    protected $connection;
    private $result;

    function __construct($db) {

        $this->database = $db;
    }

    public function connect() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

        if (mysqli_connect_errno()) {
            die("Connection to database failed: " . mysqli_connect_errno());
        }
    }

    public function query($query) {

        $this->result = $this->connection->query($query);
        if (!$this->result) {
            return false;
        }
        return true;
    }

    public function getResult() {

        while ($row = $this->result->fetch_row()) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function getAssocResult() {
        while ($row = $this->result->fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function disconnect() {
        $this->result->close();
        $this->connection->close();
    }

    public function lastID() {
        return $this->connection->insert_id;
    }

    public static function sanitizeMySQL($var) {
        $var = mysql_real_escape_string($var);
        $var = stripslashes($var);
        $var = htmlentities($var);
        $var = strip_tags($var);
        return $var;
    }

    protected function escapeString($string) {
        return mysqli_real_escape_string($this->conn, $string);
    }

}

?>
