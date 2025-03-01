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
        include('productMNG/create.php');
        include('productMNG/list.php');
    }elseif($tam == 'quanlydanhmucsanpham' && $query == 'sua'){
        include('productMNG/edit.php');
    }else{
        include('dashboard.php');
    }
    ?>
</div>