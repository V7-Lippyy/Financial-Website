<?php
session_start();
require 'function/functions.php';
require 'function/loginRegister.php';

// register
if (isset($_POST['sign-up'])) {
    if (register($_POST) > 0) {
        echo "
            <script>
                swal('Berhasil','Akun anda berhasil didaftarkan!','success');
            </script>
        ";
    } else {
        echo mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="https://i.ibb.co.com/mGks4Ns/Desain-tanpa-judul-40.png">
    <title>Register | FinansialKu</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <style>
        body {
            background: url('https://i.ibb.co.com/cxMtsPW/Desain-tanpa-judul-29.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: "roboto", sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.6);
            /* White background with 70% transparency */
            z-index: 2;
            position: relative;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.9);
            max-width: 400px;
            /* Limit the width of the card */
            max-height: 480px;
            width: 100%;
        }

        .img {
            background: url('');
            /* Specify a valid background image URL if needed */
            background-size: cover;
            background-position: center;
            height: 100%;
            width: 100%;
            position: absolute;
            z-index: 1;
            top: 0;
            left: 0;
        }

        .card-header .sub-title {
            display: block;
            /* Ensure the subtitle is on a new line */
            margin-top: 10px;
            /* Add some spacing from the previous elements */
        }

        .card-header {
            text-align: center;
            /* Center align the header content */
        }

        .icon-user {
            text-align: center;
            /* Center align the user icon */
            margin-bottom: 15px;
            /* Add some space below the icon */
        }

        .input-group {
            margin-bottom: 15px;
            /* Reduce spacing between input groups */
        }

        .btn {
            width: 100%;
            /* Make the button take the full width */
        }
    </style>
</head>

<body>
    <div class="img"></div>
    <div class="card">
        <div class="card-header">
            <div class="signup">
                <h4 class="aktif">SIGN UP</h4>
            </div>
            <div class="sub-title">Registrasi untuk gunakan FinansialKu</div>
        </div>
        <div class="icon-user">
            <h4 class="fa fa-user"> </h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    </div>
                    <input type="text" name="email-registrasi" class="form-control" placeholder="Email"
                        autocomplete="off" required>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" name="username-registrasi" class="form-control" placeholder="Username"
                        autocomplete="off" required>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="password" name="password-registrasi" class="form-control" placeholder="Password"
                        autocomplete="off" required>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="password" name="password-confirm" class="form-control" placeholder="Confirm password"
                        autocomplete="off" required>
                </div>
                <button type="submit" name="sign-up" class="btn btn-primary">Sign up</button>
                <div style="text-align: center; margin-top: 30px;">
                    <p>Sudah mempunyai akun? <a href="login.php">Login disini</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>