<div class="main">
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
        include('productMNG/list.php');
    }elseif($tam == 'quanlysanpham' && $query == 'sua'){
        include('productMNG/edit.php');
    }elseif($tam == 'quanlydanhmucbaiviet' && $query == 'them'){
        include('productMNG/create.php');
        include('productMNG/list.php');
    }elseif($tam == 'quanlydanhmucbaiviet' && $query == 'sua'){
        include('productMNG/edit.php');
    }elseif($tam == 'quanlybaiviet' && $query == 'them'){
        include('productMNG/create.php');
        include('productMNG/list.php');
    }elseif($tam == 'quanlybaiviet' && $query == 'sua'){
        include('productMNG/edit.php');
    }elseif($tam == 'quanlydonhang' && $query == 'xemdanhsach'){
        include('category_invoice/invoice.php');
    }elseif($tam == 'quanlydonhang' && $query == 'xemchitiet'){
        include('category_invoice/invoice_detail.php');
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