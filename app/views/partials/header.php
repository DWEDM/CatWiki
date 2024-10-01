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
  
    <style>
      .navbar{
        width: 100%;
        height: 100px;
        background-color: #F6F2F1;
        overflow: hidden;
      }
      .logo-nav{
        width: auto;
        height: auto;
      }
      .logo-nav img{
        width: auto;
        height: 8%;
      }
    </style>

</head>
<body>
  <div class= "navbar">
      <div class="logo-nav">
        <img src="assets/HomePage/resources/Banner.png" alt="">
      </div>
  </div>
</body>
