<?php
include "connection.php";
session_start();
include "header.php";


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

$category = $_GET["category"];
$sql = "SELECT * from items WHERE item_category='$category'";
$result = $conn->query($sql);

echo '<div class="container mt-2">
<h4>'.$category.'</h4>
<input type="text" id="searchInput" placeholder="Search For Items..."/>
';
if ($result->num_rows > 0) {
    echo '<table class="table" id="dataTable">';
    echo "<tr><th>Item Name</th><th>Item Category</th><th>Item Price</th><th>Order</th><th>Edit Item</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["item_name"]."</td>
                <td><a href='editItemCategory?item=".$row["item_name"]."'>".$row["item_category"]."</a></td>
                <td>".$row["item_price"]." $</td>
                <td>".$row["Order"]."</td>
                <td><a href='editItem?item=".$row["item_name"]."&category=".$row["item_category"]."'><i class='fa fa-pencil' style='font-size:24px'></i></a></td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "No Items Found!";
}

 echo '</div>';

$conn->close();

include "footer.php";
?>