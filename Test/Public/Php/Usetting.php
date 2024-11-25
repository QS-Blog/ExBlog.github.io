<?php
include '../../tool/conn.php';
session_start();
// 处理表单提交
// 处理表单提交
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 获取表单中的数据
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $password = $_POST['password']; // 获取新密码
    $type = $_SESSION['type']; // 获取用户类型
    $userId = $_SESSION['id']; // 获取用户ID
    if ($type == 'teacher') {
        $stmt = $conn->prepare("UPDATE teachers SET name = ?, gender = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $gender, $userId);
        $stmt->execute();
        $stmt->close();
        if (!empty($password)) {

            $stmt = $conn->prepare("UPDATE teachers SET password = ? WHERE id = ?");

            $stmt->bind_param("si", $password, $userId);
            $stmt->execute();
            $stmt->close();
        }
        //处理头像上传
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar'])) {
            $file = $_FILES['avatar'];
            $uploadDir = '../../HeadImg/';
            $filePath = $uploadDir . basename($file['name']);
            //检查文件类型和尺寸等(此处简化处理)
            if (move_uploaded_file($file['tmp_name'], $filePath)) {
                $_SESSION['avatar'] = $filePath;
                //假设用户ID为1，更新数据库中的头像路径
                $stmt = $conn->prepare("UPDATE teachers SET avatar = ? WHERE id = ?");
                $userId = $_SESSION['id'];// 示例用户ID，根据实际情况修改
                $stmt->bind_param("si", $filePath, $userId);
                $stmt->execute();
                $stmt->close();
            } else {
                echo "文件上传失败！";
            }
        }
        $result = $conn->query("SELECT avatar FROM teachers WHERE id = $userId");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['avatar'] = $row['avatar'];
        }
        header("Location: Setting.php");
    } else if ($type == 'student') {
        $stmt = $conn->prepare("UPDATE students SET name = ?, gender = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $gender, $userId);
        $stmt->execute();
        $stmt->close();
        if (!empty($password)) {

            $stmt = $conn->prepare("UPDATE students SET password = ? WHERE id = ?");

            $stmt->bind_param("si", $password, $userId);
            $stmt->execute();
            $stmt->close();
        }
        //处理头像上传
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar'])) {
            $file = $_FILES['avatar'];
            $uploadDir = '../../HeadImg/';
            $filePath = $uploadDir . basename($file['name']);
            //检查文件类型和尺寸等(此处简化处理)
            if (move_uploaded_file($file['tmp_name'], $filePath)) {
                $_SESSION['avatar'] = $filePath;
                //假设用户ID为1，更新数据库中的头像路径
                $stmt = $conn->prepare("UPDATE students SET avatar = ? WHERE id = ?");
                $userId = $_SESSION['id'];// 示例用户ID，根据实际情况修改
                $stmt->bind_param("si", $filePath, $userId);
                $stmt->execute();
                $stmt->close();
            } else {
                echo "文件上传失败！";
            }
        }
        $result = $conn->query("SELECT avatar FROM students WHERE id = $userId");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['avatar'] = $row['avatar'];
        }
        header("Location: Setting.php");
    }

}