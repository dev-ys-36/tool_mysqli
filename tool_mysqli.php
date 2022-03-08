<?php

/**
 * version: 1.0.0 : first released..
 */

class Tool_MySQLi{

    private string $prefix = '[Tool_MySQLi] ';
    private bool $status = false;
    private mysqli $mysqli;

    /**
     * string $ip | mysqli address
     * port $port | mysqli port
     * string $user | mysqli username
     * string $passwd | mysqli password
     * string $database | mysqli database name
     */

    public function __construct(string $ip, int $port, string $user, string $passwd, string $database){

        $this->mysqli = new mysqli($ip, $user, $passwd, $database, $port);

        if ($this->mysqli->connect_error){

            $this->text($this->mysqli->connect_error);

            $this->status = false;

        }

        $this->status = true;

    }

    /**
     * string $table | table name
     * array $options | ['name VARCHAR(20) PRIMARY KEY', 'test TEXT', ...]
     */

    public function createTable(string $table, array $options): void{

        if (!$this->status){

            $this->text($this->mysqli->connect_error);

            return;

        }

        $result = $this->mysqli->query("CREATE TABLE IF NOT EXISTS '" . $table . "' ('" . implode(', ', $options) . "');");

        if (!$result){

            $this->text($this->mysqli->error);

            return;

        }

    }

    public function text(string $text): void{

        echo $this->prefix . $text;

    }

}
?>