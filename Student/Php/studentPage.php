<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>我的页面</title>
    <link rel="stylesheet" href="../../iconfont/font1/iconfont.css">
    <link rel="stylesheet" href="../../iconfont/font2/iconfont.css">
    <link rel="stylesheet" href="../Css/studentP.css">

    <?php
    session_start(); // 启动 Session
    // 获取 session 中的值
    $isSign = isset($_SESSION['isSign']) ? $_SESSION['isSign'] : 0; // 获取签到状态
    $signDate = isset($_SESSION['signDate']) ? $_SESSION['signDate'] : ''; // 获取签到日期
    $username = isset($_SESSION['name']) ? $_SESSION['name'] : '学生'; // 获取用户名
    $pageReset = isset($_SESSION['pageReset']) ? $_SESSION['pageReset'] : 0; // 获取当前签到状态
    $avatar = isset($_SESSION['avatar']) ? $_SESSION['avatar'] : ''; // 获取头像
    ?>
</head>

<body>
    <div class="shell">
        <ul class="nav">
            <li class="active" id="logo">
                <a href="#my">
                    <div class="icon">
                        <div class="imageBox">
                            <img src="<?php echo $avatar; ?>" alt="">
                        </div>
                    </div>
                    <div class="text">我的页面</div>
                </a>
            </li>
            <li>
                <a href="#home">
                    <div class="icon">
                        <i class="iconfont icon-shouye"></i>
                    </div>
                    <div class="text">主页</div>
                </a>
            </li>
            <li>
                <a href="#SignIn">
                    <div class="icon">
                        <i class="iconfont icon-qiandao"></i>
                    </div>
                    <div class="text">签到</div>
                </a>
            </li>
            <li>
                <a href="../../Public/Php/liuYan.php">
                    <div class="icon">
                        <i class="iconfont icon-liuyanban-05"></i>
                    </div>
                    <div class="text">留言板</div>
                </a>
            </li>
            <li>
                <a href="#picture">
                    <div class="icon">
                        <i class="iconfont icon-tupian"></i>
                    </div>
                    <div class="text">图片</div>
                </a>
            </li>
            <li>
                <a href="../../Public/Php/Setting.php">
                    <div class="icon">
                        <i class="iconfont icon-more-br"></i>
                    </div>
                    <div class="text">相关设置</div>
                </a>
            </li>
            <li>
                <a href="../../tool/logout.php">
                    <div class="icon">
                        <i class="iconfont icon-tuichu"></i>
                    </div>
                    <div class="text">退出</div>
                </a>

            </li>
        </ul>
    </div>
    <section id="my">我的信息</section>
    <section id="home">主页</section>
    <section id="SignIn">
        <div class="signIn">
            <p2>签到</p2>

            <?php if ($isSign == 1): ?>
                <span class="sign-status"><?php echo $signDate; ?></span> <!-- 如果已签到，显示签到时间 -->
            <?php else: ?>
                <span class="sign-status">未签到</span> <!-- 如果未签到，显示未签到 -->
            <?php endif; ?>


            <form id="signInForm" method="POST" action="../Tool/stu_Sign_in.php">
                <label class="switch">
                    <input type="checkbox" name="isSign" value="1" <?php echo ($isSign == 1) ? 'checked disabled' : ''; ?>
                        onchange="this.form.submit()">
                    <span class="slider"></span>
                </label>
            </form>

    </section>



    <section id="LiuYan">留言板</section>
    <section id="picture">图片</section>
    <section id="me">相关设置</section>
    <!-- 添加署名文字 -->
    <div class="footer">
        <p>版权所有 &copy; 202206024102 黄家鹏</p> <!-- 署名文字，可替换为个人信息 -->
    </div>
</body>
<script>

    let nav = document.querySelectorAll(".nav li");
    function activeLink() {
        nav.forEach((item) => item.classList.remove("active"));
        this.classList.add("active");
    }
    nav.forEach((item) => item.addEventListener("click", activeLink));


</script>

</html>