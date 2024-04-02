<?php
// เชื่อมต่อกับฐานข้อมูล
$servername = "localhost";
$db_username = "satit";
$db_password = "XpVfMtEV";
$db_name = "satit";

$conn = new mysqli($servername, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

// ค้นหาผู้ใช้จากฐานข้อมูลโดยใช้ชื่อผู้ใช้เป็นเงื่อนไข
$sql = "SELECT * FROM login_system WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // พบผู้ใช้ในฐานข้อมูล
    $row = $result->fetch_assoc();
    $hashed_password = $row['password'];
    
    // ตรวจสอบรหัสผ่าน
    if (password_verify($password, $hashed_password)) {
        // รหัสผ่านถูกต้อง
        $role = $row['role'];
        if ($role == 'admin') {
            header("Location: upload_announce.php");
            exit();
        } else {
            header("Location: login_admin.php");
            exit();
        }
    } else {
        // รหัสผ่านไม่ถูกต้อง
        echo "Invalid username or password";
    }
} else {
    // ไม่พบผู้ใช้ในฐานข้อมูล
    echo "Invalid username or password";
}

$conn->close();
?>
