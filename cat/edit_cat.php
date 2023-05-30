<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลแมว</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <div class=" h4 text-center alert alert-info mb-4 mt-4" role="alert">แก้ไขข้อมูลแมว</div>
        <form action="update.php" method="POST" enctype="multipart/form-data">
            <?php
                require_once "../config/configpdo.php";
                if (isset($_GET['cat_id'])) {
                    $cat_id = $_GET['cat_id'];
                    $stml = $conn->query("SELECT * FROM customer WHERE cat_id = $cat_id");
                    $stml->execute();
                    $data = $stml->fetch();
                }
            ?>
            <div class="row py-2">
                <div class="col">
                    <input hidden type="text" value="<?= $data['cat_id']; ?>" name="cat_id" class="form-control">
                    <label>ชื่อแมว</label>
                    <input type="text" name="cat_name" value="<?= $data['cat_name']; ?>" class="form-control"
                        placeholder="ป้อนชื่อแมว" maxlength="20" oninvalid="setCustomValidity('กรุณาป้อนชื่อแมว')"
                        oninput="setCustomValidity('')" required>
                </div>
                <div class="col">
                    <label for="">เพศ</label>
                    <select name="sex" class="form-select" require>
                        <option value="<?= $data['sex']; ?>" selected hidden><?= $data['sex']; ?></option>
                        <option value="ผู้">ผู้</option>
                        <option value="เมีย">เมีย</option>
                    </select>
                </div>
            </div>
            <div class="row py-2">
                <div class="col">
                    <label>สายพันธุ์</label>
                    <input type="text" name="species" value="<?= $data['species']; ?>" class="form-control"
                        placeholder="ป้อนชื่อแมว" maxlength="20" oninvalid="setCustomValidity('กรุณาป้อนชื่อแมว')"
                        oninput="setCustomValidity('')" required>
                </div>
                <div class="col">
                    <label for="">ประเภทอาหาร</label>
                    <select name="cat_food" class="form-select" require>
                        <option value="<?= $data['cat_food']; ?>" selected hidden><?= $data['cat_food']; ?></option>
                        <option value="อาหารเม็ด">อาหารเม็ด</option>
                        <option value="นำอาหารมาเอง">นำอาหารมาเอง</option>
                    </select>
                </div>
            </div>


            <button type="submit" name="update" class="btn btn-success my-3">บันทึก</button>
            <a href="show_cat.php" class="btn btn-danger">กลับ</a>
        </form>
    </div>

</body>

</html>