<?php
include "connection.php"; 
session_start();
include "header.php";
if($_SESSION["isAdmin"] != true){
    echo '<script>window.location.assign("index")</script>';
}
?>

<?php 

$category = $_GET["category"] ?? null; 
if($category != null){
    $sql = "SELECT * FROM categories WHERE cat_name='$category'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}

?>

<div class="container mt-3 mb-3">
    <div class="mt-1 mb-1">
        <h2>Edit Image: <?php echo $category ?></h2>
        <form action="editCategoryImage.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row["cat_id"] ?>">
            <label class="form-label">Category image:</label>
            <input type="file" name="image" required/><br>
            <input type="submit" class="btn btn-primary" value="Submit" name="submit"/>
        </form>
    </div>   
</div>

<?php

if (isset($_POST['submit'])) {

    $id = $_POST["id"];

    $img_name = $_FILES['image']['name'];
    $img_size = $_FILES['image']['size'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $error = $_FILES['image']['error'];

    if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png"); 

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = 'uploads/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                // Insert into Database
                $sql = "UPDATE `categories` SET `cat_picture` = '$new_img_name' WHERE cat_id = '$id'";
                mysqli_query($conn, $sql);
                echo '<script>window.location.assign("dashboard")</script>';
                
            }else {
                $em = "You can't upload files of this type";
                echo $em;
            }
    }else {
        $em = "unknown error occurred!";
        echo $em;
    }

}

?>

<?php include "footer.php"; ?>