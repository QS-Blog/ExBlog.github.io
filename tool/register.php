<?php
include 'conn.php';
session_start();
// 从表单获取数据
$counter = $_POST['counter'];
$firstPassword = $_POST['firstPassword'];
$surePassword = $_POST['surePassword'];
$name = $_POST['name'];
// 检查两次密码是否一致
if ($firstPassword !== $surePassword) {
    die("两次密码输入不一致，请返回重新输入."); // 密码不一致，提示并终止执行
}




// 根据 session 中的角色进行不同的注册处理
if (isset($_SESSION['type'])) {
    if ($_SESSION['type'] === 'teacher') {
        // 检查是否已注册
        $sql = "SELECT * FROM teachers WHERE id = '$counter'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "该账号已被注册，请更换账号。";
            echo "<script> alert('该账号已被注册，请更换账号。'); window.history.back();</script>";
            exit();
        }
        // 准备并绑定 SQL 语句以插入教师数据
        $sql = "INSERT INTO teachers (id, password, name) VALUES ('$counter', '$firstPassword', '$name')";
        $result = $conn->prepare($sql);


        // 执行语句
        if ($result->execute()) {
            echo "教师注册成功！";
            echo "<script> alert('教师注册成功！'); </script>";
            //header("Location:../Teacher/Php/tea_Login.php"); // 跳转到主页

        } else {
            echo "<script>alert('教师注册失败: " . $result->error . "'); window.history.back();</script>";
        }
    } else if ($_SESSION['type'] === 'student') {
        // 检查是否已注册
        $sql = "SELECT * FROM students WHERE id = '$counter'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "该账号已被注册，请更换账号。";
            echo "<script> alert('该账号已被注册，请更换账号。'); window.history.back();</script>";
            exit();
        }
        // 准备并绑定 SQL 语句以插入学生数据
        $sql = "INSERT INTO students (id, password, name) VALUES ($counter, '$firstPassword', '$name')";
        echo $sql;
        $result = $conn->prepare($sql);
        // 执行语句
        if ($result->execute()) {
            echo "学生注册成功！";
            echo "<script> alert('学生注册成功！'); </script>";
            // 跳转到主页
        } else {
            echo " <script>alert('学生注册失败: " . $result->error . "'); window.history.back(); </script>";
        }
    } else {
        die("未识别的角色，请联系管理员。");
    }
} else {
    die("未识别错误");
}

// 关闭数据库连接
$conn->close();

// 其他处理逻辑，例如重定向或输出成功信息等
?>