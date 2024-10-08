<?php
    if (!isset($_SESSION['username'])) {
        redirect('server/login'); // Redirect to login page if not logged in
        exit();
      }
?>

<?php include "../app/views/partials/adminheader.php" ?>
<body style="background-color:gray;">
<div class="container mt-5">
    <h2>Edit Profile</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="profile_image">Profile Image</label>
            <input type="file" name="profile_image" class="form-control" accept="image/*">
        </div>
        <div class="mb-3">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($users->username) ?>" required>
        </div>
        <div class="mb-3">
            <label for="email">Password</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($users->password) ?>" required>
        </div>
        <!-- Add more fields as necessary -->
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </div>
    </form>
</div>
    
</body>
<?php include "../app/views/partials/footer.php" ?>
