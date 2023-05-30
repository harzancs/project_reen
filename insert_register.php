<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



้
<?php

include 'config/config_sqli.php';

$username = $_POST['username'];
$password = $_POST['password'];
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$id_card = $_POST['id_card'];
$address = $_POST['address'];
$phone = $_POST['phone'];

$sql="INSERT INTO user(username,password,name,lastname,id_card,address,phone) VALUES('$username','$password','$name','$lastname','$id_card','$address','$phone')";
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
    header("refresh:2; url=index.php");
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
    header("refresh:2; url=index.php");
}

mysqli_close($conn);
?>