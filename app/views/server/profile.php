<?php include "../app/views/partials/header.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Example of a simple profile form -->
     <form action="update_profile.php" method="POST">
        <input type="hidden" name="username" value="<?= htmlspecialchars($users['username']) ?>">
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($users['password']) ?>" required>
        <br>
        <label for="role">Role:</label>
        <input type="text" name="role" value="<?= htmlspecialchars($users['role']) ?>" readonly>
        <br>
        <button type="submit">Update Profile</button>
    </form>
