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
            <form action="finance.php" method="get">
                <div class=" h4 text-center alert alert-info mb-4 mt-4" role="alert">การเงิน</div>
                <table width="800" border="0" align="center" cellpadding="0" cellspacing="2">

                    <th>วันที่ฝาก : <input type="datetime-local" value="<?= isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-d H:i:s', strtotime('-1 day'))  ?>" name="start_date"></th>



                    <th>ถึงวันที่ : <input type="datetime-local" value="<?= isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d H:i:s')  ?>" name="end_date"></th>

                </table>

                <button type="submit" class="btn btn-success my-3">ตกลง</button>
                <a href="homeowner.php" class="btn btn-danger">กลับ</a>
            </form>

        </div>
        <?php
        if (isset($_GET['start_date'])) {

        ?>
            <div class="container my-5">
                <table style="width:100%" class="table table-striped table-hover table-bordered dataTable no-footer">
                    <thead>
                        <tr>
                            <th style="text-align: center;">bill id</th>
                            <th style="text-align: center;">ชื่อลูกค้า</th>
                            <th style="text-align: center;">ชนิดบิล</th>
                            <th style="text-align: center;">วันที่ทำรายการ</th>
                            <th style="text-align: center;">ค่าใช้จ่าย</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $c = mysqli_connect("localhost", "root", "", "cat");
                        mysqli_query($c, "SET NAMES UTF8");


                        $sql1 = " SELECT * FROM bill WHERE duo_time BETWEEN  '" .  $_GET['start_date'] . "' AND '" .  $_GET['end_date'] . "' ORDER BY id DESC";
                        $q1 = mysqli_query($c, $sql1);

                        $room_total_price  = 0;
                        $food_total_price  = 0;
                        $total_price = 0;
                        $number = 0;
                        while ($f = mysqli_fetch_assoc($q1)) {
                            $number++;
                            //=============
                            // $cat_name = "";
                            // $sql2 = " SELECT * FROM customer WHERE cat_id = '" . $f['cat_id'] . "'";
                            // $q2 = mysqli_query($c, $sql2);
                            // while ($ca = mysqli_fetch_assoc($q2)) {
                            //     $cat_name = $cat_name . $ca["cat_name"] . ", ";
                            // }

                            //=============
                            if ($f['bill_type'] == "deposit") {
                                $price = "";
                                $sql3 = " SELECT * FROM deposit WHERE bill_id = " . $f['id'] . " GROUP BY bill_id";
                                $q3 = mysqli_query($c, $sql3);
                                while ($ca = mysqli_fetch_assoc($q3)) {
                                    $price = $ca["deposit_price"];
                                }
                            } else if ($f['bill_type'] == "return") {
                                $price = "";
                                $sql3 = " SELECT * FROM return_cat WHERE bill_id = " . $f['id'] . " GROUP BY bill_id";
                                $q3 = mysqli_query($c, $sql3);
                                while ($ca = mysqli_fetch_assoc($q3)) {
                                    $price = $ca["total_price"];
                                }
                            }


                            //=============
                            $user_name = "";
                            $sql3 = " SELECT * FROM user WHERE id = " . $f['user_id'] . "";
                            $q3 = mysqli_query($c, $sql3);
                            while ($ca = mysqli_fetch_assoc($q3)) {
                                $user_name = $ca["name"] . "  " . $ca["lastname"];
                            }

                            //=============
                        ?>
                            <tr>
                                <td style="text-align: center;"><?= $f['id'] ?></td>
                                <td style="text-align: center;"><?= $user_name ?></td>
                                <td style="text-align: center;"><?= $f['bill_type'] ?></td>
                                <td style="text-align: center;"><?= $f['duo_time'] ?></td>
                                <td style="text-align: center;"><?= $price ?></td>
                            </tr>

                        <?php
                            $total_price = $total_price + $price;
                        }

                        mysqli_close($c);
                        ?>
                        <tr>
                            <td colspan="4" style="text-align: center;font-weight: bold;">ทั้งหมด <?= $number ?> รายการ</td>
                            <td style="text-align: center;font-weight: bold;"><?= $total_price ?></td>
                        </tr>
                    </tbody>
            </div>
        <?php } ?>
        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

</html>