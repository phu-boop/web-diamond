<div class="main" id="content">
    <?php
    if(isset($_GET['action'])&&$_GET['query']){
        $tam = $_GET['action'];
        $query = $_GET['query'];
    }else{
        $tam = '';
        $query = '';
    }
    
    if($tam == 'quanlydanhmucsanpham' && $query == 'them'){
        include('category_productMNG/create.php');
        include('category_productMNG/list.php');
    }elseif($tam == 'quanlydanhmucsanpham' && $query == 'sua'){
        include('category_productMNG/edit.php');
    }elseif($tam == 'quanlysanpham' && $query == 'them'){
        include('productMNG/create.php');
    }elseif($tam == 'quanlysanpham' && $query == 'xem'){
        include('productMNG/list.php');
    }elseif($tam == 'quanlysanpham' && $query == 'sua'){
        include('productMNG/edit.php');
    }elseif($tam == 'quanlybaiviet' && $query == 'xem'){
        include('blog/list.php');
    }elseif($tam == 'quanlybaiviet' && $query == 'them'){
        include('blog/create.php');
    }elseif($tam == 'quanlybaiviet' && $query == 'sua'){
        include('blog/edit.php');
    }elseif($tam == 'quanlykhuyenmai' && $query == 'them'){
        include('promotionMNG/create.php');
        include('promotionMNG/list.php');
    }elseif($tam == 'quanlykhuyenmai' && $query == 'sua'){
        include('promotionMNG/edit.php');
    }elseif($tam == 'quanlydonhang' && $query == 'xemdanhsach'){
        include('category_invoice/invoice.php');
    }elseif($tam == 'quanlydonhang' && $query == 'xemchitiet'){
        include('category_invoice/invoice_detail.php');
    }elseif($tam == 'quanlythongke' && $query == 'xem'){
        include('dashboard.php');
    }elseif($tam == 'quanlykhachhang' && $query == 'xem'){
        include('register_MNG/list.php');
    }elseif($tam=='quanlykhachhang' && $query == 'them'){
        include('register_MNG/create.php');
    }elseif($tam == 'quanlykhachhang' && $query == 'sua'){
        include('register_MNG/edit.php');
    }
    else{
        include('dashboard.php');
    }
    ?>
</div>

<?php
if(isset($_GET['action'])=='logout'&&isset($_GET['logout'])==1){
    unset($_SESSION['username']);
    header('location:login.php');
}
?>