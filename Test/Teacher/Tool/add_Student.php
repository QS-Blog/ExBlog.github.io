<?php
session_start();
include '..\..\tool\conn.php'; // 引入数据库连接

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    // 添加学生记录到 students 表
    $sql = "INSERT INTO students (id, name,password,gender) VALUES ($id, '$name',000000,'$gender')";
    $result = $conn->prepare($sql);

    if ($result->execute()) {
        // 同步到签到表
        // 添加成功，重定向回管理学生页面
        header("Location:../Php/teacher_guanli.php");
        exit();
    } else {
        // 处理错误
        echo "添加失败: " . $conn->error;
    }
}
$conn->close();
?>