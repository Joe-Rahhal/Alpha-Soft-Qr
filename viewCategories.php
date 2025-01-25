<?php

include "connection.php";
session_start();
include "header.php";
if($_SESSION["isAdmin"] != true){
    echo '<script>window.location.assign("index")</script>';
}

$sql = "SELECT * FROM categories";
$result = $conn->query($sql);

    echo '<div class="container">
    <input type="text" id="searchInput" placeholder="Search For Items..."/>
    ';
    
    if ($result->num_rows > 0) {
        
        echo '<table class="table" id="dataTable">';
        echo "<tr><th>Category Name</th><th>Order</th><th>Edit Image</th><th>Edit Category</th><th></th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "  <tr>
                        <td><a href='viewItemsByCategory?category=".$row["cat_name"]."' style='text-decoration: none; color: black'>".$row["cat_name"]."</a></td>
                        <td>".$row["Order"]."</td>
                        <td><a href='editCategoryImage?category=".$row["cat_name"]."'><i class='fa fa-pencil' style='font-size:24px'></i></a></td>
                        <td><a href='editCategory?category=".$row["cat_name"]."'><i class='fa fa-pencil' style='font-size:24px'></i></a></td>
                        <td><a href='deleteCategory?cat=".$row["cat_id"]."' style='text-decoration: none; color: black'><i class='fa fa-trash-o' style='font-size:36px'></i></a></td>
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