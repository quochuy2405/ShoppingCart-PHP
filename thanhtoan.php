<?php

session_start();
if (isset($_GET['type']) || isset($_POST['type'])) {

    if (isset($_GET['type']))
        $type = $_GET['type'];
    else
        $type = $_POST['type'];
    switch ($type) {

        case 'getCart': {
                getCart();
                break;
            }
        case 'thanhtoan': {
                SubmitThanhToan();
                break;
            }
    }
}


function getCart()
{
    if (isset($_SESSION["cart"]) && is_array($_SESSION["cart"]))
        echo '<table border="1">
        <tr>
            <th>Cart</th>
            <th>SL</th>
            <th>Num</th>
            </th>
        </tr>';
    foreach ($_SESSION["cart"] as $id => $value) {

        $total = $value['price'] * 1 * $value['num'];
        $html = "
                <tr id='{$id}'>
                <td><span class='name'>{$value['name']}</span></td>
                <td><span class='num'>{$value['num']} </span></td>
                <td class='total'>{$total} đ</td>
                </tr>
     
                  ";
        echo $html;
    }
    if (isset($_SESSION['saveCart']['Total'])) {
        $Total = $_SESSION['saveCart']['Total']['TotalPrice'];

        $html = "
            <tr>
                <td>Total</td>
                <td colspan='2'>{$Total}</td>

            </tr>";
        echo $html;
    }
}
function SubmitThanhToan()
{
    require "connect.php";
    if (
        isset($_POST['name']) && isset($_POST['address']) && isset($_POST['email'])
        && isset($_POST['quan']) && isset($_POST['xa']) && isset($_POST['tinh']) && isset($_POST['phone'])
    ) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $tinh = $_POST['tinh'];
        $quan = $_POST['quan'];
        $xa = $_POST['xa'];
        $date = new DateTime('NOW');
        $ngdh = date_format($date, 'Y-m-d');
        $thanhtoan = "1";
        $hoadonsql = "INSERT INTO `hoadon`( `NGHD`, `HOTENKH`, `SDT`, `EMAIL`, `DIACHI`, `TINH`, `QUAN`, `PHUONG`, `THANHTOAN`) VALUES (?,?,?,?,?,?,?,?,?)";
        $query1 = $connect->prepare($hoadonsql);
        $query1->bind_param("sssssssss", $ngdh, $name, $phone, $email, $address, $tinh, $quan, $xa, $thanhtoan);
        $ok = $query1->execute();

        if ($ok) {
            $sql = "SELECT `SOHD` FROM `hoadon` WHERE `SDT`='$phone'";
            $query = $connect->query($sql);
            if ($query) {
                if ($query->num_rows > 0) {
                    $row = $query->fetch_row();
                    echo $row[0];
                    foreach ($_SESSION["cart"] as $id => $value) {

                        $Total = $_SESSION['saveCart']['Total']['TotalPrice'];
                        $cthdsql = "INSERT INTO `cthd`(`SOHD`,`MASP`, `SL`, `DONGIA`) VALUES (?,?,?,?)";
                        $query = $connect->prepare($cthdsql);
                        $query->bind_param("ssss", $row[0], $id, $value['num'], $Total);
                        $ok = $query->execute();
                    }
                    echo "Thành công";
                }
            }
        } else
            echo "Không thành công";
    }
}
