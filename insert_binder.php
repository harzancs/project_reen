<?php
$c = mysqli_connect("localhost", "root", "", "cat");
mysqli_query($c, "SET NAMES UTF8");
//----------------
if (isset($_POST['user_name'])) {
    // print_r($_POST);
    $user_name = $_POST['user_name'];
    $user_id = $_POST['user_id'];
    $deposit_date = $_POST['deposit_date'];
    $return_date = $_POST['return_date'];
    $room_number = $_POST['room_number'];
    $room_type = $_POST['room_type'];
    $cat_id = $_POST['cat_id'];
    $deposit_price = $_POST['deposit_price'];
    $total_price = $_POST['total_price'];
    //-----
    $sql = "INSERT INTO deposit (user_id,deposit_date,return_date,room_number,cat_id,deposit_price,total_price)
            VALUES ('{$user_id}', '{$deposit_date}', '{$return_date}',{$room_number},'{$cat_id}',{$deposit_price},{$total_price})";


    $insert = mysqli_query($c, $sql);
    if ($insert) {
        $sql = "UPDATE room SET is_active = '0' WHERE id = {$room_number}";
        $insert = mysqli_query($c, $sql);
        //=============
        $cat = json_decode($cat_id);
        for ($i = 0; $i < count($cat); $i++) {
            $sql = "UPDATE customer SET deposit_status = '1' WHERE cat_id = {$cat["$i"]}";
            $insert = mysqli_query($c, $sql);
            //    echo  $sql;
        }
        echo '<script>alert("บันทึกข้อมูลเรียบร้อยแล้ว");';
        echo 'window.location.href="homeowner.php";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
