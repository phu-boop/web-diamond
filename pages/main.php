<main>
    <?php
    //Đăng xuất
    if(isset($_GET['dangxuat'])&&$_GET['dangxuat']==1){
        unset($_SESSION['dangky']);
        unset($_SESSION['id_khachhang']);
        echo "<script>window.location.href='index.php?quanly=dangnhap';</script>";
    }
    //MENU-narbar
    if(isset($_GET['quanly'])){
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
    }elseif($tam=='tintuc')
    {
        include('pages/main/news.php');
    }elseif($tam=='timkiem')
    {
        include('pages/main/search.php');
    }elseif($tam == 'sanpham')
    {
        include('pages/main/product.php');
    }elseif($tam=='xemgiavang')
    {
        include('pages/main/goldprice.php');
    }elseif($tam == 'chitietsanpham')
    {
        include('pages/main/detail_product.php');
    }elseif($tam == 'dangky')
    {
        include('pages/main/register.php');
    }elseif($tam == 'doimatkhau')
    {
        include('pages/main/changePassword.php');
    }elseif($tam == 'hoangthanh')
    {
        include('pages/main/complete.php');
    }else{
        include('pages/main/main.php');
    }
    ?>
</main>

