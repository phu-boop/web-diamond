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
        include('pages/main/product.php');
    }elseif($tam == 'tintuc')
    {
        include('pages/main/news.php');
    }elseif($tam == 'lienhe')
    {
        include('pages/main/contact.php');
    }elseif($tam == 'giohang')
    {
        include('pages/main/card.php');
    }else{
        include('pages/main/main.php');
    }
    ?>
</main>