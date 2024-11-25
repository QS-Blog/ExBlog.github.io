<?php
session_start();
include '..\..\tool\conn.php'; // 引入数据库连接
date_default_timezone_set('Asia/Shanghai'); // 设置为中国时间

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $currentDateTime = date('Y-m-d H:i:s');

    // 更新签到记录
    $sql = "UPDATE Students SET signDate ='$currentDateTime' ,isSign = 1 WHERE id = $id";
    echo $sql;
    $stmt = $conn->prepare($sql);
    if ($stmt->execute()) {
        // 更新成功，重定向回管理界面
        header("Location: ../Php/teacher_Sign_In.php");
        exit();
    } else {
        // 处理错误
        echo "更新失败: " . $conn->error;
    }

    $stmt->close();
}

?>