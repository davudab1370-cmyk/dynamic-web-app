<?php namespace classes;
require_once "includes/classes/Table.class.php";

class Comments extends Table
{
    protected $data=array(

        "id"=>0,
        "full_name"=>"",
        "website"=>"",
        "email"=>"",
        "comment"=>"",
        "comment_time"=>0,
        "user_ip"=>0,
        "post_id"=>0,
        "parent_id"=>0,
    );

    public static function getAllComments(){

        $conn=self::connect();
        $query="SELECT * FROM `comments` ORDER BY `comment_time` DESC ";
        $result=$conn->query($query);
        $comment=array();
        if($result->num_rows){
            $rows=$result->fetch_all(MYSQLI_ASSOC);
            foreach ($rows as $row){
                $comment[]=new Comments($row);
            }
            $return=$comment;
        }
        else $return=false;
        self::disconnect($conn);
        return $return;

    }

    public static function getCommentsByPost_id($post_id){
        $conn=self::connect();
        $query="SELECT * FROM `comments`where `post_id` = $post_id ORDER BY `comment_time` DESC ";
        $result=$conn->query($query);

        if($result->num_rows){
            $comments=array();
            $rows=$result->fetch_all(MYSQLI_ASSOC);
            foreach ($rows as $row){
                $comments[]=new Comments($row);

            }
            $return=$comments;
        }
        else
            $return=false;
        self::disconnect($conn);
        return $return;
    }

    public static function getCommentsById($id){
        $conn=self::connect();
        $query="SELECT *  FROM `comments` WHERE `id` = $id ";
        $result = $conn->query($query);
        if($result->num_rows){
            $row = $result->fetch_assoc();
            $return = new Comments($row);
        }
        else $return = false;
        self::disconnect($conn);
        return $return;
    }

    public static function insertComment($commentArray){
        $return = true;
        $conn = self::connect();
        $full_name = $commentArray["full_name"];
        $email = $commentArray["email"];
        $website = $commentArray["website"];
        $comment=$commentArray["comment"];
        $post_id=$commentArray["post_id"];
        $parent_id=$commentArray["parent_id"];
        $user_ip=$_SERVER["REMOTE_ADDR"];
        $comment_time=time();
        $query = ("INSERT INTO `comments` (full_name,email,website,comment,comment_time,user_ip,post_id,parent_id) VALUE ('$full_name','$email','$website','$comment',$comment_time ,'$user_ip','$post_id',$parent_id)");
        if(!$conn->query($query)) $return = false;
        self::disconnect($conn);
        return $return;

    }

}