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

    <?php require  'util\convert_number.php'; ?>
</head>

<body>
    <div class="container my-5">
        <div class=" h4 text-center alert alert-info mb-4 mt-4" role="alert">รายละเอียดค่าใช่จ่ายที่เหลือ</div>
        <?php
        date_default_timezone_set("Asia/Bangkok");
        if (isset($_GET['bill'])) {
            // print_r($_POST);
            $bill_id = $_GET['bill'];
            $user_id = $_GET['user_id'];
            $cat_food = 0;
            if (isset($_POST['cat_food'])) {
                $cat_food = $_POST['cat_food'];
            }

            //-----
            $c = mysqli_connect("localhost", "root", "", "cat");
            mysqli_query($c, "SET NAMES UTF8");

            $sql = " SELECT * FROM user WHERE id = '" . $user_id . "' LIMIT 1";
            $q = mysqli_query($c, $sql);
            while ($f = mysqli_fetch_assoc($q)) {
                $user_name = $f['name'];
            }
            //-------
            $sql = " SELECT * FROM deposit WHERE bill_id = " . $bill_id . "";
            $q = mysqli_query($c, $sql);
            $cat = $cars = array();
            while ($f = mysqli_fetch_assoc($q)) {
                $deposit_date = $f['deposit_date'];
                $return_date = $f['return_date'];
                $cat_id = $f['cat_id'];
                array_push($cat, $f['cat_id']);
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
        } ?>
        <form action="return_r.php?bill=<?= $bill ?>&user_id=<?= $user_id ?>" method="post">
            <div class="row py-2">
                <div class="col">
                    <label>รหัสลูกค้า</label>
                    <input type="text" name="user_id" value="<?= $user_id ?>" class="form-control" readonly>
                </div>

                <div class="col">
                    <label>รหัสใบเสร็จ</label>
                    <input type="text" name="bill" value="<?= $bill_id ?>" class="form-control" readonly>
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
            <div class="row py-2">
                <div class="col">
                    <table style="width:100%" class="table table-striped table-hover table-bordered dataTable no-footer">
                        <?php
                        $count_meal = (countMeal($deposit_date, date('Y-m-d H:i:s')));
                        ?>
                        <thead>
                            <tr>
                                <th style="text-align: center;"></th>
                                <th style="text-align: center;">ชื่อแมว</th>
                                <th style="text-align: center;">เพศ</th>
                                <th style="text-align: center;">สายพันธ์ุ</th>
                                <th style="text-align: center;">ประเภทอาหาร</th>
                                <th style="text-align: center;">รวมค่าหาร (<?= $count_meal  ?> มื้อ)</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result_meal_price = 0;
                            for ($i = 0; $i < count($cat); $i++) {
                                $sql1 = "SELECT a.*, b.food_type AS food ,b.price AS food_price
                                FROM customer AS a
                                INNER JOIN food AS b
                                ON a.cat_id = {$cat[$i]}
                                AND a.cat_food = b.id";
                                $q1 = mysqli_query($c, $sql1);
                                while ($f = mysqli_fetch_assoc($q1)) {
                            ?>
                                    <tr>
                                        <td style="text-align: center;"><?= $cat[$i] ?></td>
                                        <td style="text-align: center;"><?= $f['cat_name'] ?></td>
                                        <td style="text-align: center;"><?= $f['sex'] ?></td>
                                        <td style="text-align: center;"><?= $f['species'] ?></td>
                                        <td style="text-align: center;"><?= $f['food'] ?> (มื้อละ <?= $f['food_price'] ?> บาท)</td>
                                        <td style="text-align: center;"><?= $f['food_price'] * $count_meal ?></td>
                                    </tr>
                            <?php
                                    $result_meal_price = $result_meal_price + ($f['food_price'] * $count_meal);
                                }
                            }
                            ?>
                            <tr>
                                <td colspan="5" style="text-align: center;">จำนวนแมว <?= count($cat) ?> ตัว</td>
                                <td style="text-align: center;"><?= $result_meal_price ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </form>
        <form action="update_binder.php" method="POST">
            <!-- // hidden -->
            <input type="hidden" name="bill_id" value='<?= $bill_id ?>' class="form-control">
            <input type="hidden" name="deposit_date" value="<?= $deposit_date ?>" class="form-control">
            <input type="hidden" name="return_date" value="<?= $return_date ?>" class="form-control">
            <input type="hidden" name="return_date_actual" value="<?= date('Y-m-d H:i:s') ?>" class="form-control">
            <input type="hidden" name="user_id" value="<?= $user_id ?>" class="form-control">
            <input type="hidden" name="cat" value='<?= json_encode($cat) ?>' class="form-control">
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
                                จำนวน <?= dateDiff($deposit_date, date('Y-m-d H:i:s')) ?> คืน : <?= dateDiff($deposit_date, date('Y-m-d H:i:s')) * $room_price ?> บาท (<?= $room_price ?> บาท/คืน)
                            </p>
                        </div>
                        <div class="col-6">

                        </div>
                        <div class="col-6">
                            <p class="card-text">
                                ค่ามัดจำห้อง : <?= $deposit_price ?> บาท (* จ่ายแล้ว)
                            </p>
                        </div>
                        <div class="col-6">
                            <p class="card-text">
                                เหลือค่าห้อง : <?= (ceil((dateDiff($deposit_date, date('Y-m-d H:i:s')) * $room_price) -  $deposit_price)) ?> บาท
                                <input type="hidden" name="room_total_price" value="<?= ceil((dateDiff($deposit_date, date('Y-m-d H:i:s')) * $room_price)) ?>" class="form-control">
                            </p>
                        </div>
                        <div class="col-6">
                            ค่าอาหารทั้งหมด <?= $result_meal_price ?> บาท
                            <input type="hidden" name="count_meal" value="<?= $count_meal ?>" class="form-control">
                            <input type="hidden" name="food_total_price" value="<?= $result_meal_price ?>" class="form-control">
                        </div>

                    </div>

                </div>

            </div>
            <div class="card ">
                <h5 class="card-header text-black border-0">
                    <p class="card-text">
                        <?php
                        $result_remaining_expenses = $result_meal_price  + (ceil((dateDiff($deposit_date, date('Y-m-d H:i:s')) * $room_price) -  $deposit_price));
                        ?>
                        ค่าใช้จ่ายทั้งหมด <?= $result_remaining_expenses ?> บาท (<?= Convert($result_remaining_expenses) ?>)
                    </p>
                </h5>
            </div>
            <input type="hidden" name="remaining_expenses" value='<?= $result_remaining_expenses ?>' class="form-control">
            <input type="hidden" name="number_nights" value='<?= dateDiff($deposit_date, date('Y-m-d H:i:s')) ?>' class="form-control">

            <button type="submit" name="submit" class="btn btn-success my-3">บันทึกและพิมพ์</button>
            <a href="return.php" class="btn btn-danger">กลับ</a>
        </form>
    </div>

</html>

<?php
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

function countMeal($date1, $date2)
{
    $a = 0;
    $b = 0;
    if (!is_null($date1) && !is_null($date2)) {
        $date_1_array = explode(" ", $date1);
        $date_2_array = explode(" ", $date2);
        //===
        $start_day = strtotime($date_1_array[0]);
        $end_day = strtotime($date_2_array[0]);
        $datediff = $end_day - $start_day;
        $day = round($datediff / (60 * 60 * 24));
        //===
        if (strtotime($date_1_array[1]) > strtotime('08:00:00')) {
            $a++;
        }
        if (strtotime($date_1_array[1]) > strtotime('17:00:00')) {
            $a++;
        }
        if (strtotime($date_2_array[1]) > strtotime('8:00:00')) {
            $b++;
        }
        if (strtotime($date_2_array[1]) > strtotime('17:00:00')) {
            $b++;
        }
        return ((($day * 2) - $a) + $b);
    } else {
        return 0;
    }
}
?>