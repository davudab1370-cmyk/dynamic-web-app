<?php namespace classes;
require_once "includes/classes/Table.class.php";

use classes\Table;

class Category extends Table
{

    protected $data = array(
        "id" => 0 ,
        "category_name" => "" ,
        "parent_id" => 0
    );

    public static function getAllCategories(){
        $conn = self::connect();
        $query = "SELECT * FROM `categories` ORDER BY `id` ";
        $result = $conn->query($query);
        if($result->num_rows){
            $cats = array();
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            foreach ($rows as $row){
                $cats[]=new Category($row);
            }
            $return=$cats;
        }
        else $return=false;
        $conn = self::disconnect();
        return $return;
    }

     public static function getCategoryById($id){
        $conn = self::connect();
        $query = "SELECT * FROM `categories` WHERE `id`=$id";
        $result=$conn->query($query);
        if($result->num_rows){
            $row=$result->fetch_assoc();
            $return=new Category($row);
        }
        else $return=false;
        $conn=self::disconnect();
        return $return;
     }

     public static function getCategoriesByParentId($parent_id){
        $conn=self::connect();
        $query="SELECT * FROM `categories` WHERE `parent_id` = $parent_id";
        $result=$conn->query($query);
        if($result->num_rows){
            $cats = array();
            $rows=$result->fetch_all(MYSQLI_ASSOC);
            foreach ($rows as $row){
                $cats[] = new Category($row);
            }
            $return=$cats;
        }
        else $return=false;
        $conn=self::disconnect();
        return $return;
     }




}