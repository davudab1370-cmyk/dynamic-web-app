<?php
if(isset($_POST["answerid"])){
    $commentArray['full_name']=$_POST["fullname"];
    $commentArray['email']=$_POST["email"];
    $commentArray['website']=$_POST["website"];
    $commentArray['comment']=$_POST["comment"];
    $commentArray['post_id']=$_GET["post"];
    $commentArray['parent_id']=$_POST["answerid"];
    \classes\Comments::insertComment($commentArray);
    showPost();
}
else showPost();


function showPost(){
    $post_id=$_GET["post"];
    $post=\classes\Post::getPostById($post_id);
    $content=str_replace("--more--","",$post->content);


?>

    <article>
        <header class="postheader">
            <h2><a href="./?post=<?= $post->id; ?>"><?= $post->title; ?></a></h2>
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
        <?php if(!isset ($_SESSION["user_name"])){

            $footer=' <span>
                            برای مشاهده لینک ها باید عضو شوید. برای ثبت نام
                            <a href="./?action=signup">اینجا</a> و برای ورود <a href="./?action=login">اینجا</a> کلیک کنید.
                        </span> ';
        }else{
            $footer='<p> دانلود کنید <a href="'.$post->link.'"><img src="./images/download.png."alt=""></a></p>';
        }

        ?>


        <div id="download">
           <?= $footer; ?>
        </div>
        <div class="postseperator"></div>
    </article>

    <div id="comments">
        <?php
           if($comments=\classes\Comments::getCommentsByPost_id($post_id)){
               foreach ($comments as $comment){
                   if($comment->parent_id===0){
                       $title=$comment->full_name . " گفته ";
                       $class="";
                   }
                   else{
                       $author=\classes\Comments::getCommentsById($comment->parent_id);
                       $title= $comment->full_name . " در پاسخ به " .$author->full_name . " گفته ";
                       $class="answer";
                       }

               $creation=convertDate($comment->comment_time);
               $time= " در ". $creation['day'] ." " . $creation["month_name"]. " " .$creation['year'];
               $time .= " ساعت " . $creation["hour"] . ":" . $creation["minute"];
               ?>

               <article class="<?= $class ?>">
                   <header>
                       <p><?= $title ?></p>
                       <time><?= $time ?></time>
                   </header>
                   <div class="commentbody">
                    <?=  $comment->comment ?>
                   </div>
                   <footer class="commentfooter">
                       <span onclick="changeAnswer(2,'شایان');">پاسخ دهید</span>
                   </footer>
               </article>

           <?php } } ?>


    </div>

<?php } ?>
