<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!--Bootstap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

</head>

<body>
    <div class="container my-5">
        <div class=" h4 text-center alert alert-info mb-4 mt-4" role="alert">รายละเอียดค่าใช่จ่ายที่เหลือ</div>
        <?php
        date_default_timezone_set("Asia/Bangkok");
        if (isset($_GET['bill'])) {
            // print_r($_POST);
            $bill = $_GET['bill'];
            $user_id = $_GET['user_id'];
            //-----
            $c = mysqli_connect("localhost", "root", "", "cat");
            mysqli_query($c, "SET NAMES UTF8");

            $sql = " SELECT * FROM user WHERE id = '" . $user_id . "' LIMIT 1";
            $q = mysqli_query($c, $sql);
            while ($f = mysqli_fetch_assoc($q)) {
                $user_name = $f['name'];
            }
            //-------
            $sql = " SELECT * FROM deposit WHERE id = " . $bill . " LIMIT 1";
            $q = mysqli_query($c, $sql);
            while ($f = mysqli_fetch_assoc($q)) {
                $deposit_date = $f['deposit_date'];
                $return_date = $f['return_date'];
                $cat_id = $f['cat_id'];
                $cat = json_decode($f['cat_id']);
                $room_number = $f['room_number'];
                $deposit_price = $f['deposit_price'];
            }
            //-------
            $sql = " SELECT * FROM room WHERE id = '" . $room_number . "' LIMIT 1";
            $q = mysqli_query($c, $sql);
            while ($f = mysqli_fetch_assoc($q)) {
                $room_name = $f['roomtype'] . " - " . $f['id_room'];
                $room_price = $f['roomprice'];
            }
            function dateDiff($date1, $date2)
            {
                if (!is_null($date1) && !is_null($date2)) {
                    $diff = abs(strtotime($date2) - strtotime($date1));

                    $years = floor($diff / (365 * 60 * 60 * 24));
                    $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                    return $days;
                } else {
                    return 0;
                }
            }
        } ?>
        <form action="update_binder.php" method="POST">
            <div class="row py-2">
                <div class="col">
                    <label>รหัสลูกค้า</label>
                    <input type="text" name="user_id" value="<?= $user_id ?>" class="form-control" readonly>
                </div>

                <div class="col">
                    <label>รหัสใบเสร็จ</label>
                    <input type="text" name="bill" value="<?= $bill ?>" class="form-control" readonly>
                </div>

            </div>
            <div class="row py-2">
                <div class="col">
                    <label>ชื่อลูกค้า</label>
                    <input type="text" name="user_name" value="<?= $user_name ?>" class="form-control" readonly>
                </div>

            </div>
            <div class="row py-2">
                <div class="col">
                    <label>วันที่ฝาก</label>
                    <input type="datetime" name="deposit_date" value="<?= $deposit_date ?>" class="form-control" readonly>
                </div>
                <div class="col">
                    <label>วันที่รับคืน</label>
                    <input type="datetime" name="return_date" value="<?= $return_date ?>" class="form-control" readonly>
                </div>

            </div>
            <div class="row py-2">

                <div class="col">
                    <label>วันที่รับคืนจริง</label>
                    <input type="datetime" name="return_date_actual" value="<?= date('Y-m-d H:i:s') ?>" class="form-control" readonly>
                </div>
            </div>

            <!-- // hidden -->
            <input type="hidden" name="remaining_expenses" value='<?= (ceil((dateDiff($deposit_date, date('Y-m-d H:i:s')) * $room_price) -  $deposit_price)) ?>' class="form-control">
            <input type="hidden" name="cat_id" value='<?= $cat_id ?>' class="form-control">
            <!-- // hidden -->

            <div class="card ">
                <h5 class="card-header bg-info text-white border-0">สรุปค่าใช้จ่าย</h5>
                <div class="card-body">

                    <div class="card-body row">
                        <div class="col-12">
                            <p class="card-text">
                                ฝากเลี้ยงแมว <?= count($cat); ?> ตัว
                            </p>
                        </div>
                        <div class="col-6">
                            <p class="card-text">
                                จำนวน <?= dateDiff($deposit_date, date('Y-m-d H:i:s')) ?> คืน : <?= dateDiff($deposit_date, date('Y-m-d H:i:s')) * $room_price ?> บาท
                            </p>
                        </div>
                        <div class="col-6">
                            <p class="card-text">
                                ราคาต่อคืน : <?= $room_price ?> บาท
                            </p>
                        </div>
                        <div class="col-12">
                            <p class="card-text">
                                ค่ามัดจำห้อง 50% : <?= $deposit_price ?> บาท (* จ่ายแล้ว)
                            </p>
                        </div>
                        <div class="col-6"></div>
                        <div class="col-6">
                            <p class="card-text">
                                ค่าใช้จ่ายที่เหลือ <?= (ceil((dateDiff($deposit_date, date('Y-m-d H:i:s')) * $room_price) -  $deposit_price)) ?> บาท
                            </p>
                        </div>
                    </div>

                </div>

            </div>

            <button type="submit" name="submit" class="btn btn-success my-3">บันทึกและพิมพ์</button>
            <a href="return.php" class="btn btn-danger">กลับ</a>
        </form>
    </div>

</html>