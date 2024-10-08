<?php
class Category extends Model
{
    protected $table = 'categories';  // Set the table name

    public function findAllCategories()
    {
        return $this->findAll(); // Inherited method
    }

    public function findCategory($id)
    {
        return $this->first(['category_id' => $id]); // Use inherited method to find by id
    }

    public function addCategory($data)
    {
        return $this->insert($data); // Inherited method
    }

    public function updateCategory($id, $data)
    {
        return $this->update($id, $data); // Inherited method
    }

    public function deleteCategory($category_id)
    {
        return $this->delete($category_id); // Inherited method
    }
}
