<?php
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: " . SERVER . "/login");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?= APP_NAME ?>
  </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybVtRZT2Rp30LqU2P2kSOX3TkDOc2Cq8v6JhS+TnF1BvD0Eay" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-CB8qY0pD1bNdD7V8C6P0+t6O3H9kC9R++jLxZ0zwMmFauD8qXT2P2kn4dFCda6kj" crossorigin="anonymous"></script>
    <style>
        .navbar {
            background-color: #F6F2F1;
        }
        .logo-nav img {
            margin-left: 3%;
            width: 4%;
            height: auto;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">CatWiki</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?= SERVER ?>/dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= SERVER ?>/users">Users</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" 
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Posts
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="<?= SERVER ?>/articles">Articles</a></li>
                        <li><a class="dropdown-item" href="<?= SERVER ?>/cats">Cats</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?= SERVER ?>/usersprofile">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= SERVER ?>/login?logout=true">Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>



</body>
</html>