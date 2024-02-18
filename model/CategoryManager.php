<?php
class CategoryManager {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addCategory($postData) {
        $stmt = $this->conn->prepare("INSERT INTO tbl_categories (category_name) VALUES (?)");

        try {
            $this->validateInput($postData);
            $stmt->bind_param("s", $postData['category_name']);

            if ($stmt->execute()) {
                $msg = 'Category added successfully.';
                echo "<script>alert('$msg')</script>";
            } else {
                throw new \Exception($stmt->error);
            }
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            echo "<script>alert('$msg')</script>";
        } finally {
            $stmt->close();
        }
    }

    public function updateCategory($postData) {
        $stmt = $this->conn->prepare("UPDATE tbl_categories SET category_name=? WHERE category_id=?");

        try {
            $category_id = (int) $postData['category_id'];
            $this->validateInput($postData);

            $stmt->bind_param("si", $postData['category_name'], $category_id);

            if ($stmt->execute()) {
                $msg = 'Category updated successfully.';
                echo "<script>alert('$msg.')</script>";
            } else {
                throw new \Exception($stmt->error);
            }
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            echo "<script>alert('$msg')</script>";
        } finally {
            $stmt->close();
        }
    }

    public function deleteCategory($postData) {
        $stmt = $this->conn->prepare("DELETE FROM tbl_categories WHERE category_id=?");

        try {
            $category_id = (int) $postData['category_id'];
            $stmt->bind_param("i", $category_id);

            if ($stmt->execute()) {
                $msg = "Category deleted successfully";
                echo "<script>alert('$msg')</script>";
            } else {
                throw new \Exception($stmt->error);
            }
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            echo "<script>alert('$msg')</script>";
        } finally {
            $stmt->close();
        }
    }

    public function getAllCategories() {
        $categories = array();
        $stmt = $this->conn->prepare("SELECT * FROM tbl_categories");

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
            echo "<script>alert('$msg')</script>";
        } finally {
            $stmt->close();
        }


        return $categories;
    }

    //  list seller

    public function getAllUser($role_id) {
        $users = array();
        $stmt = $this->conn->prepare("select * from tbl_users u
        inner join tbl_user_roles ur on u.user_id=ur.user_id
        where role_id=(?);");

        try {
            $stmt->bind_param("i", $role_id);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    while ($user = $result->fetch_assoc()) {
                        $users[] = $user;
                    }
                }

            } else {
                throw new \Exception($stmt->error);
            }
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            echo "<script>alert('$msg')</script>";
        } finally {
            $stmt->close();
        }


        return $users;
    }

// user disable
    public function disableUser($user_id){
        $stmt=$this->conn->prepare("update tbl_users set
        is_active=0
        where user_id=?;");

        try{
          

            $stmt->bind_para("i", $user_id);
            
            if($stmt->execute()){
                $msg='User is disableed successfully';
                echo "<script>alert('$msg.')</script>";

            }

            else {
                throw new \Exception($stmt->error);
            }

        }
        catch(\Exception $e){
            $msg=$e->getMessage();
            echo"<script>alert('$msg)</script>";
        }
        finally{
            $stmt->close();
        }

    }

  
    // order function

    public function getAllOrders() {
        $orders = array();
        $stmt = $this->conn->prepare("select * from tbl_orders o
        inner join tbl_users u on o.user_id=u.user_id ORDER BY o.created_at DESC;");

        try {
            // $stmt->bind_param("i", $role_id);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    while ($user = $result->fetch_assoc()) {
                        $orders[] = $user;
                    }
                }

            } else {
                throw new \Exception($stmt->error);
            }
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            echo "<script>alert('$msg')</script>";
        } finally {
            $stmt->close();
        }


        return $orders;
    }



    public function getCategoryById($category_id) {
        $record = array();

        $stmt = $this->conn->prepare("SELECT * FROM tbl_categories WHERE category_id=?");

        try {
            $stmt->bind_param("i", $category_id);

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
            echo "<script>alert('$msg')</script>";
        } finally {
            $stmt->close();
        }

        return $record;
    }

    public function getOrderById($order_id) {
        $record = array();

        $stmt = $this->conn->prepare("SELECT * FROM tbl_orders WHERE order_id=?");

        try {
            $stmt->bind_param("i", $order_id);

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
            echo "<script>alert('$msg')</script>";
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