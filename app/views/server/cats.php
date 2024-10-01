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
        <th>Cat Profile</th>
        <th>Name</th>
        <th>Breed</th>
        <th>Description</th>
        <th>Cat Images</th>
        <th>Actions</th>
      </tr>
      <?php if (empty($cats)) { ?>
        <tr>
          <td colspan="6" class="text-center">No Cats found! Please Add!</td>
        </tr>
      <?php } else { ?>
        <?php foreach ($cats as $catr) { ?>
            <tr>
              <td>
                <img src="<?= !empty($catr->cat_profile) ? $catr->cat_profile : '../assets/images/default_profile/defaultcat.png' ?>" alt="Profile Image" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid #000; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
              </td>
              <td><?= $catr->cat_name ?></td>
              <td>
                <?php
                // Find the breed name corresponding to the breed_id
                $breedName = '';
                foreach ($breeds as $breed) {
                    if ($breed->breed_id == $catr->breed_id) {
                        $breedName = $breed->breed_name;
                        break; // Exit the loop once found
                    }
                }
                echo $breedName;
                ?>
              </td>
              <td><?= $catr->cat_description ?></td>
              <td>
                <img src="<?= !empty($catr->cat_image_url) ? $catr->cat_image_url : '../assets/images/default_profile/defaultcat.png' ?>" alt="Cat Image" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid #000; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
              </td>
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
            <label for="catProfileImage">Cat Profile Image</label>
            <input type="file" class="form-control" id="catProfileImage" name="cat_profile_image" accept="image/*" onchange="previewProfileImage(event)">
          </div>
          <div id="profileImagePreview" style="margin-top: 10px;">
            <img id="profileImage" src="../assets/images/default_profile/defaultcat.png" alt="Profile Image Preview" style="width: 100px; height: auto;"/>
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
            <label for="catImage">Cat Related Images</label>
            <input type="file" class="form-control" id="catImage" name="cat_image_url[]" accept="image/*" multiple onchange="previewImages(event)">
          </div>
          <div id="imagePreviews" style="display: flex; flex-wrap: wrap; margin-top: 10px;">
            <img id="imagePreview" src="../assets/images/default_profile/defaultcat.png" alt="Image Preview" style="width: 100px; height: auto; margin-right: 10px;"/>
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
document.getElementById('showCats').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    document.getElementById('catsTable').style.display = 'block';
    document.getElementById('breedsTable').style.display = 'none';
});

document.getElementById('showBreeds').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    document.getElementById('catsTable').style.display = 'none';
    document.getElementById('breedsTable').style.display = 'block';
});


function previewImages(event) {
    const imagePreviewsContainer = document.getElementById('imagePreviews');
    imagePreviewsContainer.innerHTML = ''; // Clear previous previews

    if (event.target.files) {
        Array.from(event.target.files).forEach(file => {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.style.width = '100px';
            img.style.height = 'auto';
            img.style.marginRight = '10px';
            imagePreviewsContainer.appendChild(img);
        });
    } else {
        // Show default image if no file selected
        const defaultImg = document.createElement('img');
        defaultImg.src = '../assets/images/default_profile/defaultcat.png';
        defaultImg.style.width = '100px';
        defaultImg.style.height = 'auto';
        imagePreviewsContainer.appendChild(defaultImg);
    }
}

function previewProfileImage(event) {
    const profileImagePreview = document.getElementById('profileImage');
    if (event.target.files && event.target.files[0]) {
        profileImagePreview.src = URL.createObjectURL(event.target.files[0]);
    } else {
        profileImagePreview.src = '../assets/images/default_profile/defaultcat.png'; // Reset to default
    }
}
$(document).ready(function() {
    // Optional: Any custom logic when modals are opened
    $('.modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var modal = $(this);
        // You can perform actions here if needed
    });
});
</script>
