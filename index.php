<?php require_once "includes/includes.php" ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>مرکز دانلود کتابهای الکترونیکی</title>
    <link href="styles.css" rel="stylesheet" />
    <script src="javascript.js"></script>
</head>
<body>
<div id="wrapper">
<header id="top">
    <ul>
        <li><span><a href="./">ARDaei.com</a></span></li>
        <li><img src="images/logo.png" /></li>
        <li><span>مرکز دانلود کتابهای الکترونیکی</span></li>
    </ul>
</header>
<nav id="menu">
    <ul>
        <li><a href="./">صفحه‌ اصلی</a></li>
        <li><a href="./?action=signup">ثبت نام</a></li>

        <?php  if($pages=\classes\Post::getAllPosts(2)) : foreach ($pages as $page) :?>
            <li><a href="./?<?= $page->id ?>"><?= $page->title ?></a></li>
        <?php endforeach; endif;?>

    </ul>
</nav>
<div id="body">
<aside id="sidebar">
    <section id="login">
        <header>
            ورود
        </header>
        <div>
            <form method="post" action="./?action=login">
                <table>
                    <tr>
                        <td>
                            نام کاربری
                        </td>
                        <td>
                            <input type="text" name="user" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            کلمه عبور
                        </td>
                        <td>
                            <input type="password" name="pass" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            مرا به خاطر بسپار
                            <input type="checkbox" name="remember" value="yes" />
                            <input type="submit" value="ورود" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a href="./?action=signup" class="linkbutton">ثبت نام</a>
                            <a href="./?action=forget" class="linkbutton">فراموشی کلمه عبور</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </section>
    <section id="search">
        <header>
            جستجو
        </header>
        <div>
            <form>
                <input type="hidden" name="action" value="search" />
                <input type="search" name="q" placeholder="جستجو کنید" />
                <input type="submit" value="جستجو در" />
                <input type="checkbox" name="title" value="yes" checked="checked" /> عنوان
                <input type="checkbox" name="content" value="yes" checked="checked" /> توضیحات
            </form>
        </div>
    </section>
    <section id="categories">
        <header>
            گروه‌ها
        </header>
        <div>
            <ul>

                <?php
                   if ( $rootCats=\classes\Category::getCategoriesByParentId(0)){
                    foreach ($rootCats as $rootCat) :?>
                            <li><a href="./?cat=<?= $rootCat->id ?>"><?= $rootCat->category_name ?></a>
                                <ul>
                                    <?php if ($childCats=\classes\Category::getCategoriesByParentId($rootCat->id)){
                                    foreach ($childCats as $childCat) :?>
                                    <li><a href="./?cat=<?= $childCat->id ?>"><?= $childCat->category_name ?></a></li>
                                    <?php endforeach;} ?>
                                </ul>
                                     <?php endforeach; }?>
                            </li>
            </ul>
        </div>
    </section>
    <section id="lastposts">
        <header>
            آخرین مطالب
        </header>
        <div>
            <ul>

                <?php $lastPost=classes\Post::getAllPosts(1,true,MAX_LAST_POST);
                foreach ($lastPost as $post) : ?>
                    <li>
                        <a href="./?post=<?= $post->id; ?>"><?= $post->title; ?></a>
                    </li>
                <?php endforeach; ?>

            </ul>
        </div>
    </section>
</aside>
<section id="content">


    <?php
        if(isset($_GET["post"]) and is_numeric($_GET["post"]))
            include_once "includes/showPost.php";
        else include_once "includes/showAll.php";
    ?>




</section>
</div>
<footer id="bottom">
    <p>
        © تمامی حقوق برای ARDaei.com محفوظ می باشد.
    </p>
</footer>
</div>
</body>
</html>