<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>我的页面</title>
    <link rel="stylesheet" href="../../iconfont/font1/iconfont.css">
    <link rel="stylesheet" href="../../iconfont/font2/iconfont.css">
    <link rel="stylesheet" href="../Css/teacherP.css">
    <?php
    session_start();
    $avatar = $_SESSION['avatar'];
    ?>

</head>

<body>
    <div class="shell">
        <ul class="nav">
            <li class="active" id="logo">
                <a href="#my">
                    <div class="icon">
                        <div class="imageBox">
                            <img src=<?php echo $avatar; ?>> alt="">
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
                <a href="teacher_Sign_In.php">
                    <div class="icon">
                        <i class="iconfont icon-chaxun"></i>
                    </div>
                    <div class="text">查询</div>
                </a>
            </li>
            <li>
                <a href="teacher_guanli.php">
                    <div class="icon">
                        <i class="iconfont icon-guanliyuan_jiaoseguanli"></i>
                    </div>
                    <div class="text">管理</div>
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
    <section id="chaxun">

    </section>
    <section id="guanli"></section>
    <section id="LiuYan"></section>
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

    function confirmAddStudent() {
        return confirm("您确定要添加这个学生吗？");
    }

</script>

</html>