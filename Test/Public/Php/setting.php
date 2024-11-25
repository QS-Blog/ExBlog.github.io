<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>用户设置</title>
    <link rel="stylesheet" href="../Css/Setting.css">
    <link rel="stylesheet" href="../Css/Buttons.css"> <!-- 如果有单独的按钮样式 -->
    <?php
    session_start();
    include '../../tool/conn.php';
    // 获取用户信息
    $userId = $_SESSION['id']; // 假设用户ID存储在Session中
    $result = $conn->query("SELECT name, gender FROM students WHERE id = $userId");
    $user = $result->fetch_assoc();
    $type = $_SESSION['type']; // 假设用户类型存储在Session中
    ?>
    <style>
        .back-button {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 15px;
            background-color: #5cb85c;
            /* 按钮颜色 */
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-button:hover {
            background-color: #4cae4c;
            /* 悬停效果 */
        }
    </style>
</head>

<body>
    <div class="container">
        <a href=<?php echo ($type == 'teacher') ? "../../Teacher/Php/teacherPage.php" : "../../Student/Php/studentPage.php"; ?> class="back-button">返回</a> <!-- 请将 previous_page.php 替换为实际返回的页面 -->
        <h1>用户信息设置</h1>
        <img src="<?php echo htmlspecialchars($_SESSION['avatar']); ?>" alt="用户头像" width="50px" height="50px">
        <form action="Usetting.php" method="post" enctype="multipart/form-data">
            <label for="name">姓名:</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user['name']); ?>">

            <label for="gender">性别:</label>
            <select name="gender" id="gender">
                <option value="男" <?php if ($user['gender'] == '男')
                    echo 'selected'; ?>>男</option>
                <option value="女" <?php if ($user['gender'] == '女')
                    echo 'selected'; ?>>女</option>
            </select>

            <label for="password">密码:</label>
            <input type="password" name="password" id="password" placeholder="留空则不修改">

            <label for="avatar">上传新的头像:</label>
            <input type="file" name="avatar" id="avatar" accept="image/*">

            <button type="submit">保存修改</button>
        </form>
    </div>

</body>

</html>