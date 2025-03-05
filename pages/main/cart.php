<?php
$id= $_GET['id'];
seeson_start();
$san_pham = 'SELECT * FROM tbl_sanpham WHERE id_sanpham = $id;';
query = mysqli_query($mysqli, $san_pham);

if(shopping_cart =='')



?>