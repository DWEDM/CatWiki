<?php

class User extends Model
{
    protected $table = 'users';

    public function usernameExists($username)
    {
        $result = $this->where(['username' => $username]);
        return $result ? true : false;
    }

    public function createUser($data)
    {
        return $this->insert($data);
    }

    // Method to update user information
    public function updateUser($id, $data)
    {
        return $this->update($id, $data, 'user_id'); // Assuming 'user_id' is the primary key
    }

    public function deleteUser($id)
    {
        return $this->delete($id, 'user_id'); // Assuming 'user_id' is the primary key
    }

    public function getAllUsers()
    {
        return $this->findAll();
    }

    public function findUserById($id)
    {
        return $this->first(['user_id' => $id]); // Assuming 'user_id' is the primary key
    }
}