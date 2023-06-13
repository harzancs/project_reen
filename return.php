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
    <title>รับแมวกลับ</title>

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


        <div class="container my-5">
            <div class=" h4 text-center alert alert-info mb-4 mt-4" role="alert">รับแมวกลับ</div>


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
                });
            </script>
            <br>
            <?php
            if (isset($_GET['user'])) {

            ?>


                <table style="width:100%">
                    <tr>

                        <th>ชื่อเจ้าของ</th>


                    </tr>
                    <?php
                    $sql1 = " SELECT * FROM user WHERE name = '" . $_GET['user'] . "' ";
                    $q1 = mysqli_query($c, $sql1);
                    while ($f = mysqli_fetch_assoc($q1)) {
                        $user_id = $f['id'];
                    ?>
                        <tr>

                            <td><input type="text" name="name" value="<?= $f['name'] ?>" class="form-control" readonly></td>

                        </tr>
                    <?php
                    }


                    ?>
                </table>
                <br>
                <!-- <table width="800" border="0" align="center" cellpadding="0" cellspacing="2">
                    <th>วันที่รับคืนจริง : <input type="datetime-local" name="deposit_date" required></th>

                </table>

                </table>
                <br>
                <tr>
                    <td class="style1">วันที่ฝาก</td>
                    <td colspan="3"><input type="text" size="50" /></td>

                </tr>

                <tr>
                    <td class="style1">วันที่จะรับคืน</td>
                    <td colspan="3"><input type="text" size="50" /></td>

                </tr>
                <br>
                <br>
                <tr>
                    <td class="style1">ประเภทห้องพัก</td>
                    <td colspan="3"><input type="text" size="50" /></td>

                </tr>
                <tr>
                    <td class="style1">ประเภทอาหาร</td>
                    <td colspan="3"><input type="text" size="50" /></td>

                </tr>
                <br>
                <br> -->

                <table style="width:100%" class="table table-striped table-hover table-bordered dataTable no-footer">
                    <thead>
                        <tr>
                            <th style="text-align: center;">เลขที่ฝาก</th>
                            <th style="text-align: center;">วันที่ฝาก</th>
                            <th style="text-align: center;">วันที่รับคืน</th>
                            <th style="text-align: center;">จำนวนแมว</th>
                            <th style="text-align: center;">ห้อง</th>
                            <th style="text-align: center;">มัดจำ/จ่ายเพิ่ม(บาท)</th>
                            <th style="text-align: center;">สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql1 = " SELECT *, count(bill_id) as count_cat FROM deposit WHERE user_id = '" . $user_id . "' GROUP BY bill_id ORDER BY bill_id DESC";
                        $q1 = mysqli_query($c, $sql1);
                        while ($f = mysqli_fetch_assoc($q1)) {
                            //=============
                            // $cat_name = "";
                            // $cat = json_decode($f['cat_id']);
                            // for ($i = 0; $i < count($cat); $i++) {
                            //     $sql2 = " SELECT * FROM customer WHERE cat_id = '" . $cat[$i] . "'";
                            //     $q2 = mysqli_query($c, $sql2);
                            //     while ($ca = mysqli_fetch_assoc($q2)) {
                            //         $cat_name = $cat_name . $ca["cat_name"] . ", ";
                            //     }
                            // }
                            //=============
                            $room_name = "";
                            $sql3 = " SELECT * FROM room WHERE id = " . $f['room_number'] . "";
                            $q3 = mysqli_query($c, $sql3);
                            while ($ca = mysqli_fetch_assoc($q3)) {
                                $room_name = $ca["roomtype"] . " - " . $ca["id_room"];
                            }

                            //=============
                        ?>
                            <tr>
                                <td style="text-align: center;"><?= $f['id'] ?></td>
                                <td style="text-align: center;"><?= $f['deposit_date'] ?></td>
                                <td style="text-align: center;"><?= $f['return_date'] ?></td>
                                <td style="text-align: center;"><?= $f['count_cat'] ?></td>
                                <td style="text-align: center;"><?= $room_name ?></td>
                                <td style="text-align: center;"><?= $f['deposit_price'] ?>/<?= $f['remaining_expenses'] ?? ' - ' ?></td>
                                <td style="text-align: center;"><?= $f['status_retuen'] == "1" ? "คืนแล้ว" : '<a href="return_r.php?bill=' . $f["bill_id"] . '&user_id=' . $user_id . '"><input type="button" class="btn btn-primary" value="รับคืน"></a>' ?></td>
                            </tr>
                        <?php
                        }
                        mysqli_close($c);
                        ?>
                    </tbody>
                </table>

                <!-- <a href="return_r.php" class="btn btn-primary">คำนวณค่าใช้จ่าย</a>

                <a href="homeowner.php" class="btn btn-danger">ยกเลิก</a> -->
        </div>
    <?php } ?>


    </form>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>