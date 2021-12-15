<?php
require "connect.php";

$type = $_GET['type'];
if ($type == 'all') {
  $sql = "SELECT `HINHANH`,`MASP`,`TENSP`,`DVT`,`GIA` FROM `sanpham`";
} else {
  $sql = "SELECT `HINHANH`,`MASP`,`TENSP`,`DVT`,`GIA` FROM `sanpham` WHERE `LOAISP`='$type'";
}
$query = $connect->query($sql);
if ($query) {
  if ($query->num_rows > 0) {
    $result = "";
    while ($row = $query->fetch_row()) {
      $result .= "<div class='item' data-id='{$row[1]}'>
        <div class='img' >
          <img class='url'
            src='{$row[0]}'
          />  
        </div>
          <p class='name' >{$row[2]}</p>
          <p>Đơn vị:<span class='donvi'>{$row[3]}</span></p>
          Giá: <span class='price'>{$row[4]}</span>
          <div class='inputSL'><span>Số lượng</span><input type='number' min='1'/><button class='btnBuy'>Chọn mua</button></div>
      </div>";
    }
    echo $result;
  }
}
