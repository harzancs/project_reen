<?php
$c = mysqli_connect("localhost", "root", "", "cat");
mysqli_query($c, "SET NAMES UTF8");
//----------------
if (isset($_POST['bill'])) {
    // print_r($_POST);
    $bill = $_POST['bill'];
    $user_id = $_POST['user_id'];
    $cat_id = $_POST['cat_id'];
    $deposit_date = $_POST['deposit_date'];
    $return_date = $_POST['return_date'];
    $return_date_actual = $_POST['return_date_actual'];
    $remaining_expenses = $_POST['remaining_expenses'];
    $room_total_price = $_POST['room_total_price'];
    //-----
    $food_type = $_POST['cat_food'];
    $food_meal = $_POST['count_meal'];
    $food_total_price = $_POST['food_total_price'];
    //-----
    $sql2 = " SELECT room_number FROM deposit WHERE  id = {$bill}";
    $q2 = mysqli_query($c, $sql2);
    while ($f = mysqli_fetch_assoc($q2)) {
        $room_number =  $f['room_number'];
    }
    //-----
    $sql = "UPDATE deposit
            SET remaining_expenses = {$remaining_expenses} ,return_date_actual = '{$return_date_actual}', status_retuen = '1' ,food_type = {$food_type}, food_meal = {$food_meal} ,food_total_price = {$food_total_price} ,room_total_price = {$room_total_price}
            WHERE id = {$bill}";


    $insert = mysqli_query($c, $sql);
    if ($insert) {
        $sql = "UPDATE room SET is_active = '1' WHERE id = {$room_number}";
        $insert = mysqli_query($c, $sql);
        //=====
        $cat = json_decode($cat_id);
        for ($i = 0; $i < count($cat); $i++) {
            $sql = "UPDATE customer SET deposit_status = '0' WHERE cat_id = {$cat["$i"]}";
            $insert = mysqli_query($c, $sql);
            //    echo  $sql;
        }
        echo '<script>alert("บันทึกข้อมูลเรียบร้อยแล้ว");';
        echo 'window.location.href="homeowner.php";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
