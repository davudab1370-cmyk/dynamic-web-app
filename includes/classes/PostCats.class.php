<?php namespace classes;
require_once "includes/classes/Table.class.php";

class PostCats extends Table
{
    protected $data=array(
        "id"=>0,
        "post_id"=>0,
        "cat_id"=>0
    );

    public static function getAllByPostId($post_id){

        $conn=self::connect();
        $query="SELECT * FROM `posts_cats` WHERE `post_id`=$post_id";
        $result=$conn->query($query);
        if ($result->num_rows){
            $cats=[];
            $rows=$result->fetch_all(MYSQLI_ASSOC);

            foreach ($rows as $row){
                $cats[]=new PostCats($row);
            }
            $return=$cats;

        }
        else $return=false;

        $conn=self::disconnect();
        return $return;


    }

    public static function getAllByCatId($cat_id, $childs=true ){

        $conn=self::connect();
        $query="SELECT * FROM `posts_cats` WHERE `cat_id` = $cat_id";

        if($childs){
            if($child_of_cats = Category::getCategoriesByParentId($cat_id)){
                $child_ids="(";
                foreach ($child_of_cats as $child){
                    $child_ids .= $child->id . ",";
                }
                $child_ids = substr($child_ids,0,strlen($child_ids) - 1) . ")";
                $query="SELECT * FROM `posts_cats` WHERE `cat_id`=$cat_id OR cat_id IN $child_ids";
                var_dump($query);
            }
        }

        $result=$conn->query($query);
        if ($result->num_rows){
            $rows=$result->fetch_all(MYSQLI_ASSOC);
            $cats=[];
            foreach ($rows as $row){
                $cats[]=new PostCats($row);

            }
            $return=$cats;

        }else $return =false;

        $conn=self::disconnect();
        return $return;
    }
}
