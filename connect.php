<?php
 $connect=mysqli_connect('localhost','root','','qlsp');
 if($connect->connect_error){
     die("Connection failed");
 }
?>