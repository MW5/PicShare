<?php
session_start();
if (isset($_SESSION['loggedUsr'])) {
    echo $_SESSION['loggedUsr'];
} else {
    echo "noUser";
}