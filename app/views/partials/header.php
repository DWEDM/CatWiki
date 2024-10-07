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
  <!-- waowoawoaowoaowoaw HAHSGHAHAHAHHA -->

  <link href="style.css" rel="stylesheet">
  <script href="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <!-- Popper.js (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.15/cropper.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.15/cropper.min.js"></script>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- jQuery and Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>






  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?= APP_NAME ?>
  </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
    <style>
      .navbar{
        width: 100%;
        height: 200px;
        background-color: #F6F2F1;
        overflow: hidden;
      }
      .logo-nav{
        width: auto;
        height: auto;
      }
      .logo-nav img{
        margin-left: 3%;
        width: 4%;
        height: auto;
      }
    </style>

</head>
<body>
  <div class= "navbar">
      <div class="logo-nav">
        <img src="assets/HomePage/resources/Banner.png" alt="">
      </div>
      
      <div class="navbar-links">
        <ul class="navbar-nav">
          <li><a href="">Home</a></li>
          <li><a href="<?= SERVER ?>/dashboard">Dashboard</a></li> <!--Dat admin/editor lang to-->
          <li><a href="<?= SERVER ?>/users">Users</a></li>
          <li><a href="<?= SERVER ?>/articles">Articles</a></li>
          <li><a href="<?= SERVER ?>/cats">Cats</a></li>
          <li><a href="<?= SERVER ?>/profile">Profile</a></li>
          <li><a href="<?= SERVER ?>/login?logout=true">Log Out</a></li>
        </ul>
      </div>
  </div>