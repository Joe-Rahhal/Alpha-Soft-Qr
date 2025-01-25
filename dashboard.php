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


?>

<div class="container mb-1 mt-1 text-white">
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-4">
            <a href="addItem" class="btn btn-primary mb-1 mt-1 w-100">Add Item</a>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4">
            <a href="addCategory" class="btn btn-primary mb-1 mt-1 w-100">Add Category</a>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4">
            <a href="viewItems" class="btn btn-primary mb-1 mt-1 w-100">View Items</a>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4">
            <a href="viewCategories" class="btn btn-primary mb-1 mt-1 w-100">View Categories</a>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4">
            <a href="updateuser" class="btn btn-primary mb-1 mt-1 w-100">User Info</a>
        </div>
    </div>
    
    <form action="logout" method="POST" class="mt-5">
        <input type="submit" class="btn btn-secondary w-100" value="Logout" name="logout" />
    </form>
 
</div>

<?php include "footer.php" ?>