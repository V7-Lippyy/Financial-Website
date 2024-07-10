<?php
session_start();
require 'function/functions.php';
require 'function/loginRegister.php';

// cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    global $koneksi;
    $result = mysqli_query($koneksi, "SELECT username FROM users WHERE id_user = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION["login"])) {
    header("Location: dashboard1");
    exit;

} elseif (isset($_COOKIE['login'])) {
    header("Location: dashboard1");
    exit;
}

// login
if (isset($_POST['login'])) {
    login($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | FinansialKu</title>
    <link rel="shortcut icon" href="https://i.ibb.co.com/mGks4Ns/Desain-tanpa-judul-40.png">
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
            max-height: 430px;
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
            <div>
            </div>
            <div class="login">
                <h4><a href="register.php">LOGIN</a></h4>
            </div>
            <div class="sub-title">Login untuk gunakan FinanSialKu</div>
        </div>
        <div class="icon-user">
            <h4 class="fa fa-user"> </h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" name="user-email" class="form-control" placeholder="Username / email"
                        autocomplete="off" required>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="password" name="password-login" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label class="mz-check">
                        <input type="checkbox" name="rememberme">
                        <i class="mz-blue"></i>
                        Remember Me
                    </label>
                </div>
                <button type="submit" name="login" class="btn btn-primary" style="margin-top: -15px">Login</button>
                <div style="text-align: center; margin-top: 30px;">
                    <p>Belum mempunyai akun? <a href="register.php">Daftar disini</a></p>
                </div>
            </form>
        </div>
    </div>
    <div class="img"></div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <script src="js/slidelogin.js"></script>
</body>

</html>