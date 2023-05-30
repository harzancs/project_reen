<?php
session_start();
?>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <style>
        .loginbg {
            background-image: url("image/cat2.jpg");
            background-size: 90% 90%;
            background-position: center;
            background-repeat: no-repeat;
        }

        body {
            font-family: 'Chakra Petch', sans-serif;
        }

        .form-group i {
            position: absolute;
            right: 4%;
            top: 35%;
        }

        .form-group p {
            position: absolute;
            right: 4%;
            top: 35%;
        }
    </style>

</head>

<body class="bg-gradient-white">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block loginbg"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">เข้าสู่ระบบ</h1>
                                    </div>

                                    <form action="logindb.php" class="form-floating" method="post" enctype="multipart/form-data">
                                        <?php
                                        if (isset($_SESSION['success'])) { ?>
                                            <div class="alert alert-success" role="alert">
                                                <?php
                                                echo $_SESSION['success'];
                                                unset($_SESSION['success']);
                                                ?>
                                            </div>
                                        <?php } ?>

                                        <?php
                                        if (isset($_SESSION['error'])) { ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?php
                                                echo $_SESSION['error'];
                                                unset($_SESSION['error']);
                                                ?>
                                            </div>
                                        <?php } ?>

                                        <div class="form-group">
                                            <input type="text" class="form-control" name="username" placeholder="ผู้ใช้" oninvalid="setCustomValidity('กรุณาป้อนผู้ใช้')" maxlength="10" oninput="setCustomValidity('')" required>

                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" placeholder="รหัสผ่าน" oninvalid="setCustomValidity('กรุณาป้อนรหัสผ่าน')" maxlength="6" oninput="setCustomValidity('')" required id="id_password">
                                            <i class="far fa-eye" style=" margin-left: -20px; cursor: pointer;" id="togglePassword"></i>
                                        </div>
                                       <!--  <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember</label>
                                            </div>
                                        </div> -->
                                        <div class="form-group">
                                            <button type="submit" id="submit" class="btn btn-orange btn-user btn-block" name="login_state">เข้าสู่ระบบ</button>
                                            <a href="index.php" class="btn btn-secondary btn-user btn-block">กลับ</a>
                                        </div>
                                        <div class="text-center">
                                        ยังไม่ลงทะเบียน<a class="container" href="register.php" >ลงทะเบียน</a>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- <a href="index.php?logout='1'"> <i class='bx bx-log-out'  id="log_out" ></i> </a> -->


    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#id_password');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>