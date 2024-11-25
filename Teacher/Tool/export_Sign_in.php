<?php
session_start();
include '..\..\tool\conn.php'; // 引入数据库连接

// 获取导出选择
$export_option = isset($_POST['export_option']) ? $_POST['export_option'] : 'all';

// 设置文件名和SQL查询
if ($export_option == 'all') {
    $filename = "所有学生签到信息.xls"; // 导出所有学生的文件名
    $sql = "SELECT id, name,gender, signDate, isSign FROM Students ORDER BY id ASC";
} elseif ($export_option == 'not_signed_in') {
    $filename = "未签到学生信息.xls"; // 导出未签到学生的文件名
    $sql = "SELECT id, name,gender, signDate, isSign  FROM Students WHERE isSign  = 0 ORDER BY id ASC";
} else {
    $filename = "已签到学生信息.xls"; // 导出已签到学生的文件名
    $sql = "SELECT id, name,gender, signDate, isSign FROM Students WHERE isSign = 1 ORDER BY id ASC";
}

// 设置HTTP头部，指定下载的文件类型和文件名
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');
header('Expires: 0');

// 查询结果
$result = $conn->query($sql);



// 生成 Excel 表格
echo "<meta charset='UTF-8'>"; // 设置字符集为 UTF-8
echo "<table>";
echo "<tr><th>学号</th><th>姓名</th><th>性别</th><th>签到时间</th><th>是否签到</th></tr>";

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
        echo "<td>" . htmlspecialchars($row['signDate'] ?? '未签到') . "</td>"; // 如果未签到显示默认信息
        echo "<td>" . htmlspecialchars($row['isSign'] == 1 ? '是' : '否') . "</td>"; // 正确显示是否签到
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>没有记录</td></tr>";
}

echo "</table>";
$conn->close(); // 关闭数据库连接
?>