<?php

class dbConnect {
    public $host = "localhost";
    public $user = "mw5";
    public $pass = "dupa";

    public function connection($db, $query) {
        $connection = new mysqli($this->host, $this->user, $this->pass, $db);
        if (mysqli_connect_errno()) {
            echo "DB connection problem, change this notification later";
            exit;
        } else {
            $response = $connection->query($query);
            $connection->close();
            return $response;
        }
    }
}