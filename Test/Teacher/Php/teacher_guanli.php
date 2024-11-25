<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Css/teacher_guanli.css">
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

        </div>

        <div class="re">

        </div>
        <caption>学生管理系统</caption>
        <!-- 添加学生表单 -->
        <div class="form-container">
            <form action="../Tool/add_student.php" method="POST" onsubmit="return confirmAddStudent();">
                <input type="text" name="id" placeholder="学号" required>
                <input type="text" name="name" placeholder="姓名" required>
                <select name="gender" id="gender" required>
                    <option value="" disabled selected>请选择性别</option>
                    <option value="男">男</option>
                    <option value="女">女</option>
                </select>

                <input type="submit" value="添加学生">
            </form>
        </div>
        <div class="back-button">
            <a href="teacherPage.php#my;" class="button">返回</a>
        </div>
        <thead>
            <tr>
                <th>avator</th>
                <th> Id </th>
                <th> name</th>
                <th> gender</th>
                <th>操作</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // 检查查询结果是否有记录
            
            $result = $conn->query($sql1);
            if ($result->num_rows > 0) {
                // 输出每行数据
                while ($row = $result->fetch_assoc()) {
                    echo "</tr>";
                    echo "<td><img src='" . htmlspecialchars($row['avatar']) . "' alt='头像' style='width: 50px; height: 50px;'></td>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                    echo "<td>
                        <a href='../Tool/delete_student.php?id=" . htmlspecialchars($row['id']) . "' class='action-button' onclick='return confirm(\"您确定要删除该学生吗?\");'>删除</a>
                      </td>"; // 删除按钮
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