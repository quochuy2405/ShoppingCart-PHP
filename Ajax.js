$(document).ready(function () {
  $('#btnlogin').on('click', function () {
    const username = $('#username').val();
    const password = $('#password').val();
    if (username && password) {
      const data = {
        username,
        password,
      };
      $.post('loginBT.php', data, function (data) {
        $('#notice').html(data);
      });
    }
  });
  $('#btnthemSP').on('click', function (e) {
    e.preventDefault();
    const masp = $('#masp').val();
    const tensp = $('#tensp').val();
    const nuocsx = $('#nuocsx').val();
    const donvi = $('#donvi').val();
    const gia = $('#gia').val();
    const loaisp = $('#loaisp').val();
    const hinhanh = $('#hinhanh').val();
    if (masp && tensp && nuocsx && donvi && gia && loaisp && hinhanh) {
      const data = {
        masp,
        tensp,
        nuocsx,
        donvi,
        gia,
        loaisp,
        hinhanh,
      };
      $.post('ThemSanPham.php', data, function (data) {
        alert(data);
      });
    }
  });
  $('#lietke').change(function () {
    const type = $(this).val();
    if (type) {
      $.get('LietKeSP.php?type=' + type, function (data) {
        $('#result_LietKe').html(data);
      });
    }
  });
  $('#result_LietKe').on('click', '.btnBuy', function () {
    const num = $(this).parent().children('input').val() * 1;
    const id = $(this).parent().parent().attr('data-id');
    const name = $(this).parent().parent().children('.name').text();
    const price = $(this).parent().parent().children('.price').text();
    const url = $(this).parent().parent().children('.img').children('.url').attr('src');
    console.log(url);
    if (num >= 1) {
      const data = {
        id,
        name,
        num,
        price,
        url
      };
      $.post('ThemGioHang.php',data ,function(data){

        $('#numCart').html(data);
      })
    }
  });
  $('#totalPrice').html(function(){
    let TotalPrice=0;
  $('.total').each(function(){
    TotalPrice += $(this).text()*1;
    })
    return 1000;
})
  

});
