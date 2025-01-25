<?php
include "connection.php";
session_start();
include "header.php";
if($_SESSION["isAdmin"] != true){
    echo '<script>window.location.assign("index")</script>';
}

?>

<div class="container mt-3 mb-3">
    <h2>Add an Item:</h2>
    <form action="addItem.php" method="POST" enctype="multipart/form-data">
        <label class="form-label">Item Description:</label>
        <input type="text" class="form-control" name="itemname" required/><br>
        <label class="form-label">Item Price:</label>
        <input type="text" class="form-control" name="itemprice"/><br>
        <label class="form-label">Item Category:</label>
        <select class="form-control" name="categories" id="categories">
                <?php 
                    $sql = "SELECT * FROM categories";
                    $result = mysqli_query($conn, $sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row["cat_name"] ?>"><?php echo $row["cat_name"] ?></option>
                <?php
                        }
                    }
                        
                ?>
        </select><br>
        <label class="form-label">Ingredients:</label>
        <input type="text" class="form-control" name="ingredients"/><br>
        <label class="form-label">Order:</label>
        <input type="text" class="form-control" name="order"/><br>
        <input type="submit" class="btn btn-primary" value="Submit" name="submit"/>
    </form>
    
</div>

<?php

if(isset($_POST["submit"])){
    $name = $_POST["itemname"];
    $price = $_POST["itemprice"];
    $category = $_POST["categories"];
    $ingredients = $_POST["ingredients"];
    $order = $_POST["order"];

    $query = "INSERT INTO items (item_name, item_category, item_price, item_ingredients, `Order`) VALUES ('$name', '$category', '$price', '$ingredients', '$order')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo '<div class="container">Item Added</div>';
        echo '<script>window.location.assign("addItem")</script>';
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}

include "footer.php";
?>