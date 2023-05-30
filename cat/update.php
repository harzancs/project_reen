
<?php
    session_start();
    require_once "../config/configpdo.php";

    if (isset($_POST['update'])) {
        $cat_id = $_POST['cat_id'];
        $cat_name = $_POST['cat_name'];
        $sex = $_POST['sex'];
        $species = $_POST['species'];
        $cat_food = $_POST['cat_food'];

        print $cat_name;

        
        $sql = $conn->prepare("UPDATE customer SET cat_name = :cat_name, sex = :sex, species = :species, cat_food = :cat_food WHERE cat_id = :cat_id");
        $sql->bindParam(":cat_id", $cat_id);
        $sql->bindParam(":cat_name", $cat_name);
        $sql->bindParam(":sex", $sex);
        $sql->bindParam(":species", $species);
        $sql->bindParam(":cat_food", $cat_food);

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
                
                header("location: ../cat/show_cat.php");
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
                
                header("location: ../cat/show_cat.php");
        }
    }
?>