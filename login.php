<?php 
include "connection.php";
session_start();
include "header.php";
?>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <form action="login.php" method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mt-1" name="submit">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php  

if(isset($_POST['submit'])){
    $name = $_POST["username"];
    $pass = $_POST["password"];

    $query = "SELECT username FROM users WHERE username = '$name' AND userpassword = '$pass' AND isAdmin = 1";

    $result = mysqli_query($conn, $query);
      
    if ($result && mysqli_num_rows($result) > 0) {
        $_SESSION["user_name"] = $name;
        $_SESSION["isAdmin"] = true;
        echo '<script>window.location.assign("dashboard")</script>';
    } else {
        $_SESSION["isAdmin"] = false;
        echo "<div class='container text-center mt-4'>
        Wrong email or password
        </div>
        ";
    }
}

?>

<?php include "footer.php" ?>