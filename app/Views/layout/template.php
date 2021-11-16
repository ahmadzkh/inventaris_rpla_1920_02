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
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <div class="wrapper">
        <!-- Main Header Start -->
        <nav class="navbar shadow navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="/dashboard"><img src="/assets/img/logo.png" alt="" width="60"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto me-auto">
                        <a class="nav-link text-white mx-3" aria-current="page" href="/dashboard">Home</a>
                        <a class="nav-link text-white mx-3" href="/dashboard/stuffs">Stuffs</a>
                        <a class="nav-link text-white mx-3" href="/dashboard/stuffs/output">Output</a>
                        <a class="nav-link text-white mx-3" href="/dashboard/stuffs/stock">Stock</a>
                    </div>
                    <div class="navbar-nav me-5">
                        <a class="nav-link text-white ms-auto me-auto"
                            href="/dashboard/users"><?= session()->nama; ?></a>
                    </div>
                    <?php if (session()->logged_in) : ?>
                    <div class="navbar-nav">
                        <a href="/logout" class="btn btn-danger">LOGOUT</a>
                    </div>
                    <?php endif; ?>
                    <?php if (!session()->logged_in) : ?>
                    <div class="navbar-nav">
                        <a href="/login" class="btn btn-danger">LOGIN</a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
        <!-- End Main Header -->

        <!-- Content Start -->
        <div class="content">
            <?= $this->renderSection('content'); ?>
        </div>
        <!-- End Content -->

        <div class="footer text-white my-4">
            <hr>
            <p class="text-center">Created by Team 3</p>
        </div>

    </div>
    <!-- End Wrapper -->

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

    <script>
    function toggleMenu() {
        let toggle = document.querySelector('.toggle');
        let navigation = document.querySelector('.navigation');
        let main = document.querySelector('.main');
        let content = document.querySelector('.content');

        toggle.classList.toggle('active');
        navigation.classList.toggle('active');
        main.classList.toggle('active');
        content.classList.toggle('active');
    }

    function dropdownUsers() {
        let users = document.querySelector('.users');

        users.classList.toggle('active');
    }

    function dropdownItems() {
        let items = document.querySelector('.stuffs');

        items.classList.toggle('active');
    }

    function dropdownProfile() {
        let profile = document.querySelector('.profile');

        profile.classList.toggle('active');
    }
    </script>
</body>

</html>