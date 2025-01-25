<?php 
include "connection.php";
session_start();
include "header.php";
if($_SESSION["isAdmin"] != true){
    echo '<script>window.location.assign("index")</script>';
}
?>

<?php
    $item = $_GET["item"];
    $category = $_GET["category"];

    if (isset($_POST["submit"])) {

        $id = $_POST["id"];
        $name = $_POST['newName'];
        $price = $_POST['newPrice'];
        $ingredients = $_POST['ingredients'];
        $order = $_POST['order'];
      
        $sql = "UPDATE `items` SET `item_name`='$name',`item_price`='$price', `item_ingredients`='$ingredients', `Order`='$order' WHERE item_id = '$id'";
      
        $result = mysqli_query($conn, $sql);
      
        if ($result) {
          echo '<script>window.location.assign("viewItems.php")</script>';
        } else {
          echo "Failed: " . mysqli_error($conn);
        }
      }

    if($item != null){
        $sql = "SELECT * FROM items WHERE item_name='$item' AND item_category='$category'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    }
    
?>

<div class="container">
    <h2>Edit Item <?php echo $item ?></h2>
    <form method="POST" action="editItem.php">

        <input type="hidden" name="id" value="<?php echo $row["item_id"]; ?>">

        <label for="newName">Name:</label>
        <input class="form-control" type="text" name="newName" value="<?php echo $row['item_name']; ?>" required><br>

        <label for="newPrice">Price:</label>
        <input class="form-control" type="number" name="newPrice" step="any" value="<?php echo $row['item_price']; ?>" required><br>
        
        <label for="newPrice">Ingredients:</label>
        <input class="form-control" type="text" name="ingredients" value="<?php echo $row['item_ingredients']; ?>" required><br>

        <label for="newPrice">Order:</label>
        <input class="form-control" type="number" name="order" value="<?php echo $row['Order']; ?>" required><br>

        <input class="btn btn-primary" type="submit" value="Update" name="submit">
    </form>
</div>

    <?php
    mysqli_close($conn);
    ?>

<?php include "footer.php" ?>