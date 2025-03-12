<?php
    include("../../config/config.php");
    $title=$_POST['title'];
    $content=$_POST['content'];
    $image = $_FILES['image']['name'];
    $image_tmp= $_FILES['image']['tmp_name'];
    $image = time().'_'.$image;
    $date = date("Y-m-d H:i:s");
        if(isset($_POST['submit']))
        {
           
            $sql_blog="INSERT INTO tbl_baiviet(tieude,noidung,hinhanh,ngaydang) VALUES ('$title','$content','$image','$date')";
            if(mysqli_query($mysqli,$sql_blog)){
                move_uploaded_file($image_tmp, 'image_blog/'.$image);
                header('location:../../index.php?action=quanlybaiviet&&query=them');
            }
        }elseif(isset($_POST['edit'])){
            $id=$_GET['id'];
            if($image!='')
            {
                echo "okk";
                $sql="SELECT * FROM tbl_baiviet WHERE id_baiviet=$id LIMIT 1";
                $query_sql=mysqli_query($mysqli,$sql);
                while($row=mysqli_fetch_array($query_sql)){
                    unlink('image_blog/'.$row['hinhanh']);
                }
                $sql_xoa="UPDATE tbl_baiviet SET tieude='$title', noidung='$content', hinhanh='$image', ngaydang='$date' WHERE id_baiviet=$id";
                mysqli_query($mysqli,$sql_xoa);
                move_uploaded_file($image_tmp, 'image_blog/'.$image);
            }else{
                $sql_xoa="UPDATE tbl_baiviet SET tieude='$title', noidung='$content', ngaydang='$date' WHERE id_baiviet=$id";
                mysqli_query($mysqli,$sql_xoa);
            }
            header('location:../../index.php?action=quanlybaiviet&&query=them');
            
        }else{
            $id=$_GET['id'];
            $sql="SELECT * FROM tbl_baiviet WHERE id_baiviet=$id LIMIT 1";
            $query_sql=mysqli_query($mysqli,$sql);
            while($row=mysqli_fetch_array($query_sql)){
                unlink('image_blog/'.$row['hinhanh']);
            }
            $sql_xoa="DELETE FROM tbl_baiviet WHERE id_baiviet=$id";
            mysqli_query($mysqli,$sql_xoa);
            header('location:../../index.php?action=quanlybaiviet&&query=them');
        }
?>