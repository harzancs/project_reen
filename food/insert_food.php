<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<?php

include '../config/config_sqli.php';

if (isset($_POST['submit'])) {
    $food_type = $_POST['food_type'];
    $price = $_POST['price'];



$sql="INSERT INTO food(food_type,price) VALUES('$food_type','$price')";
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
    header("refresh:2; url=show_food.php");
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
    header("refresh:2; url=show_food.php");
}
}

mysqli_close($conn);
?>