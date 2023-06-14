<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
session_start();
require_once "../config/config_sqli.php";

if (isset($_POST['update'])) {
    $cat_id = $_POST['cat_id'];
    $cat_name = $_POST['cat_name'];
    $sex = $_POST['sex'];
    $species = $_POST['species'];
    $cat_food = $_POST['cat_food'];


    $sql = "UPDATE customer SET cat_name = '{$cat_name}', sex = '{$sex}', species = '{$species}', cat_food = {$cat_food} WHERE cat_id = {$cat_id}";
    $insert = mysqli_query($conn, $sql);



    if ($insert) {
        echo "Success";
        echo '<script>
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "แก้ไขข้อมูลเรียบร้อยแล้ว",
                    showConfirmButton: false,
                    timer: 1500
                    }).then(function() {
                        window.location = "../cat/show_cat.php";
                    });
                  
                </script>';

        // header("location: ../cat/show_cat.php");
    } else {
        echo "Fails";
        echo '<script>
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "แก้ไขข้อมูลไม่สำเร็จ",
                    showConfirmButton: false,
                    timer: 1500
                    }).then(function() {
                        window.location = "../cat/show_cat.php";
                    });
                </script>';

        // header("location: ../cat/show_cat.php");
    }
}
?>