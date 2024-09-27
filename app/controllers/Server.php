<?php

class Server extends Controller
{
  public function index()
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

  public function edit($id)
  {
    $x = new User();
        $arr['id'] = $id;
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

            $x->update($id, $postData);

            redirect('server/users');
        }

        $this->view('edit', [
            'row' => $data
        ]);
  }

  public function delete($id)
  {
    $x = new User();
    $arr['id'] = $id;
    $data = $x->first($arr);

    if (count($_POST) > 0) {

      $x->delete($id);

      redirect('server/users');
    }

    $this->view('server/delete', [
      'row' => $data
    ]);
  }
}