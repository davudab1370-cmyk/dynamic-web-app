<?php namespace classes;
 require_once "includes/classes/Table.class.php";

class Post extends Table
{

    protected $data=array(

        "id"=>0,
        "title"=>"",
        "content"=>"",
        "post_type"=>0,
        "user_id"=>0,
        "user_name"=>"",
        "first_name"=>"",
        "last_name"=>"",
        "published"=>0,
        "allow_comments"=>0,
        "link"=>"",
        "creation_time"=>0,
        "last_modify"=>0,
        "categories"=>array()
    );

    public static function getAllPosts($post_type=1, $published = true, $limit = 0, $start = 0){

        $conn=self::connect();

        $condition= $published ? " AND `published` =1 " : "";
        $limiter = $limit > 0 ? " LIMIT $start , $limit " : "
        ";
        $query = "SELECT `posts`.* , `user_name`,`first_name`,`last_name` FROM `posts`,`users` WHERE posts.user_id=users.id AND  `post_type`=$post_type $condition ORDER BY `creation_time` DESC $limiter ";
        $result = $conn->query($query);
        if ($result->num_rows){
            $posts=array();
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            foreach($rows as $row){
                if ($cats = PostCats::getAllByPostId($row["id"])){
                    foreach ($cats as $cat){
                        $row["categories"][] = $cat->cat_id;
                    }
                }
                $posts[] = new Post($row);
            }
            $return = $posts;
        }else $return = false;
        self::disconnect($conn);
        return $return;

    }


    public static function getPostById($id){

        $conn = self::connect();
        $query = ("SELECT `posts`.* , `first_name`, `last_name`, `user_name` FROM `posts` , `users` WHERE posts.user_id = users.id AND posts.id = $id");
        $result = $conn->query($query);
        if($result->num_rows){
            $row = $result->fetch_assoc();
            $cats = PostCats::getAllByPostId($row["id"]);
            foreach ($cats as $cat){
                $row["categories"][]= $cat->cat_id;

            }
            $return=new Post($row);

        }
        else $return=false;
        self::disconnect($conn);
        return $return;



    }



}