
<main>
    <?php
    if(isset($_GET['quanly']))
    {
        $tam = $_GET['quanly'];
    }else{
        $tam = '';
    }

    if($tam == 'giohang')
    {
        include('pages/main/cart.php');
    }elseif($tam == 'sanpham')
    {
        include('pages/main/product.php');
    }elseif($tam == 'chitietsanpham')
    {
        include('pages/main/detail_product.php');
    }elseif($tam == 'Dangky')
    {
        include('pages/main/dangky.php');
    }else{
        include('pages/main/main.php');
    }
    ?>
</main>

