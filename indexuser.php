<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php 
    session_start();
    require_once("config/config_sqli.php");
    $name= $_SESSION['name'];
    $lastname= $_SESSION['lastname'];

    if (!isset($_SESSION['user'])) {
      $_SESSION['msg'] = "Please Login";
      header("location:loginform.php");
    }

    if (isset($_GET['logout'])) {
  
      unset($_SESSION['user']);
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
    <title>พนักงาน</title>

    <!--Bootstap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--boxicon-->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!--flaticon-->
    <link href="https://registry.npmjs.org/@flaticon/flaticon-uicons/-/flaticon-uicons-1.7.0.tgz" rel="stylesheet">

    <!--css-->
    <link rel="stylesheet" href="sidebars.css">

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
                <a href="indexuser.php">
                    <i class='bx bxs-home-smile'></i>
                    <span class="link_name">หน้าหลัก</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="indexuser.php">หน้าหลัก</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="cat/add_cat.php">
                        <i class='bx bxs-calendar-heart'></i>
                        <span class="link_name">กรอกข้อมูลแมว</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="cat/add_cat.php">กรอกข้อมูลแมว</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="cat/show_cat.php">
                        <i class='bx bxs-calendar-heart'></i>
                        <span class="link_name">ข้อมูลแมว</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="cat/show_cat.php">ข้อมูลแมว</a></li>
                </ul>
            </li>
            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <img src="image/cat2.jpg" alt="profileImg">
                    </div>
                    <div class="name-job">
                        <div class="profile_name">ผู้ใช้</div>
                        <div class="job">
                            <h6><?php echo $name." ".$lastname; ?>
                            </h6>
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
            <div class="row text-center py-5">
                <div class="col-md-4 col-sm-6 my-3 my-md-0">
                    <div class="card shadow">
                        <div>
                            <img style="width: 700px; height: 550px;" src="image/เวลาให้อาหาร.png" alt="profileImg"
                                class="img-fluid card-img-top">
                        </div>
                        
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 my-3 my-md-0">
                    <div class="card shadow">
                        <div>
                            <img style="width: 700px; height: 550px;" src="image/ราคาห้อง.png" alt="profileImg"
                                class="img-fluid card-img-top">
                        </div>
                        
                    </div>

                </div>

                <div class="col-md-4 col-sm-6 my-3 my-md-0">
                    <div class="card shadow">
                        <div>
                            <img style="width: 800px; height: 550px;" src="image/อาหาร.png" alt="profileImg"
                                class="img-fluid card-img-top">
                        </div>
                        
                    </div>

                </div>

            </div>
    </section>





    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>



</html>