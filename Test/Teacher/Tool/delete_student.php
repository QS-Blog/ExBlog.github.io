<?php
session_start(); // 开启会话以便使用 session 变量
include '..\..\tool\conn.php'; // 引入数据库连接文件

// 检查是否通过 GET 请求接收到学生 ID 参数
if (isset($_GET['id'])) {
    $id = $_GET['id']; // 获取学生的 ID


    try {
        // 构建删除学生记录的 SQL 语句
        $sql_delete_student = "DELETE FROM students WHERE id = $id"; // 使用占位符
        $result = $conn->prepare($sql_delete_student); // 准备 SQL 语句



        // 执行删除学生记录的 SQL 语句
        $result->execute();

        // 删除成功，重定向回管理学生页面
        header("Location: ../Php/teacher_guanli.php"); // 重定向到教师页面
        exit(); // 终止脚本执行
    } catch (Exception $e) {
        echo "删除失败: " . $e->getMessage(); // 输出错误信息
    }
}


$conn = null; // 关闭数据库连接
?>