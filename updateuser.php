<?php
include "connection.php";
session_start();
include "header.php";

if(!isset($_SESSION["isAdmin"]) || $_SESSION["isAdmin"] != true){
    echo '<script>window.location.assign("index")</script>';
    exit();
}

$isAdmin = 0;
$username = $_SESSION["user_name"];
$query = "SELECT isAdmin FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 1) {
    $row = $res->fetch_assoc();
    $isAdmin = $row["isAdmin"];
}

if($isAdmin == 0){
    echo '<script>window.location.assign("index")</script>';
    exit();
}

$name = $_SESSION["user_name"];
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}

?>

<div class="container">
    <form action="updateuser.php" method="POST">
        <label class="form-label">User Name:</label>
        <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($row["username"]); ?>"/><br>
        <label class="form-label">Password:</label>
        <input type="password" class="form-control" name="password" value="<?php echo htmlspecialchars($row["userpassword"]); ?>"/><br>
        <input type="submit" class="btn btn-primary" value="Update" name="update"/>
    </form>
</div>

<?php
if(isset($_POST["update"])){
    $uname = $_POST["username"];
    $pass= $_POST["password"];
    $sql1 = "UPDATE users SET username=?, userpassword=? WHERE user_id = 1";
    $stmt = $conn->prepare($sql1);
    $stmt->bind_param("ss", $uname, $pass);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo '<script>window.location.assign("dashboard")</script>';
        exit();
    }
    else{
        echo "Error Occurred";
    }
}
include "footer.php";
?>
