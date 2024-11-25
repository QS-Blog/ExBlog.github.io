<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>左侧固定右侧自适应布局</title>
    <link rel="stylesheet" href="../Css/liuYan.css">
    <?php
    include '../../tool/conn.php';
    session_start(); // 启动 Session
    // 获取 session 中的值
    
    $name = isset($_SESSION['name']) ? $_SESSION['name'] : '未知'; // 获取用户名
    $id = isset($_SESSION['id']) ? $_SESSION['id'] : '未知'; // 获取用户id
    // 引入数据库连接
    // 查询签入记录，并按学号升序排列
    
    $sql = "SELECT * FROM messages ORDER BY id DESC";
    $result = $conn->query($sql);

    ?>

</head>

<body>
    <div class="header">
        <!-- 标题内容 -->
        <h1>留言内容</h1>
        <a href="<?php echo $_SESSION['type'] === 'teacher' ? '../../Teacher/Php/teacherPage.php' : '../../Student/Php/StudentPage#my.php'; ?>"
            class="button">
            返回
        </a>

    </div>

    <div class="main">
        <div class="left">
            <!-- 左侧内容 -->
            <!-- 左侧内容 -->
            <h1>留言板</h1>
            <div class="form">
                <form action="save_message.php" method="post">
                    <input type="text" id="username" name="username" placeholder="用户名" style="width: 100%;"
                        value="<?php echo htmlspecialchars($_SESSION['name']); ?>" readonly>

                    <textarea placeholder="留言内容" id="message" name="message"
                        style="width: 100%; height: 100px;"></textarea>
                    <input type="submit" id="submitBtn" style="width: 100%;" value="留言">
                </form>
            </div>

        </div>
        <div class="right">
            <!-- 右侧内容 -->


            <div id="messageBoard">
                <?php
                if ($result->num_rows > 0) {
                    // 输出每条留言
                    while ($row = $result->fetch_assoc()) {
                        $username = htmlspecialchars($row['username']);
                        $message = htmlspecialchars($row['message']);
                        $createdAt = date('Y/m/d H:i:s', strtotime($row['created_at']));
                        ?>
                        <div class="message" id="card">
                            <div class="message-info">
                                <div class="info">
                                    <strong><?php echo $username; ?></strong>
                                </div>
                                <span>发布于: <?php echo $createdAt; ?></span>
                            </div>
                            <div class="content">
                                <?php echo $message; ?>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "没有留言。";
                }
                ?>
            </div>

            <?php
            $conn->close();
            ?>

        </div>
    </div>
</body>
<script>
    // 给提交按钮添加点击事件监听器
    document.getElementById('submitBtn').addEventListener('click', function () {
        // 获取用户名和留言内容
        var username = document.getElementById('username').value;
        var message = document.getElementById('message').value;

        // 如果用户名为空，将用户名设置为匿名
        if (username === '') {
            username = '匿名';
        }
        // 获取留言板元素和当前时间
        var messageBoard = document.getElementById('messageBoard');
        var newMessage = document.createElement('div');
        newMessage.classList.add('message');
        // 设置留言元素的innerHTML，包含用户名、时间和留言内容
        newMessage.innerHTML = '<div class="message-info"><div class="info"><img src="1.jpg"><strong>'
            + username + '</strong></div><span>发布于：' + getCurrentTime() +
            '</span></div><div class="content">' + message + '</div>';
        // 在留言板的第一个子元素之前插入新的留言
        messageBoard.insertBefore(newMessage, messageBoard.firstChild);
    });
    // 获取当前时间的函数
    function getCurrentTime() {
        var now = new Date();
        var year = now.getFullYear();
        var month = ('0' + (now.getMonth() + 1)).slice(-2);
        var day = ('0' + now.getDate()).slice(-2);
        var hours = ('0' + now.getHours()).slice(-2);
        var minutes = ('0' + now.getMinutes()).slice(-2);
        var seconds = ('0' + now.getSeconds()).slice(-2);
        return year + '/' + month + '/' + day + ' ' + hours + ':' + minutes + ':' + seconds;
    }

</script>

</html>