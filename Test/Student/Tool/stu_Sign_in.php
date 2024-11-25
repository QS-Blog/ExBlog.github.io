<?php
session_start();
include '..\..\tool\conn.php'; // 引入数据库连接文件
date_default_timezone_set('Asia/Shanghai'); // 设置为中国时间
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 获取签到状态
    $checkin_status = intval($_POST['isSign']);
    $id = $_SESSION['id']; // 获取当前用户 ID
    $username = $_SESSION['name']; // 获取当前用户
    $current_date = date('Y-m-d H:i:s'); // 获取当前日期和时间
    echo $current_date;

    // 更新签到状态和日期到数据库
    if ($checkin_status == 1) {
        // 签到成功，更新状态和日期
        $update_sql = "UPDATE Students SET isSign = 1, signDate = '$current_date' WHERE id = $id ";
        echo $update_sql;
        $result = $conn->query($update_sql);

        if ($result) {
            // 更新 session
            $_SESSION['isSign'] = 1;
            $_SESSION['signDate'] = $current_date;
            // 签到成功后重定向到原来页面
            header("Location: ..\Php\studentPage.php#SignIn"); // 请将"原来的页面.php"替换为实际页面

        } else {
            echo "签到失败: " . $conn->error;
        }
    } else {
        // 签到状态为未签到
        // 这里可以根据需要处理未签到的情况
    }
}
?>
<script>
    window.onload = function () {
        loadContent('checkin'); // 页面加载时调用签到内容
    };
</script>