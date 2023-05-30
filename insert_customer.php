<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<?php
include 'config/config_sqli.php';

$cat_id = $_POST['รหัส'];
$cat_name = $_POST['ชื่อแมว'];
$sex = $_POST['เพศ'];
$species = $_POST['สายพันธ์'];
$cat_food = $_POST['ประเภทอาหาร'];

$sql="INSERT INTO user(id,cat_name,sex,species,cat_food) VALUES('$id','$cat_name','$sex','$species','$cat_food')";
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
    header("refresh:2; url=homeowner.php");
    // echo "<script>window.location=customer.php.';</script>";
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
    header("refresh:2; url=homeowner.php");
}

mysqli_close($conn);
?>