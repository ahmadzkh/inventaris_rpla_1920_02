<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">

    <title><?= $title; ?></title>

    <!-- My CSS -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/auth/regist.css">
</head>

<body>
    <div class="wrapper">
        <h3 class="text-center text-white">Invent 01</h3>
        <div class="form bg-dark">
            <div class="button-box">
                <div id="btn"></div>
                <a type="button" class="btn-toggle login text-decoration-none" href="/login">Login</a>
                <a type="button" class="btn-toggle register text-decoration-none" href="/register">Register</a>
            </div>
            <form action="/post-register" method="post" class="group">
                <?= csrf_field(); ?>
                <div class="mb-2">
                    <p class="card-subtitle text-white text-center">Create your account!</p>
                </div>
                <div class="input-group d-flex mb-3">
                    <input type="text" name="level" id="level" name="level"
                        placeholder="<?= ($validation->hasError('level')) ? $validation->getError('level') : 'Level'; ?>"
                        class="input text-white" required autocomplete="off">
                    <div class="input-group-append d-flex">
                        <div class="input-group-text icon d-flex">
                            <i class="fas fa-setting text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="input-group d-flex mb-3">
                    <input type="text" name="nama" id="nama" name="nama"
                        placeholder="<?= ($validation->hasError('nama')) ? $validation->getError('nama') : 'Full Name'; ?>"
                        class="input text-white" required autocomplete="off">
                    <div class="input-group-append d-flex">
                        <div class="input-group-text icon d-flex">
                            <i class="fas fa-envelope text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="input-group d-flex mb-3">
                    <input type="text" name="username" id="username" name="username"
                        placeholder="<?= ($validation->hasError('username')) ? $validation->getError('username') : 'Username'; ?>"
                        class="input text-white" required autocomplete="off">
                    <div class="input-group-append d-flex">
                        <div class="input-group-text icon d-flex">
                            <i class="fas fa-user text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="input-group d-flex mb-3">
                    <input type="password" name="password" id="password" name="password"
                        placeholder="<?= ($validation->hasError('password')) ? $validation->getError('password') : 'Password'; ?>"
                        class="input text-white" required autocomplete="off">
                    <div class="input-group-append d-flex">
                        <div class="input-group-text icon d-flex">
                            <i class="fas fa-lock text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="input-group d-flex mb-4">
                    <input type="password" name="password2" id="password2" name="password2"
                        placeholder="<?= ($validation->hasError('password2')) ? $validation->getError('password2') : 'Confirm Password'; ?>"
                        class="input text-white" required autocomplete="off">
                    <div class="input-group-append d-flex">
                        <div class="input-group-text icon d-flex">
                            <i class="fas fa-check text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="form-check w-100 mb-3">
                    <input class="form-check-input check" type="checkbox" name="agree" id="agree">
                    <label class="form-check-label text-white small" for="agree">
                        I agree to the terms & conditions
                    </label>
                </div>
                <button type="submit" class="btn btn-submit w-100">Register Account</button>
            </form>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>