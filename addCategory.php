<?php
include "connection.php";
?>
<?php
session_start();
include "header.php";
if($_SESSION["isAdmin"] != true){
    echo '<script>window.location.assign("index")</script>';
}
?>

<div class="container mt-3 mb-3">
    <h2>Add a Category:</h2>
    <form action="addCategory.php" method="POST" enctype="multipart/form-data">
        <label class="form-label">Category name:</label>
        <input type="text" class="form-control" name="catname"/><br>
        <label class="form-label">Order:</label>
        <input type="number" name="order" required/><br>
        <label class="form-label">Category image:</label>
        <input type="file" name="catimage" required/><br>
        <input type="submit" class="btn btn-primary" value="Submit" name="submit"/>
    </form>
    
</div>

<?php

    if (isset($_POST['submit'])) {

        $img_name = $_FILES['catimage']['name'];
        $img_size = $_FILES['catimage']['size'];
        $tmp_name = $_FILES['catimage']['tmp_name'];
        $error = $_FILES['catimage']['error'];

        $name = $_POST["catname"] ?? null;
        $order = $_POST["order"] ?? null;

        if ($error === 0) {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png"); 

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                    $img_upload_path = 'uploads/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    // Insert into Database
                    $sql = "INSERT INTO categories(cat_name, cat_picture, `Order`) 
                            VALUES('$name', '$new_img_name', '$order')";
                    mysqli_query($conn, $sql);
                    echo '<div class="container">Successfull</div>';
                    echo '<script>window.location.assign("dashboard.php")</script>';
                    
                }else {
                    $em = "You can't upload files of this type";
                    echo '<script>window.location.assign("index")</script>';
                }
        }else {
            $em = "unknown error occurred!";
            echo '<script>window.location.assign("index")</script>';
        }

    }

?>

<?php include "footer.php"; ?>