<?php
$error = $style = '';
/* if session exist */
if (isset($_SESSION['userBean'])) {
    $_POST = $_POST ?? null;
    $_GET = $_GET ?? null;
    header('Location: /home');
    exit();
}

/* user login case */
if (isset($_POST['userName']) && isset($_POST['userPassword'])) {
    $name = _E($_POST['userName']);
    $pass = _E($_POST['userPassword']);

    $user = R::findOne(USERS, "user_name = ?", [$name]);
    if ($user && password_verify($pass, $user['user_hash'])) {
        $_SESSION['userBean'] = $user;

        header("Location: /home");
        exit();
    } else {
        $error = 'Password or Name incorrect. Please try again!';
    }
}

/* user registration case */
if (isset($_POST['regUserName']) && isset($_POST['regUserPassword']) && isset($_POST['adminPassword'])) {
    $name = _E($_POST['regUserName']);
    $pass = _E($_POST['regUserPassword']);
    $adminPass = _E($_POST['adminPassword']);
    $role = _E($_POST['role']) ?? 'user';
    $jobrole = _E($_POST['regJobRole']) ?? 'worker';

    // add your password verifications!!!!!
    if ($adminPass == 'some-admin-pass') {

        $user = R::findOrCreate(USERS, ['user_name' => $name]);

        // password_verify this is standard PHP method read about here
        // https://www.php.net/manual/en/function.password-verify.php
        if (empty($user['user_hash']) && !password_verify($pass, $user['user_hash'])) {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $user->user_hash = $hash;
            $user->date_in = date("Y-m-d h:i");
            $user->job_role = $jobrole;
            $user->app_role = $role;
            R::store($user);
            $style = 'success';
            $error = 'Registration complite! Please login for work.';
        } else {
            $_SESSION['userBean'] = $user;
            header("Location: /home");
            exit();
        }
    } else {
        $style = 'danger';
        $error = 'Registration error Some Data wrong!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<!--suppress HtmlRequiredTitleElement -->
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="your-icon">
    <title>Login</title>
    <!--  Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--  Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .eye-box {
            position: relative;
        }

        .eye {
            position: absolute;
            top: 56%;
            right: 5%;
        }
    </style>
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">

<div class="container">
    <div class="row">
        <h4 class="text-<?= $style; ?> text-center mb-4"><?= $error; ?></h4>
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div id="registration-form" style="display: none;">
                        <h5 class="card-title text-center mb-4">Sign Up</h5>

                        <form action="/" method="post">
                            <div class="mb-3">
                                <label for="regUsername" class="form-label">Name</label>
                                <input type="text" class="form-control" id="regUsername" name="regUserName" required>
                            </div>

                            <div class="mb-3">
                                <label for="regJobRole" class="form-label">Job Role</label>
                                <input type="text" class="form-control" id="regJobRole" name="regJobRole">
                            </div>

                            <div class="mb-3 eye-box">
                                <label for="regUserPassword" class="form-label">Password</label>
                                <input type="password" class="form-control pi" id="regUserPassword" name="regUserPassword" required>
                                <i class="bi bi-eye eye" onclick="tpv()"></i>
                            </div>

                            <div class="mb-3 eye-box">
                                <label for="adminPassword" class="form-label">Admin password</label>
                                <input type="password" class="form-control pi" id="adminPassword" name="adminPassword" required>
                                <i class="bi bi-eye eye" onclick="tpv()"></i>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="userRole" value="user" checked>
                                    <label class="form-check-label" for="userRole">
                                        User
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="adminRole" value="admin">
                                    <label class="form-check-label" for="adminRole">
                                        Admin
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="clientRole" value="client">
                                    <label class="form-check-label" for="clientRole">
                                        Client
                                    </label>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success form-control">Sign Up</button>
                            </div>
                        </form>

                        <hr>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary form-control" id="switchToLogin">Login</button>
                        </div>
                    </div>

                    <div id="login-form">
                        <h5 class="card-title text-center mb-4">Login</h5>
                        <form action="/" method="post">
                            <div class="mb-3">
                                <label for="loginUsername" class="form-label">Name</label>
                                <input type="text" class="form-control" id="loginUsername" name="userName" required>
                            </div>
                            <div class="mb-3 eye-box">
                                <label for="loginPassword" class="form-label">Password</label>
                                <input type="password" class="form-control pi" id="loginPassword" name="userPassword" required>
                                <i class="bi bi-eye eye" onclick="tpv()"></i>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success form-control">Login</button>
                            </div>
                        </form>
                        <hr>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary form-control" id="switchToRegistration">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        // reg form switch
        $("#switchToRegistration").click(function () {
            $("#registration-form").show();
            $("#login-form").hide();
        });

        // login form switch
        $("#switchToLogin").click(function () {
            $("#registration-form").hide();
            $("#login-form").show();
        });
    });

    function tpv() {
        let pii = document.querySelectorAll(".pi");
        pii.forEach(function (pi) {
            if (pi.type === "password") {
                pi.type = "text";
            } else {
                pi.type = "password";
            }
        });
    }
</script>
</body>
</html>
