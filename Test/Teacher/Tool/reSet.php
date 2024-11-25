<?php
session_start(); // 开始会话
include '../../tool/conn.php'; // 引入数据库连接

// 检查是否存在重置请求
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_sign_in'])) {
    // SQL语句将所有is_signed_in字段更新为0
    $sql = "UPDATE Students SET isSign = 0";

    if ($conn->query($sql) === TRUE) {
        // 更新成功后，刷新页面
        header("Location: ../Php/teacher_Sign_In.php");
        exit();
    } else {
        echo "错误: " . $conn->error;
    }
}
?>