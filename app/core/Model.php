<?php

class Model extends Database
{

  public function __construct()
  {
    if (!property_exists($this, 'table')) {

      $this->table = strtolower($this::get_class(Model)) . 's';
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
  public function update_cat($id, $data, $column = 'cat_id')
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
  public function delete_cat($id, $column = 'cat_id')
  {
    $data[$column] = $id;
    $query = "delete from $this->table where $column = :$column";

    $this->query($query, $data);

    return false;
  }
  public function update_breed($id, $data, $column = 'breed_id')
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
  public function delete_breed($id, $column = 'breed_id')
  {
    $data[$column] = $id;
    $query = "delete from $this->table where $column = :$column";

    $this->query($query, $data);

    return false;
  }
}