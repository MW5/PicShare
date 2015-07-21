<?php

class dbConnect {
    public function connection($host, $user, $pass, $db, $query) {
        $connection = new mysqli($host, $user, $pass, $db);
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