

้
<?php

include '../config/config_sqli.php';
session_start();
    $name= $_SESSION['name'];
    $lastname= $_SESSION['lastname'];

    $cat_name = $_POST['cat_name'];
    $sex = $_POST['sex'];
    $species = $_POST['species'];
    $cat_food = $_POST['cat_food'];


$sql="INSERT INTO customer(cat_name,sex,species,cat_food,name) VALUES('$cat_name','$sex','$species','$cat_food','$name')";
$result=mysqli_query($conn,$sql);
if($result){
    echo "<script>
    $(document).ready(function () {
        Swal.fire ({
            icon: 'success',
            title: 'เพิ่มข้อมูล',
            text: 'เพิ่มข้อมูลเรียบร้อย',
            timer: 2000,
            showConfirmButton: true
        });
    });
    </script>";
    header("refresh:2; url=show_cat.php");
    // echo "<script>window.location='user.php.';</script>";
}else{
    echo "<script>
    $(document).ready(function () {
        Swal.fire ({
            icon: 'error',
            title: 'ไม่สามารถเพิ่มข้อมูล',
            text: 'ไม่สำเร็จ',
            timer: 2000,
            showConfirmButton: true
        });
    });
    </script>";
    header("refresh:2; url=show_cat.php");
}

mysqli_close($conn);
?>