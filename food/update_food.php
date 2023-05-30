<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
    session_start();
    require_once "../config/configpdo.php";

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $food_type = $_POST['food_type'];
        $price = $_POST['price'];


        $sql = $conn->prepare("UPDATE food SET food_type = :food_type, price = :price WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":food_type", $food_type);
        $sql->bindParam(":price", $price);


        $sql->execute();

        if ($sql) {
            $_SESSION['success'] = '<script>
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "แก้ไขข้อมูลเรียบร้อยแล้ว",
                    showConfirmButton: false,
                    timer: 1500
                    })
                </script>';
                
                header("location: ../food/show_food.php");
        } else {
            $_SESSION['success'] = '<script>
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "แก้ไขข้อมูลไม่สำเร็จ",
                    showConfirmButton: false,
                    timer: 1500
                    })
                </script>';
                
                header("location: ../food/show_food.php");
        }
    }
?>