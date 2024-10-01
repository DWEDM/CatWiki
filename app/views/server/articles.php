<?php
session_start();

if (!isset($_SESSION['username'])) {
    $this->view("server/login");
    exit();
}
?>
<?php include "../app/views/partials/header.php" ?>
<body style="background-color: gray;">

<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center">
    <h2>Posts</h2>
    <button class="btn btn-primary" data-toggle="modal" data-target="#createUserModal">Add New</button>
  </div>
  <div class="input-group" style="width: 250px;">
    <input type="text" id="searchInput" class="form-control" placeholder="Search Posts" aria-label="Search" onkeyup="searchUsers()">
  </div>

<table class="table table-striped mt-3">
  <tr>
    <th></th>
    <th>Title</th>
    <th>Content</th>
    <th>Breed</th>
    <th>Article</th>
    <th>Actions</th>
  </tr>
  <?php if (empty($posts)) { ?>
    <tr>
      <td colspan="6" class="text-center">No Posts found! Please Add Posts!</td>
    </tr>
  <?php } else { ?>
    <?php foreach ($posts as $rowp) { ?>
        <tr>
          <td>
            <img src="<?= !empty($rowp->image_path) ? $rowp->image_path : '../assets/images/default_profile/default.png' ?>" alt="Profile Image" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid #000; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
          </td>
          <td><?= $rowp->title ?></td>
          <td><?= $rowp->content ?></td>
          <td><?= $rowp->breed_id ?></td>
          <td><?= $rowp->article_id ?></td>
          <td>
            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editUserModal<?= $rowp->post_id ?>">Edit</button>
            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteUserModal<?= $rowp->post_id ?>">Delete</button>
          </td>
        </tr>
        <?php } ?>
    <?php } ?>
</table>
</div>
<?php include "../app/views/partials/footer.php" ?>