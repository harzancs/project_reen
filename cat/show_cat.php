
<?php
require_once "../config/config_sqli.php";

    session_start();
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
        header("refresh:2; url=../loginform.php");
        // header("location: loginform.php");
        
      }
    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $stmt = "UPDATE customer set c_status='0' WHERE cat_id = $delete_id";
        $stmt = mysqli_query($conn, $stmt);

        if ($stmt) {
            $_SESSION['success'] = "ลบข้อมูลเรียบร้อยแล้ว";
            header("refresh:2; url=../cat/show_cat.php");
        } 
  }


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลแมว</title>

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
    <link rel="stylesheet" href="../sidebars.css">

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
                <a href="../indexuser.php">
                    <i class='bx bxs-home-smile'></i>
                    <span class="link_name">หน้าหลัก</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="../indexuser.php">หน้าหลัก</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="../cat/add_cat.php">
                        <i class='bx bxs-calendar-heart'></i>
                        <span class="link_name">กรอกข้อมูลแมว</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="../cat/add_cat.php">กรอกข้อมูลแมว</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="../cat/show_cat.php">
                        <i class='bx bxs-calendar-heart'></i>
                        <span class="link_name">ข้อมูลแมว</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="../cat/show_cat.php">ข้อมูลแมว</a></li>
                </ul>
            </li>
            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <img src="../image/cat2.jpg" alt="profileImg">
                    </div>
                    <div class="name-job">
                        <div class="profile_name">ผู้ใช้</div>
                        <div class="job">
                            <h6><?php echo $name." ".$lastname; ?>
                            </h6>
                        </div>
                    </div>
                    <a href="../loginform.php?logout='1'"> <i class='bx bx-log-out' id="logout"></i> </a>
                </div>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
        </div>

        <!-- <img src="image/bekery.jpg" alt="profileImg" width="1175" height="500"> -->

    <div class="container bg">

        <div class=" h4 text-center alert alert-danger mb-4 mt-4" role="alert"> ข้อมูลแมว</div>
        <hr>
        <a href="add_cat.php" class="btn btn-success mb-4"><i class="bi bi-plus-circle-fill"></i> เพิ่มข้อมูล</a>
        
        <table id="datatableid" class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>ชื่อแมว</th>
                    <th>เพศ</th>
                    <th>สายพันธ์ุ</th>
                    <th>ประเภทอาหาร</th>
                    <th class="text-center">จัดการ</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                    /* $stmt = "SELECT * FROM customer WHERE c_status='1'" ; */
                    $stmt = "SELECT * FROM customer WHERE name = '$name' AND c_status='1'" ;
                    $customer=mysqli_query($conn,$stmt);


                    if (!$customer) {
                        echo "<p><td colspan='8' class='text-center'>ไม่มีข้อมูล</td></p>";
                    } else {
                    foreach($customer as $customer)  {  
                ?>
                <tr>

                    <td><?php echo $customer['cat_name']; ?></td>
                    <td><?php echo $customer['sex']; ?></td>
                    <td><?php echo $customer['species']; ?></td>
                    <td><?php echo $customer['cat_food']; ?></td>
                    <td class="text-center">
                        <a href="edit_cat.php?cat_id=<?php echo $customer['cat_id']; ?>"
                            class="icon-cog fs-5 me-3 btn btn-outline-warning"><i class="bi bi-pencil-fill"></i>
                            <a data-id="<?php echo $customer['cat_id']; ?>"
                                href=" ?delete=<?php echo $customer['cat_id']; ?>"
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