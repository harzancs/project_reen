<?php 
    require_once('roomconn.php');

    if (isset($_REQUEST['delete_id'])) {
        $id = $_REQUEST['delete_id'];

        $select_stmt = $db->prepare("SELECT * FROM customer WHERE id = :id");
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        // Delete an original record from db
        $delete_stmt = $db->prepare('DELETE FROM customer WHERE id = :id');
        $delete_stmt->bindParam(':id', $id);
        $delete_stmt->execute();

        header('Location:cat.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container bg">

    <div class="container bg">
    <div class="display-3 text-center">ข้อมูลแมว</div>
 <br><br>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                
                <th>ชื่อแมว</th>
                <th>เพศ</th>
                <th>สายพันธ์ุ</th>
                <th>ประเภทอาหาร</th>

            </tr>
        </thead>

        <tbody>
            <?php 
               $select_stmt = $db->prepare("SELECT * FROM customer ");
                $select_stmt->execute();

                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>

                <tr>
                
                    <td><?php echo $row["cat_name"]; ?></td>
                    <td><?php echo $row["sex"]; ?></td>
                    <td><?php echo $row["species"]; ?></td>
                    <td><?php echo $row["cat_food"]; ?></td>

                </tr>

            <?php } ?>
        </tbody>
    </table>
    </div>
    
                    <a href="homeowner.php" class="btn btn-danger">ยกเลิก</a>
                     
    
</body>
</html>
