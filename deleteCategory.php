<?php
include "connection.php";
session_start();
include "header.php";

if($_SESSION["isAdmin"] != true){
    echo '<script>window.location.assign("index")</script>';
}

$isAdmin = 0;
$username = $_SESSION["user_name"];
$query = "SELECT isAdmin FROM users WHERE username = '$username'";
$res = mysqli_query($conn, $query);

if (mysqli_num_rows($res) === 1) {

    $row = mysqli_fetch_assoc($res);
    if($row["isAdmin"] == 1){
        $isAdmin = 1;
    }
    else{
        $isAdmin = 0;
    }
}

if($isAdmin == 0){
    echo '<script>window.location.assign("index")</script>';
}

$id = $_GET["cat"];
if ($id != null) {
$stmt = $conn->prepare("DELETE FROM categories WHERE cat_id = '$id'");
$stmt->execute();
echo '<script>window.location.assign("viewCategories")</script>';
}
else{
    echo '<script>window.location.assign("viewCategories")</script>';
    exit();
}
?>