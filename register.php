<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    
    <style>
        body {
        font-family: Bai Jamjuree;
    }
    </style>
    </head>

<body>

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-7 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-7 d-none d-lg-block loginbg"></div>
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">สมัครสมาชิก</h1>
                                    </div>

                                    <form action="insert_register.php" method="POST">
                                        username <input type="text" name="username" class="form-control" required>
                                        password <input type="password" name="password" maxlength="6"
                                            class="form-control" required>
                                        ชื่อ <input type="text" name="name" class="form-control" required>
                                        นามสกุล <input type="text" name="lastname" class="form-control" required>
                                        เลขบัตรประชาชน <input type="text" name="id_card" maxlength="13"
                                            class="form-control" required>
                                        ที่อยู่ <input type="text" name="address" class="form-control" required>
                                        เบอร์โทรศัพท์ <input type="text" name="phone" maxlength="10"
                                            class="form-control" required>

                                         
                                        <div class="mt-2">
                                            <input type="submit" name="submit" value="บันทึก" class="btn btn-primary">
                                            <a href="loginform.php" class="btn btn-danger">ยกเลิก</a> <br>
                                        </div>

                                        <div class="mt-2">
                                            ลงทะเบียนแล้ว <a href="loginform.php">เข้าสู่ระบบ</a>
                                        </div>
                                        


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        </form>
    </div>
</body>

</html>