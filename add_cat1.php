<?php
session_start();
require_once("../config/config_sqli.php");
$name = $_SESSION['name'];
$lastname = $_SESSION['lastname'];

if (!isset($_SESSION['admin'])) {

    $_SESSION['msg'] = "Please Login";
    header("location:../loginform.php");
}

if (isset($_GET['logout'])) {

    unset($_SESSION['admin']);
    session_destroy();
    echo "<script>
        $(document).ready(function () {
        Swal.fire ({
              icon: 'success',
              title: 'ออกจากระบบแล้ว',
              text: 'กำลังกลับไปยังหน้าล็อคอิน',
              timer: 3000,
              showConfirmButton: false,
        });
        });
  </script>";
    header("refresh:2; url=loginform.php");
    // header("location: loginform.php");

}

$select_food = $conn->query("SELECT * FROM food ORDER BY food_id ASC");
$select_room = $conn->query("SELECT * FROM room ORDER BY room_id ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'include/head.php'; ?>
</head>

<body>
    <div class="container my-5">
        <div class="card-body shadow">
            <div class=" h4 text-center alert alert-info mb-4 mt-4" role="alert">เพิ่มข้อมูลแมว</div>
            <form action="control/form.php" method="POST">
                <div class="row py-2">
                    <div class="col">
                        <label>ชื่อผู้ฝากแมว</label>
                        <input type="text" name="cat_depositoryname" class="form-control" placeholder="ป้อนชื่อแมว" maxlength="20" oninvalid="setCustomValidity('กรุณาป้อนชื่อแมว')" oninput="setCustomValidity('')" required>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col">
                        <label>ชื่อแมว</label>
                        <input type="text" name="cat_name" class="form-control" placeholder="ป้อนชื่อแมว" maxlength="20" oninvalid="setCustomValidity('กรุณาป้อนชื่อแมว')" oninput="setCustomValidity('')" required>
                    </div>
                    <div class="col">
                        <label for="">เพศ</label>
                        <select name="cat_sex" class="form-select" required>
                            <option value="" selected hidden>--- เลือกเพศ ---</option>
                            <option value="เพศผู้">เพศผู้</option>
                            <option value="เพศเมีย">เพศเมีย</option>
                        </select>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col">
                        <label>สายพันธุ์</label>
                        <input type="text" name="cat_species" class="form-control" placeholder="ป้อนชื่อสายพันธุ์แมว" maxlength="20" oninvalid="setCustomValidity('กรุณาป้อนชื่อแมว')" oninput="setCustomValidity('')" required>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col">
                        <label for="">ประเภทอาหาร</label>
                        <select name="food_id" id="food" class="form-select" required>
                            <option value="" selected hidden>--- เลือกประเภทอาหาร ---</option>
                            <?php while ($row_food = $select_food->fetch_array()) { ?>
                                <option value="<?= $row_food['food_id'] ?>"><?= $row_food['food_name'] ?> <?= $row_food['food_price'] ?>฿</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="">ห้องรับฝาก</label>
                        <select name="room_id" id="room" class="form-select" required>
                            <option value="" selected hidden>--- เลือกห้องรับฝาก ---</option>
                            <?php while ($row_room = $select_room->fetch_array()) { ?>
                                <option value="<?= $row_room['room_id']; ?>"><?= $row_room['room_name'] ?> <?= $row_room['room_price'] ?>฿</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col">
                        <label for="">วันที่รับฝาก</label>
                        <input type="date" name="cat_deposit_date" class="form-control" required>
                    </div>
                    <div class="col">
                        <label for="">วันที่รับคืน</label>
                        <input type="date" name="cat_return_date" class="form-control" required>
                    </div>
                </div>
                <div class="d-flex justify-content-end align-items-center">
                    <button type="button" onclick="window.location.href='deposit.php'" class="btn btn-danger" style="margin-right: 3px;">ย้อนกลับ</button>
                    <button type="submit" name="btn_addcat" class="btn btn-primary my-3" style="padding: 6px 50px;">ดำเนินการต่อ</button>
                </div>

            </form>
        </div>

    </div>

</body>

</html>