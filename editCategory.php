<?php 
include "connection.php";
session_start();
include "header.php";
if($_SESSION["isAdmin"] != true){
    echo '<script>window.location.assign("index")</script>';
}
?>

<?php
    $categ = $_GET["category"] ?? null;

    $c = $categ;

    if (isset($_POST["submit"])) {

        $id = $_POST["id"];
        $name = $_POST['newName'];
        $name = $_POST['order'];
      
        $sql = "UPDATE `categories` SET `cat_name`='$name', `Order`='$order' WHERE cat_id = '$id'";
      
        $result = mysqli_query($conn, $sql);
      
        if ($result) {
          echo '<script>window.location.assign("viewCategories.php")</script>';
        } else {
          echo "Failed: " . mysqli_error($conn);
        }
      }

    if($categ != null){
        $sql = "SELECT * FROM categories WHERE (cat_name='$categ')";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    }
    
?>

<div class="container">
    <h2>Edit Item</h2>
    <form method="POST" action="editCategory.php">

        <input type="hidden" name="id" value="<?php echo $row["cat_id"] ?>">

        <label for="newName">Name:</label>
        <input class="form-control" type="text" name="newName" value="<?php echo $row['cat_name']; ?>" required><br>

        <label for="newName">Order:</label>
        <input class="form-control" type="text" name="order" value="<?php echo $row['Order']; ?>" required><br>

        <input class="btn btn-primary" type="submit" value="Update" name="submit">
    </form>
</div>

    <?php
    // Close database connection
    mysqli_close($conn);
    ?>

<?php include "footer.php" ?>