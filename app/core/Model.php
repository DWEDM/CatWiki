<?php

class Model extends Database
{

  public function __construct()
  {
    if (!property_exists($this, 'table')) {

      $this->table = strtolower($this::class) . 's';

    }
  }

  public function findAll()
  {
    $query = "select * from  $this->table";
    $result = $this->query($query);
    if ($result) {
      return $result;
    }
    return false;
  }

  public function where($data, $data_not = [])
  {
    $keys = array_keys($data);
    $keys_not = array_keys($data_not);

    $query = "select * from  $this->table where ";

    foreach ($keys as $key) {
      $query .= $key . " = :" . $key . " && ";
    }

    foreach ($keys_not as $key) {
      $query .= $key . " != :" . $key . " && ";
    }

    $query = trim($query, ' && ');

    $data = array_merge($data, $data_not);
    $result = $this->query($query, $data);

    if ($result) {
      return $result;
    }
    return false;
  }

  public function first($data, $data_not = [])
  {
    $keys = array_keys($data);
    $keys_not = array_keys($data_not);

    $query = "select * from  $this->table where ";

    foreach ($keys as $key) {
      $query .= $key . " = :" . $key . " && ";
    }

    foreach ($keys_not as $key) {
      $query .= $key . " != :" . $key . " && ";
    }

    $query = trim($query, ' && ');

    $data = array_merge($data, $data_not);
    $result = $this->query($query, $data);

    if ($result) {
      return $result[0];
    }
    return false;
  }

  public function insert($data)
  {
    $columns = implode(', ', array_keys($data));
    $values = implode(', :', array_keys($data));
    $query = "insert into $this->table ($columns) values (:$values)";

    $this->query($query, $data);

    return false;
  }

  public function update($id, $data, $column = 'id')
  {
    $keys = array_keys($data);
    $query = "update $this->table set ";

    foreach ($keys as $key) {
      $query .= $key . " = :" . $key . ", ";
    }

    $query = trim($query, ", ");

    $query .= " where $column = :$column";

    $data[$column] = $id;
    $this->query($query, $data);

    return false;
  }

  public function update_user($id, $data, $column = 'user_id')
  {
    $keys = array_keys($data);
    $query = "update $this->table set ";

    foreach ($keys as $key) {
      $query .= $key . " = :" . $key . ", ";
    }

    $query = trim($query, ", ");

    $query .= " where $column = :$column";

    $data[$column] = $id;
    $this->query($query, $data);

    return false;
  }

  public function delete($id, $column = 'id')
  {
    $data[$column] = $id;
    $query = "delete from $this->table where $column = :$column";

    $this->query($query, $data);

    return false;
  }
  public function delete_user($id, $column = 'user_id')
  {
    $data[$column] = $id;
    $query = "delete from $this->table where $column = :$column";

    $this->query($query, $data);

    return false;
  }
  public function login($username, $password)
  {
    // Prepare the SQL statement to prevent SQL injection
    $query = "SELECT * FROM $this->table WHERE username = :username";
    $stmt = $this->prepare($query);
    
    // Bind the parameters
    $stmt->bindParam(':username', $username);
    
    // Execute the statement
    $stmt->execute();
    
    // Fetch the user data
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Check if user exists and verify the password
    if ($user && password_verify($password, $user['password'])) {
        // Check if the user role is either admin or editor
        if ($user['role'] === 'admin' || $user['role'] === 'editor') {
            return [
                'user' => $user, // User data
                'role' => $user['role'] // User role
            ]; 
        }
    }
    
    return false; // Login failed
  }
}