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
        // $sql = "SELECT `uid`, `uname`, `phone`,`email`, `password`, `is_login` FROM `user`";
        $sql = "SELECT * FROM `user`";
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
        $sql = "SELECT * FROM user WHERE uid='$uid'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);
        header("Content-Type: application/json");
        echo json_encode(['data' => $user]);
    }

    if (isset($_GET['action']) && $_GET['action'] == 'driver-all') {
        // Get data for a specific driver
        $sql = "SELECT * FROM driver";
        $result = $conn->query($sql);

        $driver = $result->fetch_all(MYSQLI_ASSOC);

        header("Content-Type: application/json");
        echo json_encode(['data'=>$driver]);
    }


    if (isset($_GET['action']) && $_GET['action'] == 'driver') {
        $did = $_GET["id"];
        $sql = "SELECT * FROM driver WHERE did='$did'";
        $result = mysqli_query($conn, $sql);
        $driver = mysqli_fetch_assoc($result);
        header("Content-Type: application/json");
        echo json_encode(['data' => $driver]);
    }
        
    if (isset($_GET['action']) && $_GET['action'] == 'booking-all') {
        $sql = "SELECT * FROM booking";
        $result = $conn->query($sql);

        $booking = $result->fetch_all(MYSQLI_ASSOC);

        header("Content-Type: application/json");
        echo json_encode(['data'=>$booking]);
    }

    if (isset($_GET['action']) && $_GET['action'] == 'booking') {
        $bid = $_GET["id"];
        $sql = "SELECT * FROM booking WHERE bid='$bid'";
        $result = mysqli_query($conn, $sql);
        $booking = mysqli_fetch_assoc($result);
        header("Content-Type: application/json");
        echo json_encode(['data' => $booking]);
    }

}

// handle POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  
    // create user
    if (isset($_GET['action']) && $_GET['action'] == 'insert-women') {
        $_POST = (array)json_decode(file_get_contents("php://input"));
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
    if (isset($_GET['action']) && $_GET['action'] == 'update-women') {
        $_POST = (array)json_decode(file_get_contents("php://input"));
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
        // Get input data
        if (isset($_GET['action']) && $_GET['action'] == 'insert-driver') {
            $_POST = (array)json_decode(file_get_contents("php://input"));
            $dname = $_POST['dname'];
            $dpass = $_POST['dpass'];
            $dphone = $_POST['dphone'];
            $demail = $_POST['demail'];
            $driverno = $_POST['driverno'];
            $loc = $_POST['loc'];
            $pincode = $_POST['pincode'];
            $charges = $_POST['charges'];
            $available = $_POST['available'];
            $stime = $_POST['stime'];
            $etime = $_POST['etime'];
            $cab = $_POST['cab'];
            $date = $_POST['date'];
            $cabno = $_POST['cabno'];
            $status = $_POST['status'];
            $login = $_POST['login'];
            $sql = "INSERT INTO driver (did,dname, dpass, dphone, demail, driverno, loc, pincode, charges, available, stime, etime, cab, date, cabno, status, login)
            VALUES (NULL,'$dname', '$dpass', '$dphone', '$demail', '$driverno', '$loc', '$pincode', '$charges', '$available', '$stime', '$etime', '$cab', '$date', '$cabno', '$status', '$login')";
            mysqli_query($conn, $sql);
            $driver = array(
                "dname" => $dname,
                "dpass" => $dpass,
                "demail" => $demail,
                "dphone" => $dphone,
                "driverno" => $driverno,
                "loc" => $loc,
                "pincode" => $pincode,
                "charges" => $charges,
                "available" => $available,
                "stime" => $stime,
                "etime" => $etime,
                "cab" => $cab,
                "date" => $date,
                "cabno" => $cabno,
                "status" => $status,
                "login" => $login,
            );
            header("Content-Type: application/json");
            echo json_encode(['error'=>false,'data'=>$driver]);
        }

        if (isset($_GET['action']) && $_GET['action'] == 'update-driver'){
            $_POST = (array)json_decode(file_get_contents("php://input"));
            $did = $_POST['did'];
            $dname = $_POST['dname'];
            $dpass = $_POST['dpass'];
            $dphone = $_POST['dphone'];
            $demail = $_POST['demail'];
            $driverno = $_POST['driverno'];
            $loc = $_POST['loc'];
            $pincode = $_POST['pincode'];
            $charges = $_POST['charges'];
            $available = $_POST['available'];
            $stime = $_POST['stime'];
            $etime = $_POST['etime'];
            $cab = $_POST['cab'];
            $date = $_POST['date'];
            $cabno = $_POST['cabno'];
            $status = $_POST['status'];
            $login = $_POST['login'];
            $sql = "UPDATE driver SET dname='$dname', dpass='$dpass', dphone='$dphone', demail='$demail', driverno='$driverno', loc='$loc', pincode='$pincode', charges='$charges', available='$available', stime='$stime', etime='$etime', cab='$cab', date='$date', cabno='$cabno', status='$status', login='$login'
            WHERE did='$did'";
            mysqli_query($conn, $sql);
            $driver = array(
                "did" => $did,
                "dname" => $dname,
                "dpass" => $dpass,
                "demail" => $demail,
                "dphone" => $dphone,
                "driverno" => $driverno,
                "loc" => $loc,
                "pincode" => $pincode,
                "charges" => $charges,
                "available" => $available,
                "stime" => $stime,
                "etime" => $etime,
                "cab" => $cab,
                "date" => $date,
                "cabno" => $cabno,
                "status" => $status,
                "login" => $login,
            );
        header("Content-Type: application/json");
        echo json_encode($driver);
    }

    if (isset($_GET['action']) && $_GET['action'] == 'insert-booking') {
        $_POST = (array)json_decode(file_get_contents("php://input"));
        $uid = $_POST['uid'];
        $did = $_POST['did'];
        $pickupadd = $_POST['pickupadd'];
        $dropadd = $_POST['dropadd'];
        $status = $_POST['status'];
        $price = $_POST['price'];
        $sql = "INSERT INTO booking (bid,uid, did, pickupadd, dropadd, status, price) VALUES (NULL,'$uid', '$did', '$pickupadd', '$dropadd', '$status', '$price')";
        mysqli_query($conn, $sql);
        $booking = array(
            "uid" => $uid,
            "did" => $did,
            "pickupadd" => $pickupadd,
            "dropadd" => $dropadd,
            "status" => $status,
            "price" => $price,
        );
        header("Content-Type: application/json");
        echo json_encode($booking);
    }

    if (isset($_GET['action']) && $_GET['action'] == 'update-booking') {
        $_POST = (array)json_decode(file_get_contents("php://input"));
        $bid = $_POST['bid'];
        $uid = $_POST['uid'];
        $did = $_POST['did'];
        $pickupadd = $_POST['pickupadd'];
        $dropadd = $_POST['dropadd'];
        $status = $_POST['status'];
        $price = $_POST['price'];
        $sql = "UPDATE booking SET uid='$uid', did='$did', pickupadd='$pickupadd', dropadd='$dropadd', status='$status', price='$price' WHERE bid='$bid'";
        mysqli_query($conn, $sql);
        $booking = array(
            "bid" => $bid,
            "uid" => $uid,
            "did" => $did,
            "pickupadd" => $pickupadd,
            "dropadd" => $dropadd,
            "status" => $status,
            "price" => $price,
        );
        header("Content-Type: application/json");
        echo json_encode($booking);
    }

}