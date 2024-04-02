<?php
// เริ่ม session
session_start();

// ลบตัวแปร session ทั้งหมด
session_unset();

// ทำลาย session
session_destroy();

// ส่งกลับไปยังหน้า login_admin.php
header("Location: login_admin.php");
exit();
?>
