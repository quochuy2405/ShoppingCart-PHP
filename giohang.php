
        <?php       
         session_start();
        if(isset($_GET['type'])){
            if(isset( $_GET['TotalPrice']))
            {
            $TotalPrice = $_GET['TotalPrice'];
            echo $TotalPrice;
          if($_GET['type']=='saveCart'){
              $saveCart=["TotalPrice"=>$TotalPrice];
             $_SESSION["saveCart"]['Total']=$saveCart;

          }}
        }
        else{
        if(isset($_POST['id']))
        {
            $id=$_POST['id'];
            if(isset($_SESSION["cart"][$id]))
            { $num=$_POST['num'];
                $_SESSION["cart"][$id]['num']=$num;
            }
        }
        
        if (isset($_SESSION["cart"]) && is_array($_SESSION["cart"]))  
        echo '<table border="1">
            <tr>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền<nav></nav>
                </th>
            </tr>';
        foreach ($_SESSION["cart"] as $id => $value) {
          
            $total=$value['price']*1*$value['num'];
            $html = "
                    <tr id='{$id}'>
                    <td> <img class='proImg' src='{$value['url']}'><p class='proName'>{$value['name']}<p></td>
                    <td><span class='proName price'>{$value['price']}</span>đ</td>
                    <td><input type='number' class='proNum' value='{$value['num']}'/></td>
                    <td class='total'>{$total}</td>
                    </tr>
         
                      ";
            echo $html;
        }
        $html = "
            <tr>
            <td><a class='btn' href='LietKeSP.html'>Quay lại mua hàng</a></td>
            <td colspan='2'>Tổng tiền:<span id='totalPrice'></span>đ</td>
            <td><a class='btn btnThanhtoan' href='thanhtoan.html'>Thanh Toán</a></td>
            </tr>
              ";
        echo $html;
    }
        ?>
