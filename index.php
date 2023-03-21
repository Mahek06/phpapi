<?php // database connection settings
$host = "localhost";
$username = "root";
$password = "mysql";
$dbname = "collen";

// create database connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// handle GET request
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // get all users
    if (isset($_GET['action']) && $_GET['action'] == 'women-all') {
        $sql = "SELECT * FROM user";
        $result = $conn->query($sql);
        // $res = [];
        // while ($obj = $result->fetch_object()) {
        //     array_push($res,$obj);
        // }
        $users = $result->fetch_all(MYSQLI_ASSOC);

        header("Content-Type: application/json");
        echo json_encode(['data'=>$users]);
    }

    // get user by uid
    if (isset($_GET['action']) && $_GET['action'] == 'women') {
        $uid = $_GET["id"];
        $sql = "SELECT * FROM users WHERE uid='$uid'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);
        header("Content-Type: application/json");
        echo json_encode(['data' => $user]);
    }

    
}

// handle POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // create user
    if (isset($_POST["insert-women"])) {
        $uname = $_POST["uname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $phone = $_POST["phone"];
        $is_login = isset($_POST["is_login"]) ? 1 : 0;
        $sql = "INSERT INTO user (uname, email, password, phone, is_login) VALUES ('$uname', '$email', '$password', '$phone', '$is_login')";
        mysqli_query($conn, $sql);
        $uid = mysqli_insert_id($conn);
        $user = array(
            "uid" => $uid,
            "uname" => $uname,
            "email" => $email,
            "password" => $password,
            "phone" => $phone,
            "is_login" => $is_login
        );
        header("Content-Type: application/json");
        echo json_encode(['data' => $user]);
    }

    // update user
    if (isset($_POST["update-women"])) {
        $uid = $_POST["uid"];
        $uname = $_POST["uname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $phone = $_POST["phone"];
        $is_login = isset($_POST["is_login"]) ? 1 : 0;
        $sql = "UPDATE user SET uname='$uname', email='$email', password='$password', phone='$phone', is_login='$is_login' WHERE uid='$uid'";
        mysqli_query($conn, $sql);
        $user = array(
            "uid" => $uid,
            "uname" => $uname,
            "email" => $email,
            "password" => $password,
            "phone" => $phone,
            "is_login" => $is_login
        );
        header("Content-Type: application/json");
        echo json_encode($user);
    }

}