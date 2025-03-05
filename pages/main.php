
<main>
    <?php
    if(isset($_GET['quanly']))
    {
        $tam = $_GET['quanly'];
    }else{
        $tam = '';
    }

    if($tam == 'sanpham')
    {
        include('main/product.php');
    }elseif($tam == 'chitietsanpham')
    {
        include('main/detail_product.php');
    }elseif($tam == 'lienhe')
    {
    }elseif($tam == 'giohang')
    {
        include('main/cart.php');
    }else{
        include('main/main.php');
    }
    ?>
</main>

