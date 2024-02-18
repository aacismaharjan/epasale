<?php

class CategoryModel {

    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function addCategory($postData) {
        $stmt = $this->conn->prepare("INSERT INTO categories (category_name) VALUES (?)");
    
        try {
            $this->validateInput($postData);
            $stmt->bind_param("s", $postData['category_name']);
    
            if ($stmt->execute()) {
                $msg = 'Category added successfully.';
                echo "<script>addAlert('$msg')</script>";
            } else {
                throw new \Exception($stmt->error);
            }
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            echo "<script>addAlert('$msg')</script>";
        } finally {
            $stmt->close();
        }
    }
    
    public function updateCategory($postData) {
        $stmt = $this->conn->prepare("UPDATE categories SET category_name=? WHERE categoryID=?");
    
        try {
            $categoryID = (int) $postData['categoryID'];
            $this->validateInput($postData);
    
            $stmt->bind_param("si", $postData['category_name'], $categoryID);
    
            if ($stmt->execute()) {
                $msg = 'Category updated successfully.';
                echo "<script>addAlert('$msg.')</script>";
            } else {
                throw new \Exception($stmt->error);
            }
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            echo "<script>addAlert('$msg')</script>";
        } finally {
            $stmt->close();
        }
    }
    
    public function deleteCategory($postData) {
        $stmt = $this->conn->prepare("DELETE FROM categories WHERE categoryID=?");
    
        try {
            $categoryID = (int) $postData['categoryID'];
            $stmt->bind_param("i", $categoryID);
    
            if ($stmt->execute()) {
                $msg = "Category deleted successfully";
                echo "<script>addAlert('$msg')</script>";
            } else {
                throw new \Exception($stmt->error);
            }
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            echo "<script>addAlert('$msg')</script>";
        } finally {
            $stmt->close();
        }
    }
    
    public function getAllCategories() {
        $categories = array();
        $stmt = $this->conn->prepare("SELECT * FROM categories");
    
        try {
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    while ($category = $result->fetch_assoc()) {
                        $categories[] = $category;
                    }
                }
    
            } else {
                throw new \Exception($stmt->error);
            }
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            echo "<script>addAlert('$msg')</script>";
        } finally {
            $stmt->close();
        }
    
    
        return $categories;
    }
    
    public function getCategoryById($categoryID) {
        $record = array();
    
        $stmt = $this->conn->prepare("SELECT * FROM categories WHERE categoryID=?");
    
        try {
            $stmt->bind_param("i", $categoryID);
    
            if ($stmt->execute()) {
                $result = $stmt->get_result();
    
                if ($result->num_rows > 0) {
                    $record = $result->fetch_assoc();
                }
            } else {
                throw new \Exception($stmt->error);
            }
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            echo "<script>addAlert('$msg')</script>";
        } finally {
            $stmt->close();
        }
    
        return $record;
    }
    
    private function validateInput($postData) {
        $errors = array();
    
        // Validate category name
        if (empty($postData['category_name'])) {
            $errors[] = "Category name can not be blank.";
        }
    
        if (!empty($errors)) {
            throw new \Exception(implode("<br>", $errors));
        }
    }
    }
    
?>