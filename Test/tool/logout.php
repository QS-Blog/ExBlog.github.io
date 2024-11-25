<?php
session_start(); // 开始会话
session_destroy(); // 销毁会话
header("Location:../index.php"); // 重定向到 index.php
$conn->close(); // 关闭数据库连接
exit(); // 确保后续代码不再执行
?>