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

$sql = "SELECT * FROM items";
$result = $conn->query($sql);

echo '<div class="container mt-2">
<input type="text" id="searchInput" placeholder="Search For Items..."/>
';
if ($result->num_rows > 0) {
    echo '<table class="table" id="dataTable">';
    echo "<tr><th>Item Name</th><th>Item Category</th><th>Item Price</th><th>Ingredients</th><th>Order</th><th>Edit Item</th><th></th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["item_name"]."</td>
                <td><a href='editItemCategory?item=".$row["item_name"]."'>".$row["item_category"]."</a></td>
                <td>".$row["item_price"]." $</td>
                <td>".$row["item_ingredients"]."</td>
                <td>".$row["Order"]."</td>
                <td><a href='editItem?item=".$row["item_name"]."&category=".$row["item_category"]."'><i class='fa fa-pencil' style='font-size:24px'></i></a></td>
                <td><a href='deleteItem?it=".$row["item_id"]."' style='text-decoration: none; color: black'><i class='fa fa-trash-o' style='font-size:36px'></i></a></td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

 echo '</div>';

$conn->close();


include "footer.php";
?>