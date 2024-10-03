<?php

class Server extends Controller
{
  public function index()
  {
    session_start();

    if (isset($_SESSION['username'])) {
        $this->view('server/dashboard');
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $text_username = $_POST['username'];
        $text_password = $_POST['password'];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "catwiki_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Update the query to also fetch the user's role
        $query = "SELECT * FROM users WHERE username='$text_username' AND password='$text_password'";
        $result = $conn->query($query);

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $_SESSION['username'] = $text_username;
            $_SESSION['role'] = $user['role']; // Assuming 'role' is the column name in your users table

            // Check the user's role
            if ($_SESSION['role'] === 'Admin' || $_SESSION['role'] === 'Editor') {
                $this->view('server/dashboard');
                exit();
            } else {
                echo '<script type="text/javascript">';
                echo 'alert("Access denied: Not Permitted");';
                echo '</script>';
                $this->view('server/login');
                exit();
            }
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Invalid Username or Password");';
            echo '</script>';
            $this->view('server/login');
            exit();
        }

        $conn->close();
    }

    $this->view('server/login');
  }

  public function dashboard()
  {

    $this->view('server/dashboard');
  }
  public function users()
  {
    $users = new User();
    $data = $users->findAll();

    $this->view('server/users', [
      'users' => $data
    ]);
  }

  public function create()
  {
    $x = new User();

    if (count($_POST) > 0) {
        if ($_FILES['input_profile']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../public/assets/images/users_profile/';
            $uniqueFilename = uniqid('image_') . '_' . $_FILES['input_profile']['name'];
            $uploadFile = $uploadDir . $uniqueFilename;

            if (move_uploaded_file($_FILES['input_profile']['tmp_name'], $uploadFile)) {
                $relativeFilePath = str_replace('/public', '', $uploadFile);
                $_POST['profile'] = $relativeFilePath;
            } else {
                echo "Error uploading file.";
                exit;
            }
        }
        $x->insert($_POST);
        redirect('server/users');
    }

    $this->view('server/create');
  }

  public function edit($user_id)
  {
    $x = new User();
        $arr['user_id'] = $user_id;
        $data = $x->first($arr);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postData = $_POST;

            // Check if a new profile image is uploaded
            if (isset($_FILES['edit_profile']) && $_FILES['edit_profile']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../public/assets/images/users_profile/'; // Specify your upload directory
                $uploadFile = $uploadDir . basename($_FILES['edit_profile']['name']);

                // Move the uploaded file to the desired directory
                if (move_uploaded_file($_FILES['edit_profile']['tmp_name'], $uploadFile)) {
                    $relativeFilePath = str_replace('/public', '', $uploadFile);
                    $postData['profile'] = $relativeFilePath;
                } else {
                    // Handle the error of moving the file
                    // Optionally, set an error message to be displayed to the user
                }
            }

            $x->update_user($user_id, $postData);

            redirect('server/users');
        }

        $this->view('server/edit', [
            'row' => $data
        ]);
  }

  public function delete($user_id)
  {
    $x = new User();
    $arr['user_id'] = $user_id;
    $data = $x->first($arr);

    if (count($_POST) > 0) {

      $x->delete_user($user_id);

      redirect('server/users');
    }

    $this->view('server/delete', [
      'row' => $data
    ]);
  }
  public function article()
  {
    $posts = new Article();
    $data = $posts->findAll();

    $this->view('server/aricle', [
      'posts' => $data
    ]);
  }
  public function profile()
  {

    $this->view('server/profile');
  }
  public function cats()
  {
    $cats = new Cat();
    $data = $cats->findAll();
    $breeds = new Breed();
    $datab = $breeds->findAll();

    $this->view('server/cats', [
      'cats' => $data,
      'breeds' => $datab
    ]);
  }
  public function createBreed()
  {
    $b = new Breed();

    if (count($_POST) > 0) {
      
      $b->insert($_POST);

      redirect('server/cats');
    }

    $this->view('server/createbreed');
  }
  public function createcat()
  {
    $c = new Cat();

    if (count($_POST) > 0) {
        $uploadedImages = []; // Array to store the paths of uploaded images

        // Handle profile image
        if ($_FILES['cat_profile_image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../public/assets/images/cat_profile/';
            $uniqueProfileFilename = uniqid('profile_') . '_' . basename($_FILES['cat_profile_image']['name']);
            $uploadProfileFile = $uploadDir . $uniqueProfileFilename;

            if (move_uploaded_file($_FILES['cat_profile_image']['tmp_name'], $uploadProfileFile)) {
                $relativeProfilePath = str_replace('/public', '', $uploadProfileFile);
                $_POST['cat_profile'] = $relativeProfilePath; // Store the profile image path
            } else {
                echo "Error uploading profile image.";
                exit;
            }
        }
        
        // Handle related images
        if (isset($_FILES['cat_image_url']) && !empty($_FILES['cat_image_url']['name'][0])) {
            foreach ($_FILES['cat_image_url']['tmp_name'] as $key => $tmpName) {
                if ($_FILES['cat_image_url']['error'][$key] === UPLOAD_ERR_OK) {
                    $uploadDir = '../public/assets/images/cat_images/'; // Ensure this directory exists
                    $uniqueFilename = uniqid('image_') . '_' . basename($_FILES['cat_image_url']['name'][$key]);
                    $uploadFile = $uploadDir . $uniqueFilename;

                    if (move_uploaded_file($tmpName, $uploadFile)) {
                        $relativeFilePath = str_replace('/public', '', $uploadFile);
                        $uploadedImages[] = $relativeFilePath; // Store each image path
                    } else {
                        echo "Error uploading file: " . $_FILES['cat_image_url']['name'][$key];
                        exit;
                    }
                }
            }

            // Store the uploaded image paths in POST as a JSON array
            $_POST['cat_image_url'] = json_encode($uploadedImages); // Convert to JSON
        }

        // Call the insert method with the modified $_POST data
        $c->insert($_POST);
        redirect('server/cats');
    }

    $this->view('server/createcat');
  }
  public function editcat($cat_id)
  {
    $x = new Cat(); // Assuming you have a Cat model for handling cat data
    $arr['cat_id'] = $cat_id;
    $data = $x->first($arr);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $postData = $_POST;

        // Check if a new profile image is uploaded
        if (isset($_FILES['cat_profile_image']) && $_FILES['cat_profile_image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../public/assets/images/cat_profile/'; // Specify your upload directory
            $uploadFile = $uploadDir . basename($_FILES['cat_profile_image']['name']);

            // Move the uploaded profile image to the desired directory
            if (move_uploaded_file($_FILES['cat_profile_image']['tmp_name'], $uploadFile)) {
                $relativeFilePath = str_replace('/public', '', $uploadFile);
                $postData['cat_profile'] = $relativeFilePath; // Update profile image path in post data
            }
        }

        // Handle additional cat images
        if (isset($_FILES['cat_image_url']) && count($_FILES['cat_image_url']['name']) > 0) {
            $uploadDirImages = '../public/assets/images/cat_images/'; // Specify directory for additional cat images

            $imagePaths = []; // Array to store paths of uploaded images
            foreach ($_FILES['cat_image_url']['name'] as $key => $imageName) {
                if ($_FILES['cat_image_url']['error'][$key] === UPLOAD_ERR_OK) {
                    $uploadFile = $uploadDirImages . basename($imageName);
                    // Move the uploaded file to the desired directory
                    if (move_uploaded_file($_FILES['cat_image_url']['tmp_name'][$key], $uploadFile)) {
                        $relativeFilePath = str_replace('/public', '', $uploadFile);
                        $imagePaths[] = $relativeFilePath; // Store the relative path of the uploaded image
                    }
                }
            }
            $postData['cat_image_url'] = json_encode($imagePaths); // Convert paths to JSON or handle as required
        }

        // Update the cat's information
        $x->update_cat($cat_id, $postData);

        // Redirect to the list of cats
        redirect('server/cats');
    }

    $this->view('server/edit_cat', [
        'row' => $data
    ]);
  }
  public function delete_cat($cat_id)
  {
    $x = new Cat();
    $arr['cat_id'] = $cat_id;
    $data = $x->first($arr);

    if (count($_POST) > 0) {
        $x->delete_cat($cat_id);

        redirect('server/cats');
    }

    $this->view('server/delete_cat', [
        'row' => $data
    ]);
  }
  public function editbreed($breed_id)
  {
    $b = new Breed();
    $arr['breed_id'] = $breed_id;
    $data = $b->first($arr);

    if (count($_POST) > 0) {

      $b->update_breed($breed_id, $_POST);

      redirect('server/cats');
    }

    $this->view('server/editbreed', [
      'row' => $data
    ]);
  }
  public function delete_breed($breed_id)
  {
    $b = new Breed();
    $arr['breed_id'] = $breed_id;
    $data = $b->first($arr);

    if (count($_POST) > 0) {

      $b->delete_breed($breed_id);

      redirect('server/cats');
    }

    $this->view('server/delete_breed', [
      'row' => $data
    ]);
  }
}