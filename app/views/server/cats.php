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
    <h2>Cats</h2>
    <div>
      <button class="btn btn-secondary" id="showCats">Show Cats</button>
      <button class="btn btn-secondary" id="showBreeds">Show Breeds</button>
      <button class="btn btn-primary" data-toggle="modal" data-target="#selectAddModal">Add New</button>
    </div>
  </div>
  <div class="input-group" style="width: 250px;">
    <input type="text" id="searchInput" class="form-control" placeholder="Search Posts" aria-label="Search" onkeyup="searchUsers()">
  </div>

  <div id="catsTable" class="mt-3">
    <table class="table table-striped">
      <tr>
        <th>Cat Image</th>
        <th>Name</th>
        <th>Breed</th>
        <th>Description</th>
        <th>Actions</th>
      </tr>
      <?php if (empty($cats)) { ?>
        <tr>
          <td colspan="5" class="text-center">No Cats found! Please Add!</td>
        </tr>
      <?php } else { ?>
        <?php foreach ($cats as $catr) { ?>
            <tr>
              <td>
                <img src="<?= !empty($catr->cat_image_url) ? $catr->cat_image_url : '../assets/images/default_profile/defaultcat.png' ?>" alt="Profile Image" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid #000; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
              </td>
              <td><?= $catr->cat_name ?></td>
              <td><?= $catr->breed_id ?></td>
              <td><?= $catr->cat_description ?></td>
              <td>
                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editUserModal<?= $catr->cat_id ?>">Edit</button>
                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteUserModal<?= $catr->cat_id ?>">Delete</button>
              </td>
            </tr>
            <?php } ?>
        <?php } ?>
    </table>
  </div>

  <div id="breedsTable" class="mt-3" style="display: none;">
    <table class="table table-striped">
      <tr>
        <th>Breed Name</th>
        <th>Description</th>
        <th>Average Lifespan</th>
        <th>Size</th>
        <th>Actions</th>
      </tr>
      <?php if (empty($breeds)) { ?>
        <tr>
          <td colspan="5" class="text-center">No Breeds found! Please Add!</td>
        </tr>
      <?php } else { ?>
        <?php foreach ($breeds as $breed) { ?>
            <tr>
              <td><?= $breed->breed_name ?></td>
              <td><?= $breed->breed_description ?></td>
              <td><?= $breed->average_lifespan ?></td>
              <td><?= $breed->size ?></td>
              <td>
                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editBreedModal<?= $breed->breed_id ?>">Edit</button>
                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteBreedModal<?= $breed->breed_id ?>">Delete</button>
              </td>
            </tr>
            <?php } ?>
        <?php } ?>
    </table>
  </div>
</div>

<!-- Cat or Breed Modal -->
<div class="modal fade" id="selectAddModal" tabindex="-1" role="dialog" aria-labelledby="selectAddModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="selectAddModalLabel">Add New</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Select an option to add:</p>
        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#createCatModal">Add New Cat</button>
        <button class="btn btn-secondary btn-block" data-toggle="modal" data-target="#createBreedModal">Add New Breed</button>
      </div>
    </div>
  </div>
</div>

<!-- Add New Breed Modal -->
<div class="modal fade" id="createBreedModal" tabindex="-1" role="dialog" aria-labelledby="createBreedModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createBreedModalLabel">Add New Breed</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= SERVER ?>/createbreed" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="breedName">Breed Name</label>
            <input type="text" class="form-control" id="breedName" name="breed_name" required>
          </div>
          <div class="form-group">
            <label for="breedDescription">Description</label>
            <textarea class="form-control" id="breedDescription" name="breed_description"></textarea>
          </div>
          <div class="form-group">
            <label for="averageLifespan">Average Lifespan (years)</label>
            <input type="number" class="form-control" id="averageLifespan" name="average_lifespan">
          </div>
          <div class="form-group">
            <label for="breedSize">Size</label>
            <input type="text" class="form-control" id="breedSize" name="size">
          </div>
          <button type="submit" class="btn btn-primary">Add Breed</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Add New Cat Modal -->
<div class="modal fade" id="createCatModal" tabindex="-1" role="dialog" aria-labelledby="createCatModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createCatModalLabel">Add New Cat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= SERVER ?>/createcat" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="catName">Cat Name</label>
            <input type="text" class="form-control" id="catName" name="cat_name" required>
          </div>
          <div class="form-group">
            <label for="catImage">Cat Image URL</label>
            <input type="file" class="form-control" id="catImage" name="cat_image_url" placeholder="Enter image URL">
          </div>
          <div class="form-group">
            <label for="breedId">Breed</label>
            <select class="form-control" id="breedId" name="breed_id" required>
              <option value="">Select Breed</option>
              <?php foreach ($breeds as $breed) { ?>
                <option value="<?= $breed->breed_id ?>"><?= $breed->breed_name ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="catDescription">Description</label>
            <textarea class="form-control" id="catDescription" name="cat_description" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Add Cat</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include "../app/views/partials/footer.php" ?>

<script>
function searchUsers() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const catsRows = document.querySelectorAll('#catsTable tr:not(:first-child)');
    const breedsRows = document.querySelectorAll('#breedsTable tr:not(:first-child)');

    // Filter cats
    catsRows.forEach(row => {
        const catName = row.cells[1].textContent.toLowerCase();
        row.style.display = catName.includes(input) ? '' : 'none';
    });

    // Filter breeds
    breedsRows.forEach(row => {
        const breedName = row.cells[0].textContent.toLowerCase();
        row.style.display = breedName.includes(input) ? '' : 'none';
    });
}

document.getElementById('showCats').addEventListener('click', function() {
    document.getElementById('catsTable').style.display = 'block';
    document.getElementById('breedsTable').style.display = 'none';
});

document.getElementById('showBreeds').addEventListener('click', function() {
    document.getElementById('catsTable').style.display = 'none';
    document.getElementById('breedsTable').style.display = 'block';
});
</script>
