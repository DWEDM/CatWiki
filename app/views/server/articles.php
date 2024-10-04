<?php
session_start();

if (!isset($_SESSION['username'])) {
    $this->view("server/login");
    exit();
}
?>
<?php include "../app/views/partials/header.php" ?>
<body style="background-color: gray;">


<?php include "../app/views/partials/footer.php" ?>