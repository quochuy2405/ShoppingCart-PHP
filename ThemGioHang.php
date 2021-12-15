<?php
session_start();
$id = $_POST['id'];
$name = $_POST['name'];
$num = $_POST['num'];
$price = $_POST['price'];
$url = $_POST['url'];

if (!isset($_SESSION["cart"])) $_SESSION["cart"]=[];
if ($id && $name && $num) {
   if (!isset($_SESSION["count"])) $_SESSION["count"]=0;
   $sp=["id"=>$id ,"name"=>$name,"num"=>$num,"price"=>$price,"url"=>$url];
   if(isset($_SESSION["cart"][$id]))
            $_SESSION["cart"][$id]['num']+=$num;
    else
    {
          $_SESSION["cart"][$id]=$sp;
          $_SESSION["count"]++;
    }
  echo $_SESSION["count"];
}
