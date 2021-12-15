<?php
require 'connect.php';
$username=$_POST['username'];
$password=$_POST['password'];
if($username && $password){
  $sql = "SELECT id, username FROM `login` WHERE `username`=$username AND `password`=$password";
  $result = $connect->query($sql);
  if ($result){

    echo "Chúc mừng bạn đã đăng nhập thành công !!!";
  }
  else{
    echo "Đăng nhập không thành công.Vui lòng nhập lại !!!";
  }
}
else{
    echo "Đăng nhập không thành công.Vui lòng nhập lại !!!";
}
