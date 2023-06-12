<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBook App | <?= $title ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url() ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>dist/css/adminlte.min.css">

    <style>
        body {
            padding-top: 56px;
        }

        .login-register {
            display: flex;
            align-items: center;
        }

        .login-register a {
            margin-right: 10px;
        }

        .footer {
            height: 75px;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            flex-direction: column;
        }

        .title {
            display: flex;
            width: 100%;
            height: 70vh;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        /* Hide profile image container for smaller screens */
        @media (max-width: 988px) {
            .profile-image-container {
                display: none;
            }

            .navbar-toggler-icon {
                color: white;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="/">MyBook App</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-light" href="<?= route_to('home') ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="<?= route_to('about_me') ?>">About Me</a>
                </li>
                <?php if ($isLoggedIn) : ?>
                    <?php $user = service('authentication')->user(); ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= esc($user->username) ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?= route_to('profile') ?>">Profile</a>
                            <a class="dropdown-item" href="<?= route_to('logout') ?>">Logout</a>
                        </div>
                    </li>
                    <li class="nav-item profile-image-container">
                        <div style="width: 50px;height:50px;clip-path:circle();background:url(<?= base_url('../../uploads/profiles/' . $user->img) ?>);background-position:top;background-size:cover;" alt="Profile Photo"></div>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= route_to('login') ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= route_to('register') ?>">Registrasi</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12 text-center">
                <?php if ($isLoggedIn) : ?>
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <?= $this->renderSection('content') ?>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="title">
                        <h2>Selamat datang di MyBook App!</h2>
                        <h4><i>"Bacalah buku dan biarkan pikiranmu terbang bebas."</i></h4>
                    </div>

                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer bg-dark fixed-bottom">
        <span class="text-muted">MyBook App &copy; 2023</span>
        <span class="text-muted">App by Niko Saputra</span>
    </footer>

    <!-- jQuery -->
    <script src="<?= base_url() ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>dist/js/adminlte.min.js"></script>

</body>

</html>