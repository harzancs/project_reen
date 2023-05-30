

<?php

include '../config/config_sqli.php';

if (isset($_POST['submit'])) {
    $id_room = $_POST['id_room'];
    $roomtype = $_POST['roomtype'];
    $roomprice = $_POST['roomprice'];



$sql="INSERT INTO room(roomtype,roomprice,id_room) VALUES('$roomtype','$roomprice','$id_room')";
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
    header("refresh:2; url=show_room.php");
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
    header("refresh:2; url=show_room.php");
}
}

mysqli_close($conn);
?>