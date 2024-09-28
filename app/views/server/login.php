<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card" style="width: 300px;">
        <div class="card-body">
            <h5 class="card-title text-center">Login</h5>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
                <?php if (isset($error)): ?>
                    <div class="mt-2 text-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>
</body>
</html>
