<?php
include '../../tool/conn.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $message = htmlspecialchars($_POST['message']);
    $_SESSION['message'] = $message;

    $userID = $_SESSION['id'];
    $type = $_SESSION['type'];

    $userID = $_SESSION['id'];
    $sql = "INSERT INTO messages (username, message,userID,type) VALUES ('$username', '$message' , $userID,'$type')";
    print ($sql);
    // 插入数据库，省略 id 字段
    $result = $conn->prepare($sql);


    if ($result->execute()) {
        echo "留言成功！";
        header("Location:liuYan.php");
    } else {

        echo "留言失败: ";
    }
}

$conn->close();
?>