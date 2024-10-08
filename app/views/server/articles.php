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
<h1>Articles</h1>

<?php include "../app/views/partials/footer.php" ?>