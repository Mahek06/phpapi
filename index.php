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

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET['action']) && $_GET['action'] == 'driver-all') {
            // Get data for a specific driver
            $sql = "SELECT * FROM driver";
            $result = $conn->query($sql);

            $drivers = $result->fetch_all(MYSQLI_ASSOC);

        header("Content-Type: application/json");
        echo json_encode(['data'=>$drivers]);
        }

        if (isset($_GET['action']) && $_GET['action'] == 'driver') {
            $did = $_GET["id"];
            $sql = "SELECT * FROM users WHERE did='$did'";
            $result = mysqli_query($conn, $sql);
            $drivers = mysqli_fetch_assoc($result);
            header("Content-Type: application/json");
            echo json_encode(['data' => $drivers]);
        }
        // if ($result->num_rows > 0) {
        //     $drivers = array();
        //     while ($row = $result->fetch_assoc()) {
        //         $drivers[] = $row;
        //     }
        //     http_response_code(200); // OK
        //     echo json_encode($drivers);
        // } else {
        //     http_response_code(404); // Not Found
        //     echo json_encode(array("message" => "No drivers found"));
        // }
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get input data
        if (isset($_POST["insert-driver"])) {
            $dname = $data['dname'];
            $dpass = $data['dpass'];
            $dphone = $data['dphone'];
            $demail = $data['demail'];
            $driverno = $data['driverno'];
            $loc = $data['loc'];
            $pincode = $data['pincode'];
            $charges = $data['charges'];
            $available = $data['available'];
            $stime = $data['stime'];
            $etime = $data['etime'];
            $cab = $data['cab'];
            $date = $data['date'];
            $cabno = $data['cabno'];
            $status = $data['status'];
            $login = $data['login'];
            $sql = "INSERT INTO driver (dname, dpass, dphone, demail, driverno, loc, pincode, charges, available, stime, etime, cab, date, cabno, status, login)
            VALUES ('$dname', '$dpass', '$dphone', '$demail', '$driverno', '$loc', '$pincode', '$charges', '$available', '$stime', '$etime', '$cab', '$date', '$cabno', '$status', '$login')";
            mysqli_query($conn, $sql);
            $drivers = array(
                "did" => $did,
                "dname" => $dname,
                "dpass" => $dpass,
                "demail" => $demail,
                "dphone" => $dphone,
                "driverno" => $driverno
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
            echo json_encode($drivers);
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get input data
        if (isset($_POST["-driver"])) {
            $dname = $data['dname'];
            $dpass = $data['dpass'];
            $dphone = $data['dphone'];
            $demail = $data['demail'];
            $driverno = $data['driverno'];
            $loc = $data['loc'];
            $pincode = $data['pincode'];
            $charges = $data['charges'];
            $available = $data['available'];
            $stime = $data['stime'];
            $etime = $data['etime'];
            $cab = $data['cab'];
            $date = $data['date'];
            $cabno = $data['cabno'];
            $status = $data['status'];
            $login = $data['login'];
            $sql = "UPDATE driver SET dname='$dname', dpass='$dpass', dphone='$dphone', demail='$demail', driverno='$driverno', loc='$loc', pincode='$pincode', charges='$charges', available='$available', stime='$stime', etime='$etime', cab='$cab', date='$date', cabno='$cabno', status='$status', login='$login'
            WHERE did='$did'";
            mysqli_query($conn, $sql);
            $drivers = array(
                "did" => $did,
                "dname" => $dname,
                "dpass" => $dpass,
                "demail" => $demail,
                "dphone" => $dphone,
                "driverno" => $driverno
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
            echo json_encode($drivers);
        }
    }
}