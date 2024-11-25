<!DOCTYPE html> <!-- 声明文档类型 -->
<html lang="en"> <!-- 定义文档语言为英语 -->

<head>
    <meta charset="UTF-8"> <!-- 设置文档字符编码为UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- 设置视口以适应不同设备 -->
    <title>学生登录</title> <!-- 网页的标题 -->
    <link rel="stylesheet" href="..\Css\stu_Login.css"> <!-- 引入CSS文件以应用样式 -->
    <?php session_start(); // 开启session
    $_SESSION['type'] = "student"; ?> <!-- 设置session -->
</head>


<body>
    <!-- 主要内容容器 -->
    <div class="shell">
        <div class="container a-container" id="a-container">
            <form action="../../tool/register.php" method="POST" class="form" id="a-form"
                onsubmit="return validatePasswords()">
                <h2 class="form_title title">创建账号</h2>
                <input type="text" name="counter" class="form_input" placeholder="Counter" required>
                <input type="text" name="name" class="form_input" placeholder="name" required>

                <input type="password" name="firstPassword" class="form_input" placeholder="FirstPassword" required>
                <input type="password" name="surePassword" class="form_input" placeholder="SurePassword" required>
                <button type="submit" class="form_button_Active"><span>SIGN UP</span></button>
            </form>
        </div>


        <div class="container b-container" id="b-container">
            <form action="..\tool\stu_Login_in.php" method="post" class="form" id="b-form">
                <h2 class="form_title title">登入账号</h2>
                <input type="text" class="form_input" placeholder="学号" id="studentId" name="studentId" required />
                <input type="password" class="form_input" placeholder="密码" id="password" name="password" required />
                <div class="box">
                    <a class="form_link">忘记密码？</a>
                </div>
                <button type="submit" class="form_button_Active"><span>SIGN IN</span></button>
            </form>
        </div>


        <div class="switch" id="switch-cnt">
            <div class="switch_circle"></div>
            <div class="switch_circle switch_circle-t"></div>
            <div class="switch_container" id="switch-c1">
                <h2 class="switch_title title" style="letter-spacing: 0;">Welcome Back！</h2>
                <p class="switch_description description">欢迎来到计本1班！！！</p>
                <button class="switch_button button switch-btn">SIGN IN</button>
            </div>

            <div class="switch_container is-hidden" id="switch-c2">
                <h2 class="switch_title title" style="letter-spacing: 0;">Hello Friend！</h2>
                <p class="switch_description description">欢迎加入计本1班！！！</p>
                <button class="switch_button button switch-btn">SIGN UP</button>
            </div>
        </div>
    </div>
    <!-- 署名文字容器 -->
    <div class="footer">
        <p>版权所有 &copy; 202206024102 黄家鹏</p> <!-- 版权声明 -->
    </div>
</body>

</html>
<script>
    let switchCtn = document.querySelector("#switch-cnt");
    let switchC1 = document.querySelector("#switch-c1");
    let switchC2 = document.querySelector("#switch-c2");
    let switchCircle = document.querySelectorAll(".switch_circle");
    let switchBtn = document.querySelectorAll(".switch-btn");
    let aContainer = document.querySelector("#a-container");
    let bContainer = document.querySelector("#b-container");
    let allButtons = document.querySelectorAll(".submit");

    let getButtons = (e) => e.preventDefault()
    let changeForm = (e) => {
        // 修改类名
        switchCtn.classList.add("is-gx");
        setTimeout(function () {
            switchCtn.classList.remove("is-gx");
        }, 1500)
        switchCtn.classList.toggle("is-txr");
        switchCircle[0].classList.toggle("is-txr");
        switchCircle[1].classList.toggle("is-txr");

        switchC1.classList.toggle("is-hidden");
        switchC2.classList.toggle("is-hidden");
        aContainer.classList.toggle("is-txl");
        bContainer.classList.toggle("is-txl");
        bContainer.classList.toggle("is-z");
    }
    // 点击切换
    let shell = (e) => {
        for (var i = 0; i < allButtons.length; i++)
            allButtons[i].addEventListener("click", getButtons);
        for (var i = 0; i < switchBtn.length; i++)
            switchBtn[i].addEventListener("click", changeForm)
    }
    window.addEventListener("load", shell);

</script>