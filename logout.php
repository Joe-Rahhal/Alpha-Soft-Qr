<?php

include "connection.php";
session_start();
ob_start();

if(isset($_POST["logout"])){
    unset($_SESSION["user_name"]);
    unset($_SESSION["isAdmin"]);
    header("Location: index");
    ob_end_flush();
}

?>