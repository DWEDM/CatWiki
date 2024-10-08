<?php
session_start();

if (!isset($_SESSION['username'])) {
    $this->view("server/login");
    exit();
}
?>
<?php include "../app/views/partials/adminheader.php" ?>
<body style="background-color: gray;">
    
</body>
<?php include "../app/views/partials/footer.php" ?>