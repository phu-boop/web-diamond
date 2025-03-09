
<main>
    <?php
    if(isset($_GET['dangxuat'])&&$_GET['dangxuat']==1)
    {
        unset($_SESSION['dangky']);
    }
    if(isset($_GET['quanly']))
    {
        $tam = $_GET['quanly'];
    }else{
        $tam = '';
    }

    if($tam == 'giohang')
    {
        include('pages/main/cart.php');
    }elseif($tam == 'dangnhap')
    {
        include('pages/main/login.php');
    }elseif($tam=='timkiem')
    {
        include('pages/main/search.php');
    }elseif($tam == 'sanpham')
    {
        include('pages/main/product.php');
    }elseif($tam == 'chitietsanpham')
    {
        include('pages/main/detail_product.php');
    }elseif($tam == 'Dangky')
    {
        include('pages/main/dangky.php');
    }elseif($tam == 'doimatkhau')
    {
        include('pages/main/changePassword.php');
    }
    
    else{
        include('pages/main/main.php');
    }
    ?>
</main>

