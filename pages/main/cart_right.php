<?php


if(isset($_GET['buoc'])){
    $tam = $_GET['buoc'];
}else{
    $tam = '';
}
if($tam == 'thanhtoan')
{
    include('pages/main/menu_cart/payment_methods.php');
}elseif($tam == 'vanchuyen')
{
    include('pages/main/menu_cart/transport.php');
}else{
    include('pages/main/menu_cart/promotion.php');
}

?>
