<?php
require 'connect.php';
$masp=$_POST['masp'];
$tensp=$_POST['tensp'];
$nuocsx=$_POST['nuocsx'];
$donvi=$_POST['donvi'];
$gia=$_POST['gia'];
$loaisp=$_POST['loaisp'];
$hinhanh=$_POST['hinhanh'];

$sql="INSERT INTO sanpham(MASP, TENSP, DVT, NUOCSX, GIA, HINHANH, LOAISP) VALUES (?,?,?,?,?,?,?)";
$query = $connect->prepare($sql);
$query->bind_param("sssssss",$masp, $tensp, $donvi, $nuocsx, $gia, $hinhanh,$loaisp);
$ok=$query->execute();
if($ok)
    echo "Thành công";
else
    echo "Không thành công";
