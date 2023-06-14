<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>รายงานค่าห้องพักและค่าอาหาร</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
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
        @media print {
            @page {
                size: A4;
                width: 100%;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div id="paper">
        <table width="100%">
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3 align="center">รายงานค่าห้องพักและค่าอาหาร</h1>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">ร้านรับฝากเลี้ยงแมว</td>
            </tr>

            <tr>
                <td colspan="2" align="center">โทร 02-11100220</td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td style="height: 60px;">ตั้งแต่วันที่ <?= $_GET['start_date'] ?></td>
                <td style="height: 60px;">ถึงวันที่ <?= $_GET['end_date'] ?></td>
            </tr>
        </table>
        <table width="100%" class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align: center;">bill id</th>
                    <th style="text-align: center;">ชื่อลูกค้า</th>
                    <th style="text-align: center;">วันที่ทำรายการ</th>
                    <th style="text-align: center;">ค่าห้องพัก</th>
                    <th style="text-align: center;">ค่าอาหาร</th>
                    <th style="text-align: center;">รวม</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $c = mysqli_connect("localhost", "root", "", "cat");
                mysqli_query($c, "SET NAMES UTF8");

                $sql1 = " SELECT * FROM return_cat WHERE duo_datetime BETWEEN  '" .  $_GET['start_date'] . "' AND '" .  $_GET['end_date'] . "' ORDER BY id DESC";
                // echo $sql1;
                $q1 = mysqli_query($c, $sql1);

                $room_total_price  = 0;
                $food_total_price  = 0;

                while ($f = mysqli_fetch_assoc($q1)) {
                    //=============
                    $room_number = "";
                    $sql4 = " SELECT * FROM deposit WHERE bill_id = {$f['bill_id_deposit']} GROUP BY bill_id";
                    $q4 = mysqli_query($c, $sql4);
                    while ($ca = mysqli_fetch_assoc($q4)) {
                        $room_number = $ca["room_number"];
                    }
                    //=============
                    $room_price = "";
                    $sql3 = " SELECT * FROM room WHERE id = " . $room_number . "";
                    $q3 = mysqli_query($c, $sql3);
                    while ($ca = mysqli_fetch_assoc($q3)) {
                        $room_price = $ca["roomprice"] * $f['number_nights'];
                    }
                    //=============
                    $user_name = "";
                    $sql3 = " SELECT * FROM user WHERE id = " . $f['user_id'] . "";
                    $q3 = mysqli_query($c, $sql3);
                    while ($ca = mysqli_fetch_assoc($q3)) {
                        $user_name = $ca["name"] . "  " . $ca["lastname"];
                    }

                    //=============
                ?>
                    <tr>
                        <td style="text-align: center;"><?= $f['bill_id'] ?></td>
                        <td style="text-align: center;"><?= $user_name ?></td>
                        <td style="text-align: center;"><?= $f['duo_datetime'] ?></td>
                        <td style="text-align: center;"><?= $room_price ?></td>
                        <td style="text-align: center;"><?= $f['total_food_price'] ?></td>
                        <td style="text-align: center;"><?= $f['total_food_price'] + $room_price  ?></td>
                    </tr>

                <?php
                    $room_total_price = $room_total_price + $room_price;
                    $food_total_price = $food_total_price + $f['total_food_price'];
                }

                mysqli_close($c);
                ?>
                  <tr>
                            <td style="text-align: center;" colspan="3">รวม</td>
                            <td style="text-align: center;"><?= $room_total_price ?></td>
                            <td style="text-align: center;"><?= $food_total_price ?></td>
                            <td style="text-align: center;"><?= $food_total_price + $room_total_price ?></td>
                        </tr>
            </tbody>
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