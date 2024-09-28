<?php
session_start();

if (!isset($_SESSION['username'])) {
    $this->view("server/login");
    exit();
}
?>
<?php include "../app/views/partials/header.php" ?>
<body style="background-color:gray;">

<div class="container mt-5">

  <div class="d-flex justify-content-between align-items-center">
    <h2>Users</h2>
    <button class="btn btn-primary" data-toggle="modal" data-target="#createUserModal">Add New</button>
  </div>
  <div class="input-group" style="width: 250px;">
    <input type="text" id="searchInput" class="form-control" placeholder="Search by username or email" aria-label="Search" onkeyup="searchUsers()">
  </div>

  <table class="table table-striped mt-3">
    <tr>
      <th>Profile</th>
      <th>Username</th>
      <th>Email</th>
      <th>Role</th>
      <th>Date Created</th>
      <th>Actions</th>
    </tr>
    <?php if (empty($users)) { ?>
      <tr>
        <td colspan="6" class="text-center">No users found! Please Add User!</td>
      </tr>
    <?php } else { ?>
      <?php foreach ($users as $row) { ?>
        <tr>
          <td>
            <img src="<?= !empty($row->profile) ? $row->profile : '../assets/images/default_profile/default.png' ?>" alt="Profile Image" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid #000;">
          </td>
          <td><?= $row->username ?></td>
          <td><?= $row->email ?></td>
          <td><?= $row->role ?></td>
          <td><?= $row->date_created ?></td>
          <td>
            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editUserModal<?= $row->user_id ?>">Edit</button>
            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteUserModal<?= $row->user_id ?>">Delete</button>
          </td>
        </tr>

        <!-- Edit User Modal -->
        <div class="modal fade" id="editUserModal<?= $row->user_id ?>" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="<?= SERVER ?>/edit/<?= $row->user_id ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="mb-2 text-center">
                    <img id="editImagePreview<?= $row->user_id ?>" src="<?= !empty($row->profile) ? $row->profile : '../assets/images/default_profile/default.png' ?>" alt="Profile Image" style="width: 100px; height: 100px; border-radius: 50%; border: 2px solid #000;">
                    <br>
                    <button type="button" class="btn btn-danger btn-sm mt-2" onclick="removeProfileImage('editImagePreview<?= $row->user_id ?>')">Remove</button>
                  </div>
                  <div>
                    <label for="profile_image">Profile Image</label>
                    <input type="file" name="edit_profile" class="form-control" accept="image/*" onchange="previewEditImage(event, 'editImagePreview<?= $row->user_id ?>')">
                  </div>
                  <div class="mb-2">
                    <label for="">Username</label>
                    <input type="text" name="username" value="<?= $row->username ?>" class="form-control">
                  </div>
                  <div class="mb-2">
                    <label for="Email">Email</label>
                    <input type="text" name="email" value="<?= $row->email ?>" class="form-control">
                  </div>
                  <div class="mb-2">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control">
                      <option value="Select" disabled <?= $row->role ? '' : 'selected' ?>>--Select--</option>
                      <option value="Admin" <?= $row->role == 'Admin' ? 'selected' : '' ?>>Admin</option>
                      <option value="Editor" <?= $row->role == 'Editor' ? 'selected' : '' ?>>Editor</option>
                      <option value="User" <?= $row->role == 'User' ? 'selected' : '' ?>>User</option>
                    </select>
                  </div>
                  <div class="mb-2">
                    <label for="Password">Password</label>
                    <input type="password" name="password" id="editPassword<?= $row->user_id ?>" class="form-control" value="<?= $row->password ?>">
                    <div class="form-check mt-2">
                      <input type="checkbox" class="form-check-input" id="showPasswordEdit<?= $row->user_id ?>" onclick="togglePasswordEdit(<?= $row->user_id ?>)">
                      <label class="form-check-label" for="showPasswordEdit<?= $row->user_id ?>">Show Password</label>
                    </div>
                  </div>
                  <div class="mb-2">
                    <label for="task_due">Date Created</label>
                    <input type="date" name="date_created" value="<?= $row->date_created ?>" class="form-control" readonly>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Modal for Deleting User -->
        <div class="modal fade" id="deleteUserModal<?= $row->user_id ?>" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="<?= SERVER ?>/delete/<?= $row->user_id ?>" method="POST">
                <div class="modal-body text-center">
                  <img src="<?= !empty($row->profile) ? $row->profile : '../assets/images/default_profile/default.png' ?>" alt="Profile Image" style="width: 100px; height: 100px; border-radius: 50%; border: 2px solid #000;">
                  <p>Are you sure you want to delete this user?</p>
                  <p><strong>Username:</strong> <?= $row->username ?></p>
                  <p><strong>Email:</strong> <?= $row->email ?></p>
                  <p><strong>Role:</strong> <?= $row->role ?></p>
                  <p><strong>Date Created:</strong> <?= $row->date_created ?></p>
                  <input type="hidden" name="id" value="<?= $row->user_id ?>">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-danger">Delete</button>
                </div>
              </form>
            </div>
          </div>
        </div>

      <?php } ?>
    <?php } ?>
  </table>
</div>

<!-- Modal for Creating a User -->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createUserModalLabel">Create User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= SERVER ?>/create" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="mb-2 text-center">
            <img id="imagePreview" src="../assets/images/default_profile/default.png" alt="Profile Preview" style="width: 100px; height: 100px; border-radius: 50%; border: 2px solid #000;">
          </div>
          <div>
            <label for="profile_image">Profile Image</label>
            <input type="file" name="input_profile" class="form-control" accept="image/*" onchange="previewImage(event)">
          </div>
          <div class="mb-2">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" required>
          </div>
          <div class="mb-2">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="mb-2">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
            <div class="form-check mt-2">
              <input type="checkbox" class="form-check-input" id="showPasswordCreate" onclick="togglePasswordCreate()">
              <label class="form-check-label" for="showPasswordCreate">Show Password</label>
            </div>
          </div>
          <div class="mb-2">
            <label for="role">Role:</label>
            <select name="role" id="role" class="form-control" required>
              <option value="" disabled selected>--Select Role--</option>
              <option value="Admin">Admin</option>
              <option value="Editor">Editor</option>
              <option value="User">User</option>
            </select>
          </div>
          <div class="mb-2">
            <label for="date_created">Date Created</label>
            <input type="date" name="date_created" class="form-control" required value="<?= date('Y-m-d') ?>" readonly>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Create</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function previewImage(event) {
    const imagePreview = document.getElementById('imagePreview');
    if (event.target.files && event.target.files[0]) {
        imagePreview.src = URL.createObjectURL(event.target.files[0]);
        imagePreview.onload = function() {
            URL.revokeObjectURL(imagePreview.src);
        };
    } else {
        // If no file is selected, revert to default
        imagePreview.src = '../assets/images/default_profile/default.png';
    }
  }

  function previewEditImage(event, previewElementId) {
    const imagePreview = document.getElementById(previewElementId);
    if (event.target.files && event.target.files[0]) {
        imagePreview.src = URL.createObjectURL(event.target.files[0]);
        imagePreview.onload = function() {
            URL.revokeObjectURL(imagePreview.src);
        };
    } else {
        // If no file is selected, revert to default
        imagePreview.src = '../assets/images/default_profile/default.png';
    }
  }
  function removeProfileImage(previewElementId) {
    const imagePreview = document.getElementById(previewElementId);
    imagePreview.src = '../assets/images/default_profile/default.png'; // Set to default image
  }

  function togglePasswordCreate() {
    const passwordInput = document.getElementById('password');
    passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
  }

  function togglePasswordEdit(userId) {
    const passwordInput = document.getElementById('editPassword' + userId);
    passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
  }
  function searchUsers() {
  const input = document.getElementById('searchInput');
  const filter = input.value.toLowerCase();
  const table = document.querySelector('.table');
  const rows = table.getElementsByTagName('tr');

  for (let i = 1; i < rows.length; i++) { // Start from 1 to skip the header
    const cells = rows[i].getElementsByTagName('td');
    let found = false;

    // Check username and email columns (index 1 and 2)
    if (cells.length > 1) {
      const username = cells[1].textContent || cells[1].innerText;
      const email = cells[2].textContent || cells[2].innerText;

      if (username.toLowerCase().indexOf(filter) > -1 || email.toLowerCase().indexOf(filter) > -1) {
        found = true;
      }
    }

    rows[i].style.display = found ? "" : "none"; // Show or hide the row based on the search
  }
}

</script>

<?php include "../app/views/partials/footer.php" ?>
