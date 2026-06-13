<?php
if(isset($_GET["section"]) and is_numeric($_GET["section"])) $section=$_GET["section"];
else $section=1;
$start=($section -1) * MAX_POST;
if($posts=\classes\Post::getAllPosts(1 ,true ,MAX_POST , $start)):?>
     <?php foreach ($posts as $post) :

        if($pos=strpos($post->content,"--more--")) $content= substr($post->content,0,$pos);
        else $content = $post->content;

        if($comments=\classes\Comments::getCommentsByPost_id($post->id)) $commentCount=count($comments);
        else $commentCount=0;
        ?>

           <article>
            <header class="postheader">
                <h2><a href="./?post=<?= $post->id ?>"><?= $post->title ?></a></h2>
                <p>
                        <?php
                        $creation= convertDate($post->creation_time);
                        echo " نوشته شده در " . $creation["day"] ." " . $creation["month_name"] . " " . $creation["year"]  ;
                        echo " در ساعت " . $creation["hour"] . ":" . $creation["minute"] . " توسط " . $post->first_name . " " .$post->last_name;
                        echo " در گروه : "; ?>
                        <?php
                             foreach ($post->categories as $cat_id) :

                                $temp=rand(0,360);
                                $color="hsl(".$temp.",90%,30%)";
                                $cat_name=\classes\Category::getCategoryById($cat_id)->category_name;

                        ?>

                                 <a style="background: <?= $color ?> " href="./?cat=<?= $cat_id; ?>"><?= $cat_name; ?></a>

                        <?php endforeach; ?>





                </p>
            </header>
            <div class="postbody">
                <?= $content; ?>
            </div>
            <footer id="postfooter">
                <div class="comcon">
                            <span class="commentsbutton">
                                <a href="./?post=<?= $post->id; ?>#comments"><?= $commentCount; ?> دیدگاه</a>
                            </span>
                    <span class="continuebutton">
                                <a href="./?post=13">ادامه مطلب</a>
                            </span>
                </div>
            </footer>
            <div class="postseperator"></div>
        </article>



     <?php endforeach;?>
     <?php $totalpost=count(\classes\Post::getAllPosts()); $countSection=ceil($totalpost/MAX_POST); ?>

           <div id="paging">
        <p> صفحه‌ی <?= $section; ?> از <?= $countSection; ?></p>
        <ul id="paging">

            <?php for ( $i = 1 ; $i <= $countSection ; $i++ ): $class = $i == $section ? "class = active" : '' ; ?>

            <li><a href="./?section=<?= $i; ?>" <?= $class; ?> ><?= $i; ?></a></li>

            <?php endfor; ?>
           <!-- <li><a href="./?section=2">2</a></li>
            <li><a href="./?section=3">3</a></li>-->
        </ul>
    </div>



<?php endif ?>















