<?php
// 引入连接数据库的文件
// 引入连接数据库的文件，确保路径正确
include '..\..\tool\conn.php';

// 开启会话
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取表单提交的数据
    $teacherId = $_POST['teacherId'];
    $password = $_POST['password'];

    // SQL 查询语句
    $sql = "SELECT * FROM teachers WHERE id = $teacherId AND password = '$password'";
    echo $sql;
    $result = $conn->query($sql);

    // 检查查询结果
    if ($result->num_rows > 0) {
        // 登录成功，保存用户信息到 session
        $user = $result->fetch_assoc(); // 获取用户信息
        $_SESSION['id'] = $user['id']; // 保存学号到 session
        $_SESSION['name'] = $user['name']; // 假设还有一个名字字段
        $_SESSION['gender'] = $user['gender']; // 假设还有一个性别字段
        // 假设还有一个是否签到字段
        $_SESSION['avatar'] = $user['avatar']; // 假设还有一个头像字段
        $_SESSION['type'] = "teacher";

        echo "登录成功！";
        // 可以在这里重定向到主页或其他页面
        header("Location: ../Php/teacherPage.php"); // 为实际主页链接
        exit();
    } else {// TODO:替换为忘记密码页面的链接
        // 登录失败
        echo "<script>
                alert('职工号或密码错误，请重试。');
            </script>";
    }
}

//$conn->close(); // 关闭数据库连接
?>