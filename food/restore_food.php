<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<?php
 require_once "../config/configpdo.php";

    session_start();
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
        header("refresh:2; url=../loginform.php");
        // header("location: loginform.php");
      }
      if (isset($_GET['restore'])) {
        $delete_id = $_GET['restore'];
        $stmt = $conn -> query("UPDATE food SET f_status='1' WHERE id = $delete_id");
        $stmt -> execute();
    
        if ($stmt) {
            $_SESSION['success'] = "คืนค่าข้อมูลเรียบร้อยแล้ว";
            echo "<script>
                $(document).ready(function () {
                    Swal.fire ({
                        icon: 'success',
                        title: 'สำเร็จ',
                        text: 'คืนค่าข้อมูลเรียบร้อยแล้ว',
                        timer: 2000,
                        showConfirmButton: true
                    });
                });
            </script>";
            header("refresh:2; url=../food/restore_food.php");
        } else {
            $_SESSION['error'] = "คืนค่าข้อมูลไม่สำเร็จ";
            echo "<script>
                $(document).ready(function () {
                    Swal.fire ({
                        icon: error',
                        title: 'เกิดข้อผิดพลาด',
                        text: 'คืนค่าข้อมูลไม่สำเร็จ',
                        timer: 2000,
                        showConfirmButton: true
                    });
                });
            </script>";
            header("refresh:2; url=../food/restore_food.php");
        }
    }

    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $stmt = $conn -> query("DELETE FROM food WHERE id = $delete_id");
        $stmt -> execute();


        if ($stmt) {
            $_SESSION['success'] = "ลบข้อมูลเรียบร้อยแล้ว";
            echo "<script>
                $(document).ready(function () {
                    Swal.fire ({
                        icon: 'success',
                        title: 'สำเร็จ',
                        text: 'ลบข้อมูลเรียบร้อยแล้ว',
                        timer: 2000,
                        showConfirmButton: true
                    });
                });
            </script>";
            header("refresh:2; url=../food/restore_food.php");
        } else {
            $_SESSION['error'] = "ลบข้อมูลไม่สำเร็จ";
            echo "<script>
                $(document).ready(function () {
                    Swal.fire ({
                        icon: error',
                        title: 'เกิดข้อผิดพลาด',
                        text: 'ลบข้อมูลไม่สำเร็จ',
                        timer: 2000,
                        showConfirmButton: true
                    });
                });
            </script>";
            header("refresh:2; url=../food/restore_food.php");
        }
  }

    


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลอาหาร</title>

    <!--Bootstap-->
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
    <div class="container bg">

        <div class=" h4 text-center alert alert-danger mb-4 mt-4" role="alert"> คืนค่าข้อมูลอาหาร</div>
        <hr>
        <a href="show_food.php" class="btn btn-secondary mb-4">กลับ</a>
        <table id="datatableid" class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>ประเภทอาหาร</th>
                    <th>ราคา</th>
                    <th class="text-center">จัดการ</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                    
                    $stmt = $conn -> query("SELECT * FROM food WHERE f_status='0' ");
                    $stmt -> execute();
                    $food = $stmt -> fetchAll();

                    if (!$food) {
                        echo "<p><td colspan='8' class='text-center'>ไม่มีข้อมูล</td></p>";
                    } else {
                    foreach($food as $food)  {  
                ?>
                <tr>

                    <td><?php echo $food['food_type']; ?></td>
                    <td><?php echo $food['price']; ?></td>
                    <td class="text-center">
                        <a href="?restore=<?php echo $food['id']; ?>"
                            class="icon-cog fs-5 me-3 btn btn-outline-info"><i class="bi bi-arrow-clockwise"></i>
                            <a data-id="<?php echo $food['id']; ?>"
                                href="?delete=<?php echo $food['id']; ?>"
                                class="delete-btn icon-de fs-5 me-3 btn btn-outline-danger"><i
                                    class="bi bi-trash3-fill"></i></a>
                    </td>

                </tr>
                <?php } 
                } ?>
            </tbody>
        </table>
    </div>
    </div>
    </section>
    <script src="../script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {

            $('#datatableid').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "ไม่มีข้อมูลในตาราง",
                    "info": "แสดง _START_ - _END_ จาก _TOTAL_ รายการ",
                    "infoEmpty": "แสดง 0 - 0 จาก 0 รายการ",
                    "infoFiltered": "(กรอง จาก _MAX_ รายการทั้งหมด)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "แสดง _MENU_ รายการ",
                    "loadingRecords": "กำลังโหลด...",
                    "processing": "",
                    "search": "ค้นหา:",
                    "zeroRecords": "ไม่พบบันทึกที่ตรงกัน",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "หน้าถัดไป",
                        "previous": "ก่อนหน้า"
                    },
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    }
                },


            });
        });
    </script>
</body>

</html>