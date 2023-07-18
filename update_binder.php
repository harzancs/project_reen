<?php require  'util\convert_number.php'; ?>
<?php
$c = mysqli_connect("localhost", "root", "", "cat");
mysqli_query($c, "SET NAMES UTF8");
//----------------
if (isset($_POST['bill_id'])) {
    // print_r($_POST);
    $bill_id = $_POST['bill_id'];
    $user_id = $_POST['user_id'];
    $deposit_date = $_POST['deposit_date'];
    $return_date = $_POST['return_date'];
    $return_date_actual = $_POST['return_date_actual'];
    $remaining_expenses = $_POST['remaining_expenses'];
    $room_total_price = $_POST['room_total_price'];
    $cat_id = $_POST['cat'];
    //-----
    $food_meal = $_POST['count_meal'];
    $food_total_price = $_POST['food_total_price'];
    $number_nights = $_POST['number_nights'];
    //-----
    $sql2 = " SELECT * FROM deposit WHERE  bill_id = {$bill_id} GROUP BY bill_id";
    $q2 = mysqli_query($c, $sql2);
    while ($f = mysqli_fetch_assoc($q2)) {
        $room_number =  $f['room_number'];
        $deposit_price =  $f['deposit_price'];
    }

    // -----
    $sql2 = " SELECT * FROM user WHERE  id = {$user_id}";
    $q2 = mysqli_query($c, $sql2);
    while ($f = mysqli_fetch_assoc($q2)) {
        $full_name =  $f['name'] . " " . $f['lastname'];
        $address =  $f['address'];
        $phone =  $f['phone'];
    }

    // -----
    $sql = "INSERT INTO bill (user_id,bill_type)
        VALUES ('{$user_id}', 'return')";
    $insert = mysqli_query($c, $sql);

    if ($insert) {
        $sql3 = " SELECT * FROM bill ORDER BY id DESC LIMIT 1";
        $q3 = mysqli_query($c, $sql3);
        while ($f = mysqli_fetch_assoc($q3)) {
            $bill_id_new = $f['id'];
        }
        //===========
        $sql = "UPDATE deposit SET status_retuen = '1' WHERE bill_id = {$bill_id}";
        $insert = mysqli_query($c, $sql);
        //===========

        $sql = "INSERT INTO return_cat (user_id,bill_id,bill_id_deposit,return_date_actual,total_price,total_food_price,meal_food,number_nights)
                    VALUES ('{$user_id}', {$bill_id_new}, {$bill_id},'{$return_date_actual}',{$remaining_expenses},{$food_total_price},{$food_meal},{$number_nights})";

        $insert = mysqli_query($c, $sql);
        if ($insert) {
            $sql = "UPDATE room SET is_active = '1' WHERE id = {$room_number}";
            $insert = mysqli_query($c, $sql);
            //=====
            $cat = json_decode($cat_id);
            for ($i = 0; $i < count($cat); $i++) {
                $sql = "UPDATE customer SET deposit_status = '0' WHERE cat_id = {$cat["$i"]}";
                $insert = mysqli_query($c, $sql);
                //    echo  $sql;
            }
            echo '<script>alert("บันทึกข้อมูลเรียบร้อยแล้ว");</script>';
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($c);
        }
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ใบเสร็จรับเงิน</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style type="text/css" media="print">
        #paper {
            width: 21cm;
            min-height: 25cm;
            padding: 2.5cm;
            position: relative;
        }
    </style>

    <style type="text/css" media="screen">
        #paper {
            background: #FFF;
            border: 1px solid #666;
            margin: 20px auto;
            width: 21cm;
            min-height: 25cm;
            padding: 50px;
            position: relative;

            /* CSS3 */

            box-shadow: 0px 0px 5px #000;
            -moz-box-shadow: 0px 0px 5px #000;
            -webkit-box-shadow: 0px 0px 5px #000;
        }
    </style>
    <style type="text/css">
        #paper textarea {
            margin-bottom: 25px;
            width: 50%;
        }

        #paper table,
        #paper th,
        #paper td {
            border: none;
        }

        #paper table.border,
        #paper table.border th,
        #paper table.border td {
            border: 1px solid #666;
        }

        #paper th {
            background: none;
            color: #000
        }

        #paper hr {
            border-style: solid;
        }

        #signature {
            bottom: 181px;
            margin: 50px;
            padding: 50px;
            position: absolute;
            right: 3px;
            text-align: center;
        }

        .tab-menu {
            z-index: 0 !important;
            padding: 20px;
            position: fixed;
        }

        @media print {
            .tab-menu {
                display: none;
            }

            @page {
                size: A4;
                margin: 2.5cm;
            }

            #paper {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="tab-menu">
        <button type="button" class="btn btn-primary" onclick="window.location.href='homeowner.php'">หน้าแรก</button>
        <button type="button" class="btn btn-secondary" onclick="window.print()">พิมพ์</button>
    </div>
    <div id="paper">
        <table width="100%">
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">
                    <h1 align="center">ใบเสร็จรับเงิน</h1>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">ร้านรับฝากเลี้ยงแมว</td>
            </tr>

            <tr>
                <td colspan="2" align="center">โทร 02-11100220</td>
            </tr>


            <tr>
                <td>ชื่อลูกค้า : <?= $full_name ?></td>
                <td width="33%" align="right">&nbsp;</td>
            </tr>
            <tr>
                <td>ที่อยู่ : <?= $address ?></td>
                <td align="right">วันรับฝาก : <?= $deposit_date ?></td>
            </tr>
            <tr>
                <td>โทร : <?= $phone ?></td>

                <td align="right">วันรับคืน : <?= $return_date_actual ?></td>
            </tr>
        </table>
        <table width="100%" class="border">
            <tr>
                <td width="30" align="center">ลำดับ </td>
                <td align="center">รายการ </td>
                <td width="200" align="center">จำนวน ( บาท )</td>
            </tr>
            <tr>
                <td align="center">1</td>
                <td>ฝากเลี้ยงแมว <?= count(json_decode($cat_id)) ?> ตัว </td>

            </tr>
            <tr>
                <td align="center">2</td>
                <td>จำนวน <?= $number_nights ?> คืน <?= $room_total_price ?> (มัดจำแล้ว <?= $deposit_price  ?>)</td>
                <td align="right"><?= ($room_total_price - $deposit_price) < 0 ? 0 : ($room_total_price - $deposit_price) ?></td>
            </tr>
            <tr>
                <td align="center">3</td>
                <td>ค่าอาหาร <?= $food_meal ?> มื้อ</td>
                <td align="right"><?= $food_total_price ?></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><b>จำนวนเงิน (<?= Convert($remaining_expenses) ?>)</b> </td>
                <td align="right"><b> <?= $remaining_expenses ?></b></td>
            </tr>
            <!-- <tr>
                <td colspan="2" align="right">รวมราคาทั้งสิน</td>
                <td align="center">หนึ่งร้อยห้าสิบบาท</td>
            </tr> -->
        </table>

        <table width="30%" align="right" style="    margin-top: 20px;">
            <tr>
                <td align="center">........................................</td>
            </tr>
            <tr>
                <td align="center">( .............................................. ) </td>
            </tr>
            <tr>
                <td align="center">ผู้รับเงิน </td>
            </tr>
        </table>

    </div>
</body>

</html>