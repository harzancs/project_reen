<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
// if(!isset($_SESSION['user'])){
//   header("location; ../loginform.php");
// }
session_start();
require_once("config/config_sqli.php");
$name= $_SESSION['name'];
$lastname= $_SESSION['lastname'];

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--boxicon-->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!--flaticon-->
    <link href="https://registry.npmjs.org/@flaticon/flaticon-uicons/-/flaticon-uicons-1.7.0.tgz" rel="stylesheet">


    <!--css-->
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <?php
        if(isset($_SESSION['success'])){
            echo $_SESSION['success'];
            unset($_SESSION['success']);
        }elseif(isset($_SESSION['error'])){
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
                        <h6><?php echo $name." ".$lastname; ?>
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
        <div class=" h4 text-center alert alert-info mb-4 mt-4" role="alert">จัดทำรายงานค่าห้องพักและค่าอาหาร</div>
        <table width="800" border="0" align="center" cellpadding="0" cellspacing="2">
        <form action="" method="get" >
            <th>วันที่ฝาก : <input type="datetime-local" name="mydata"></th>
                
        </form>

        <br>
        <form action="" method="get" >
            <th>ถึงวันที่ : <input type="datetime-local" name="mydata"></th>
           
        </form>
        </table>

           
            <a href="homeowner.php" class="btn btn-danger">กลับ</a>
        </form>
    </div>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</html>


