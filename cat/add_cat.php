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


?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลแมว</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <div class=" h4 text-center alert alert-info mb-4 mt-4" role="alert">เพิ่มข้อมูลแมว</div>
        <form action="insert_cat.php" method="POST" >
            <div class="row py-2">
                <div class="col">
                    <label>ชื่อแมว</label>
                    <input type="text" name="cat_name" class="form-control" placeholder="ป้อนชื่อแมว" maxlength="20"
                        oninvalid="setCustomValidity('กรุณาป้อนชื่อแมว')" oninput="setCustomValidity('')" required>
                </div>
                <div class="col">
                    <label for="">เพศ</label>
                    <select name="sex" class="form-select" require>
                        <option value="" selected hidden>--- เลือกเพศ ---</option>
                        <option value="ผู้">เพศผู้</option>
                        <option value="เมีย">เพศเมีย</option>
                    </select>
                </div>
            </div>
            <div class="row py-2">
                <div class="col">
                    <label>สายพันธุ์</label>
                    <input type="text" name="species" class="form-control" placeholder="ป้อนชื่อแมว" maxlength="20"
                        oninvalid="setCustomValidity('กรุณาป้อนชื่อแมว')" oninput="setCustomValidity('')" required>
                </div>
                <div class="col">
                    <label for="">ประเภทอาหาร</label>
                    <select name="cat_food" class="form-select" require>
                        <option value="" selected hidden>--- เลือกประเภทอาหาร ---</option>
                        <option value="อาหารเม็ด">อาหารเม็ด</option>
                        <option value="อาหารเม็ด">อาหารเปียก</option>
                        <option value="นำอาหารมาเอง">นำอาหารมาเอง</option>
                    </select>
                </div>
            </div>


            <button type="submit" name="submit" class="btn btn-success my-3">บันทึก</button>
            <a href="../indexuser.php" class="btn btn-danger">กลับ</a>
        </form>
    </div>

</body>

</html>