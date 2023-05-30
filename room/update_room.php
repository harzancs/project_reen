<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
    session_start();
    require_once "../config/configpdo.php";

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $id_room = $_POST['id_room'];
        $roomtype = $_POST['roomtype'];
        $roomprice = $_POST['roomprice'];


        $sql = $conn->prepare("UPDATE room SET id_room=:id_room, roomtype = :roomtype, roomprice = :roomprice WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":id_room", $id_room);
        $sql->bindParam(":roomtype", $roomtype);
        $sql->bindParam(":roomprice", $roomprice);


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
                
                header("location: ../room/show_room.php");
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
                
                header("location: ../room/show_room.php");
        }
    }
?>