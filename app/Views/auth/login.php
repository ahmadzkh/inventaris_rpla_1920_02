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

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;800;900&display=swap');
    </style>

    <title><?= $title; ?></title>

    <!-- My CSS -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/auth/login.css">
</head>

<body>
    <div class="container">
        <div class="content">
            <div class="row mb-3">
                <div class="col-sm">
                    <p class="h1 fw-bolder text-white m-0 p-0">Inventaris</p>
                    <p class="text-secondary fw-bolder p-0 m-0">SMKN 1 KOTA BEKASI</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <form action="/post-login" method="post" class="w-100">
                        <?= csrf_field(); ?>
                        <div class="mb-3">
                            <p class="card-subtitle text-white text-center">
                                <?= (session()->getFlashdata('pesan')) ? '<p class="card-subtitle text-center text-danger">' . session()->getFlashdata('pesan') . '</p>' : 'Please login your account!'; ?>
                            </p>
                        </div>
                        <div class="input-group d-flex mb-4">
                            <input type="text" name="username" id="username" name="username"
                                placeholder="<?= ($validation->hasError('username')) ? $validation->getError('username') : 'Username'; ?>"
                                class="input text-white" autocomplete="off">
                        </div>
                        <div class="input-group d-flex mb-4">
                            <input type="password" name="password" id="password" name="password"
                                placeholder="<?= ($validation->hasError('password')) ? $validation->getError('password') : 'Password'; ?>"
                                class="input text-white" autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-submit w-100 my-3">Login</button>
                    </form>
                </div>
            </div>
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