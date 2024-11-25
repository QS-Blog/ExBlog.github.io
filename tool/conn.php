<?php
// 数据库配置信息
$servername = "localhost"; // 数据库服务器地址
$username = "root"; // 数据库用户名
$password = ""; // 数据库密码
$dbname = "myclass"; // 数据库名

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}


// 可选：更改连接字符集为utf8mb4
$conn->set_charset("utf8mb4");

// 执行查询示例（可选）
//$sql = "SELECT * FROM Students";
//$result = $conn->query($sql);

//if ($result->num_rows > 0) {
// 输出数据
//  while ($row = $result->fetch_assoc()) {
//    echo "学号: " . $row["id"] . " - 姓名: " . $row["name"] . "<br>";
//}
//} else {
//  echo "0 结果";
//}

// 关闭连接
//$conn->close();
?>