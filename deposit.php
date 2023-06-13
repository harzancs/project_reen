<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
// if(!isset($_SESSION['user'])){
//   header("location; ../loginform.php");
// }
session_start();
require_once("config/config_sqli.php");
$name = $_SESSION['name'];
$lastname = $_SESSION['lastname'];

if (!isset($_SESSION['admin'])) {

    $_SESSION['msg'] = "Please Login";
    header("location:loginform.php");
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
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เจ้าของร้าน</title>

    <!--Bootstap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--boxicon-->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!--flaticon-->
    <link href="https://registry.npmjs.org/@flaticon/flaticon-uicons/-/flaticon-uicons-1.7.0.tgz" rel="stylesheet">


    <!--css-->
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <?php
    date_default_timezone_set("Asia/Bangkok");
    if (isset($_SESSION['success'])) {
        echo $_SESSION['success'];
        unset($_SESSION['success']);
    } elseif (isset($_SESSION['error'])) {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
    ?>
    <div class="sidebar close">
        <div class="logo-details">
            <i class=''></i>
            <span class="logo_name">CAT HOTEL</span>
        </div>

        <ul class="nav-links">
            <li>
                <a href="homeowner.php">
                    <i class='bx bxs-home-smile'></i>
                    <span class="link_name">หน้าหลัก</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="homeowner.php">หน้าหลัก</a></li>
                </ul>
            </li>

            <li>
                <div class="iocn-link">
                    <a href="deposit.php">
                        <i class='bx bxs-basket'></i>
                        <span class="link_name">รับฝากเลี้งแมว</span>
                    </a>
                </div>
                <ul class="sub-menu">
                    <li><a href="deposit.php">รับฝากเลี้งแมว</a></li>
                </ul>
            </li>

            <li>
                <div class="iocn-link">
                    <a>
                        <i class='bx bxs-analyse'></i>
                        <span class="link_name">เรียกดูข้อมูล</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="customer/customer_information.php">ข้อมูลลูกค้า</a></li>
                    <li><a href="customer/cat_information.php">ข้อมูลแมว</a></li>

                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a>
                        <i class='bx bxs-analyse'></i>
                        <span class="link_name">จัดการข้อมูล</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">

                    <li><a href="room/show_room.php">ข้อมูลห้องพัก</a></li>
                    <li><a href="food/show_food.php">ข้อมูลอาหาร</a></li>
                </ul>
            </li>

            <li>
                <div class="iocn-link">
                    <a href="return.php">
                        <i class='bx bxs-store-alt'></i>
                        <span class="link_name">รับแมวคืน</span>
                    </a>
                </div>
                <ul class="sub-menu">
                    <li><a href="return.php">รับแมวคืน</a></li>
                </ul>
            </li>

            <li>
                <div class="iocn-link">
                    <a href="finance.php">
                        <i class='bx bx-cut'></i>
                        <span class="link_name">การเงิน</span>
                    </a>
                </div>
                <ul class="sub-menu">
                    <li><a href="finance.php">การเงิน</a></li>
                </ul>
            </li>

            <li>
                <div class="iocn-link">
                    <a href="report.php">
                        <i class='bx bxs-basket'></i>
                        <span class="link_name">จัดทำรายงาน</span>
                    </a>
                </div>
                <ul class="sub-menu">
                    <li><a href="report.php">จัดทำรายงานค่าห้องพักและค่าอาหาร</a></li>
                </ul>
            </li>

            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <img src="image/14.jpg" alt="profileImg">
                    </div>
                    <div class="name-job">
                        <div class="profile_name">เจ้าของร้าน</div>
                        <div class="job">
                            <h6><?php echo $name . " " . $lastname; ?>
                        </div>
                    </div>
                    <a href="loginform.php?logout='1'"> <i class='bx bx-log-out' id="logout"></i> </a>

                </div>
            </li>
        </ul>
    </div>

    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
        </div>

        <div class="container">
            <br>
            <div class="container bg">

                <div class=" h4 text-center alert alert-danger mb-4 mt-4" role="alert"> รับฝากเลี้ยงแมว</div>
                <hr>



                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="get" align="center">
                    ค้นหาชื่อลูกค้า
                    <!-- <input type="text" name="search" placeholder="กรอกคำค้นหา"> -->

                    <select id='selUser' name="user" style='width: 40%'>
                        <option value=''>Select User</option>
                        <?php

                        $c = mysqli_connect("localhost", "root", "", "cat");
                        mysqli_query($c, "SET NAMES UTF8");

                        $sql = " SELECT * FROM customer GROUP BY name";
                        $q = mysqli_query($c, $sql);
                        while ($f = mysqli_fetch_assoc($q)) {
                        ?>
                            <option value='<?= $f['name'] ?>' <?= isset($_GET['user']) ? $_GET['user'] ==  $f['name'] ? "selected" : ""  : "" ?>><?= $f['name'] ?></option>

                        <?php
                        }

                        ?>
                    </select>
                    <input type="submit" value="ค้นหา">
                </form>

                <script>
                    $(document).ready(function() {
                        $("#selUser").select2();
                        $('#but_read').click(function() {
                            var username = $('#selUser option:selected').text();
                            var userid = $('#selUser').val();
                            $('#result').html("id : " + userid + ", name : " + username);

                        });
                        var limit = 3;
                        $('input.cat-checkbox').on('change', function(evt) {
                            if ($('input[type=checkbox]:checked').length > 3) {
                                $(this).prop('checked', false);
                            }
                        });
                    });
                </script>
                <br>
                <?php
                if (isset($_GET['user'])) {

                ?>
                    <hr>
                    <form action="binder.php" method="post" enctype="multipart/form-data">
                        <div class="container">
                            <a align='center'>

                            </a>

                            <!-- hidden -->
                            <input type="text" name="user" value="<?= $_GET['user'] ?>" hidden>
                            <!-- hidden -->

                            <table width="800" border="0" align="center" cellpadding="0" cellspacing="2">
                                <th>วันที่ฝาก : <input type="datetime-local" name="deposit_date" value="<?= date('Y-m-d H:i:s') ?>"  required></th>
                                <br>
                                <th>วันที่รับคืน : <input type="datetime-local" name="return_date" value="<?= date('Y-m-d H:i:s',strtotime('+1 day')) ?>" required></th>
                            </table>

                            <br>
                            <table width="800" border="0" align="center" cellpadding="0" cellspacing="2">

                                <td>ประเภทห้องพัก :</span></td>
                                <td>
                                    <label>
                                        <select name="room_type" id="room_type" oninput="selectDis();">
                                            <option>----- เลือกห้องพัก -----</option>
                                            <?php
                                            $sql2 = " SELECT * FROM room GROUP BY roomtype";
                                            $q2 = mysqli_query($c, $sql2);
                                            while ($f = mysqli_fetch_assoc($q2)) {
                                            ?>
                                                <option value='<?= $f['roomtype'] ?>' <?= $f['roomtype'] == "ห้องธรรมดา" ? "selected" : "" ?>><?= $f['roomtype'] ?></option>

                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </label>

                                    <script type='text/javascript'>
                                        function selectDis() {
                                            var optionValue = document.getElementById("room_type").value;
                                            if (optionValue == 'ห้องธรรมดา') {
                                                document.getElementById("room_number1").disabled = false;
                                                document.getElementById("room_number2").disabled = true;
                                                document.getElementById("room_1").style.display = 'block';
                                                document.getElementById("room_2").style.display = 'none';
                                            } else {
                                                document.getElementById("room_number2").disabled = false;
                                                document.getElementById("room_number1").disabled = true;
                                                document.getElementById("room_2").style.display = 'block';
                                                document.getElementById("room_1").style.display = 'none';
                                            }
                                        }
                                    </script>

                                <td>เลขที่ห้องพัก :</span></td>
                                <td>
                                    <label id="room_1">
                                        <select name="room_number" id="room_number1" required>
                                            <option>----- เลขที่ห้องพัก -----</option>
                                            <?php
                                            $sql3 = " SELECT * FROM room WHERE roomtype = 'ห้องธรรมดา' and r_delete = 1 and is_active = '1'";
                                            $q3 = mysqli_query($c, $sql3);
                                            while ($f = mysqli_fetch_assoc($q3)) {
                                            ?>
                                                <option value='<?= $f['id'] ?>'><?= $f['id_room'] ?> - ราคา <?= $f['roomprice'] ?> บาท</option>

                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </label>
                                    <label id="room_2" style="display:none;">
                                        <select name="room_number" id="room_number2" required disabled>
                                            <option>----- เลขที่ห้องพัก -----</option>
                                            <?php
                                            $sql3 = " SELECT * FROM room WHERE roomtype = 'ห้องพิเศษ' and r_delete = 1 and is_active = '1'";
                                            $q3 = mysqli_query($c, $sql3);
                                            while ($f = mysqli_fetch_assoc($q3)) {
                                            ?>
                                                <option value='<?= $f['id'] ?>'><?= $f['id_room'] ?> - ราคา <?= $f['roomprice'] ?> บาท</option>

                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </label>
                            </table>
                            <br>

                            <table style="width:100%" class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>ชื่อแมว</th>
                                        <th>เพศ</th>
                                        <th>สายพันธ์ุ</th>
                                        <th>ประเภทอาหาร</th>
                                        <th>สถานะ</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql1 = "SELECT a.*,b.food_type AS food FROM customer AS a
                                            INNER JOIN food AS b
                                            ON a.name = '" . $_GET['user'] . "'  
                                            AND a.c_status = 1
                                            AND a.cat_food = b.id";
                                    $q1 = mysqli_query($c, $sql1);
                                    while ($f = mysqli_fetch_assoc($q1)) {
                                    ?>
                                        <tr>
                                            <td><input type="checkbox" name="cat_id[]" value="<?= $f['cat_id'] ?>" <?= $f['deposit_status'] == 1 ? "disabled" : "" ?> class="cat-checkbox form-check-input"></td>
                                            <td><?= $f['cat_name'] ?></td>
                                            <td><?= $f['sex'] ?></td>
                                            <td><?= $f['species'] ?></td>
                                            <td><?= $f['food'] ?></td>
                                            <td style="color: <?= $f['deposit_status'] == 0 ? "green" : "red" ?>"><?= $f['deposit_status'] == 0 ? "ยังไม่ฝาก" : "รับฝากอยู่" ?></td>
                                        </tr>
                                    <?php
                                    }
                                    mysqli_close($c);
                                    ?>
                                </tbody>
                            </table>
                            <br>



                            <button type="submit" class="btn btn-primary">คำนวณค่าใช้จ่าย</button>
                            <a href="homeowner.php" class="btn btn-danger">ยกเลิก</a>



                        </div>
                    </form>

                <?php } ?>

                <script src="script.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
                </script>
</body>

</html>