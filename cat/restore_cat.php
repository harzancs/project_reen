
  <?php
    session_start();
    require_once "../config/configpdo.php";

    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $stmt = $conn -> query("DELETE FROM customer WHERE cat_id = $delete_id");
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
            header("refresh:2; url=../cat/show_cat.php");
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
            header("refresh:2; url=../cat/show_cat.php");
        }
  }

  if (isset($_GET['restore'])) {
    $delete_id = $_GET['restore'];
    $stmt = $conn -> query("UPDATE customer SET c_status='1' WHERE cat_id = $delete_id");
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
        header("refresh:2; url=../cat/restore_cat.php");
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
        header("refresh:2; url=../cat/restore_cat.php");
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลแมว</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
</head>

<body>
    <div class="container bg">

        <div class=" h4 text-center alert alert-info mb-4 mt-4" role="alert">คืนค่าข้อมูล</div>
        <hr>
        <a href="show_cat.php" class="btn btn-secondary mb-4">กลับ</a>

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

                        $stmt = $conn -> query("SELECT * FROM customer WHERE c_status='0' ");
                        $stmt -> execute();
                        $customer = $stmt -> fetchAll();

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
                        <a data-id="<?php echo $customer['cat_id']; ?>"
                            href=" ?restore=<?php echo $customer['cat_id']; ?>"
                            class="delete-btn icon-de fs-5 me-3 btn btn-outline-info"><i
                                class="bi bi-arrow-clockwise"></i></a>

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