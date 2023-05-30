<?php
require_once "../config/config_sqli.php";

    session_start();
    $name= $_SESSION['name'];
    $lastname= $_SESSION['lastname'];



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลอาหาร</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <!--boxicon-->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!--flaticon-->
    <link href="https://registry.npmjs.org/@flaticon/flaticon-uicons/-/flaticon-uicons-1.7.0.tgz" rel="stylesheet">

    <!--css-->
    <link rel="stylesheet" href="../style.css">

</head>

<body>
    <div class="sidebar close">
        <div class="logo-details">
            <i class=''></i>
            <span class="logo_name">CAT HOTEL</span>
        </div>

        <ul class="nav-links">
            <li>
                <a href="../homeowner.php">
                    <i class='bx bxs-home-smile'></i>
                    <span class="link_name">หน้าหลัก</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="../homeowner.php">หน้าหลัก</a></li>
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
                        <span class="link_name">จัดการข้อมูล</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="../customer/customer_information.php">ข้อมูลลูกค้า</a></li>
                    <li><a href="../customer/cat_information.php">ข้อมูลแมว</a></li>
                    <li><a href="../room/show_room.php">ข้อมูลห้องพัก</a></li>
                    <li><a href="../food/show_food.php">ข้อมูลอาหาร</a></li>
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
                    <a href="material/cutstock_material.php">
                        <i class='bx bx-cut'></i>
                        <span class="link_name">การเงิน</span>
                    </a>
                </div>
                <ul class="sub-menu">
                    <li><a href="material/cutstock_material.php">การเงิน</a></li>
                </ul>
            </li>



            <li>
                <div class="iocn-link">
                    <a href="material/manage_material.php">
                        <i class='bx bxs-basket'></i>
                        <span class="link_name">จัดทำรายงาน</span>
                    </a>
                </div>
                <ul class="sub-menu">
                    <li><a href="material/manage_material.php">จัดทำรายงานค่าห้องพักและค่าอาหาร</a></li>
                </ul>
            </li>

            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <img src="../image/14.jpg" alt="profileImg">
                    </div>
                    <div class="name-job">
                        <div class="profile_name">เจ้าของร้าน</div>
                        <div class="job">
                            <h6><?php echo $name." ".$lastname; ?>
                        </div>
                    </div>
                    <a href="indexuser.php?logout='1'"> <i class='bx bx-log-out' id="logout"></i> </a>

                </div>
            </li>
        </ul>
    </div>

    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
        </div>
        <div class="container my-5">
            <div class=" h4 text-center alert alert-info mb-4 mt-4" role="alert">เพิ่มข้อมูลอาหาร</div>
            <form action="update_food.php" method="POST">

                <?php
                require_once "../config/configpdo.php";
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $stml = $conn->query("SELECT * FROM food WHERE id = $id");
                    $stml->execute();
                    $data = $stml->fetch();
                }
            ?>

                <div class="row py-2">
                    <div class="col">
                        <input hidden type="text" value="<?= $data['id']; ?>" name="id" class="form-control">
                        <label for="">ประเภทอาหาร</label>
                        <input type="text" value="<?= $data['food_type']; ?>" name="food_type" class="form-control" placeholder="ป้อนประเภทอาหาร"
                            oninvalid="setCustomValidity('กรุณาป้อนประเภทอาหาร')" oninput="setCustomValidity('')"
                            required>
                    </div>
                    <div class="col">
                        <label>ราคา</label>
                        <input type="number" value="<?= $data['price']; ?>" name="price" class="form-control" placeholder="ป้อนราคาอาหาร"
                            maxlength="20" oninvalid="setCustomValidity('กรุณาป้อนราคา')"
                            oninput="setCustomValidity('')" required>
                    </div>
                </div>


                <button type="submit" name="update" class="btn btn-success my-3">บันทึก</button>
                <a href="show_food.php" class="btn btn-danger">กลับ</a>
            </form>
        </div>
    </section>
    <script src="../script.js"></script>
</body>

</html>