<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Css/teacher_Sign_In.css">

    <?php
    include '../../tool/conn.php';
    session_start(); // 启动 Session
    // 获取 session 中的值
    
    $username = isset($_SESSION['name']) ? $_SESSION['name'] : '教师'; // 获取用户名
    // 引入数据库连接
    // 查询签入记录，并按学号升序排列
    $sql1 = "SELECT avatar,id,name,gender,password,signDate,isSign FROM Students ORDER BY id ASC";
    $sql2 = "SELECT id, name,gender, signDate, isSign  FROM Students WHERE isSign  = 0 ORDER BY id ASC";
    $sql3 = "SELECT id, name,gender, signDate, isSign FROM Students WHERE isSign = 1 ORDER BY id ASC";

    ?>
</head>

<body>
    <table>
        <!-- 导出下拉框 -->
        <div class="export-container">
            <form action="../Tool/export_sign_in.php" class="select" method="POST">
                <label for="export_option"></label>
                <select name="export_option" id="export_option">
                    <option value="all">全部学生</option>
                    <option value="not_signed_in">未签到学生</option>
                    <option value="signed_in">已经签到学生</option>
                </select>
                <input type="submit" value="导出" class="outbutton">
            </form>
        </div>
        <?php
        $selected_option = isset($_POST['export_option']) ? $_POST['export_option'] : 'all';
        ?>
        <div class="re">
            <form action="../Tool/reSet.php" method="POST" style="display:inline;">
                <input type="hidden" name="reset_sign_in" value="1">
                <button type="submit" class="button" onclick="return confirm('您确定要重置所有签到状态吗？');">重置签到状态</button>
            </form>
        </div>
        <div class="back-button">
            <a href="teacherPage.php#my;" class="button">返回</a>
        </div>
        <caption>学生签到记录</caption>
        <thead>
            <tr>
                <th>avator</th>
                <th> Id </th>
                <th> name</th>
                <th> gender</th>
                <th> signDate</th>
                <th> isSign</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // 检查查询结果是否有记录
            
            $result = $conn->query($sql1);
            if ($result->num_rows > 0) {
                // 输出每行数据
                while ($row = $result->fetch_assoc()) {
                    $isSign = $row['isSign'] == 1 ? "是" : ""; // 签到状态
                    $sign_in_button = $row['isSign'] == 0 ? "<a href='../Tool/tea_Update_Sign_in.php?id=" . htmlspecialchars($row['id']) . "'>代签</a>" : ""; // 代签按钮
            
                    echo "</tr>";
                    echo "<td><img src='" . htmlspecialchars($row['avatar']) . "' alt='头像' style='width: 50px; height: 50px;'></td>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['signDate']) . "</td>";
                    echo "<td>" . $isSign . " " . $sign_in_button . "</td>"; // 合并显示签到状态和按钮
                    echo "</tr>";
                }
            } else {
                // 如果没有记录，显示帮助签到的操作
                echo "<tr><td colspan='4'>没有签到记录，<a href='help_sign_in.php'>添加学生</a></td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>