<?php


class ProductManager {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addProduct($postData) {
        $stmt = $this->conn->prepare("insert into tbl_products(product_name,product_photo_url,
        product_description,unit_Price,user_id, category_id, is_active) values(?,?,?,?,?,?, ?);");

        try {
            if (empty($postData["seller_id"]) || empty($postData["product_name"]) || empty($postData["product_description"]) || empty($postData["unit_price"]) || empty($postData["category_id"])) {
                throw new Exception("Please fill all the required fields.");
            }

            $fileUploader = new FileUploader();
            $fileFolder = $fileUploader->uploadPhoto($_FILES["product_photo_url"], "public/img/products", "PROD_" . $postData["product_name"]);

            $stmt->bind_param("sssiiii", $postData['product_name'], $fileFolder, $postData['product_description'], $postData['unit_price'], $postData["seller_id"], $postData["category_id"], $postData["is_active"]);

            if ($stmt->execute()) {
                $msg = 'Product added successfully.';
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


    public function updateProduct($postData) {
        try {
            $product_id = (int) $postData['product_id'];

            // Check if a new product photo is uploaded
            if (isset($_FILES["product_photo_url"]) && !empty($_FILES["product_photo_url"]["name"])) {
                // Upload the product photo using FileUploader
                $fileUploader = new FileUploader();
                $fileUrl = $fileUploader->uploadPhoto($_FILES["product_photo_url"], "public/img/products", "PROD_" . $postData["product_name"]);

                // Prepare the SQL statement with the updated product photo URL
                $stmt = $this->conn->prepare("UPDATE tbl_products SET product_name=?, product_photo_url=?, product_description=?, unit_price=?, is_active=?, user_id=?, category_id=? WHERE product_id=?");
                $stmt->bind_param("sssiiiii", $postData['product_name'], $fileUrl, $postData['product_description'], $postData['unit_price'], $postData['is_active'], $postData["seller_id"], $postData["category_id"], $product_id);
            } else {
                // Prepare the SQL statement without updating the product photo URL
                $stmt = $this->conn->prepare("UPDATE tbl_products SET product_name=?, product_description=?, unit_price=?, is_active=?, user_id=?, category_id=? WHERE product_id=?");
                $stmt->bind_param("ssiiiii", $postData['product_name'], $postData['product_description'], $postData['unit_price'], $postData['is_active'], $postData["seller_id"], $postData["category_id"], $product_id);
            }

            // Execute the SQL statement
            if ($stmt->execute()) {
                $msg = 'Product updated successfully.';
                echo "<script>addAlert('$msg.')</script>";
            } else {
                throw new \Exception($stmt->error);
            }

            $stmt->close();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            echo "<script>addAlert('$msg')</script>";
        }
    }


    public function getAllProducts($shopID = null) {
        $condition = "";

        if ($shopID) {
            $condition .= "WHERE u.user_id = $shopID";
        }

        $products = array();
        $stmt = $this->conn->prepare("SELECT *
        FROM 
            tbl_products p
        LEFT JOIN 
            tbl_categories c ON p.category_id = c.category_id
        INNER JOIN
            tbl_shops s ON p.user_id = s.user_id
        INNER JOIN
            tbl_users u ON u.user_id = p.user_id
        $condition ;");

        try {
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    while ($product = $result->fetch_assoc()) {
                        $products[] = $product;
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

        return $products;
    }


    public function getProducts($userId = null) {
        $items = array();
        $stmt = $this->conn->prepare("SELECT  product_id, u.user_id, u.is_active, fname, lname,
        product_name,  product_description, product_photo_url, unit_price, p.is_active, p.created_at,
        s.shop_name, s.shop_photo_url, s.shop_lon, s.shop_lat, s.shop_contact_no, s.is_active,s.shop_city,s.shop_address
        FROM  tbl_products p
        INNER JOIN tbl_shops s on s.user_id = p.user_id
        INNER JOIN tbl_users u on p.user_id = u.user_id
        WHERE u.is_active = 1 AND s.is_verified = 1 AND s.is_active = 1 AND p.is_active = 1 AND (u.user_id = ? OR ? IS NULL)
        ORDER BY fname, lname;");

        try {
            $stmt->bind_param("ii", $userId, $userId);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    while ($product = $result->fetch_assoc()) {
                        $items[] = $product;
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

        return $items;
    }

    public function getProductsBySellers($userId = null, $limit) {
        $products = $this->getProducts($userId);
        $cat_products = array();

        foreach ($products as $product) {
            $temp_product = $product;
            unset($temp_product["user_id"]);
            unset($temp_product["fname"]);
            unset($temp_product["lname"]);
            unset($temp_product["shop_name"]);
            unset($temp_product["shop_contact_no"]);
            unset($temp_product["shop_photo_url"]);
            unset($temp_product["shop_lon"]);
            unset($temp_product["shop_lat"]);
            unset($temp_product["shop_city"]);
            unset($temp_product["shop_address"]);
            unset($temp_product["province"]);
            unset($temp_product["is_active"]);

            if (isset($cat_products[$product["user_id"]])) {
                $cat_products[$product["user_id"]]["products"][] = $temp_product;
            } else {
                $seller = array("user_id" => $product["user_id"], "fname" => $product["fname"], "lname" => $product["lname"], "is_active" => $product["is_active"],  "shop_name" => $product["shop_name"], "shop_contact_no" => $product["shop_contact_no"], "shop_photo_url" => $product["shop_photo_url"], "shop_lon" => $product["shop_lon"], "shop_lat" => $product["shop_lat"],"shop_city" => $product["shop_city"],"shop_address" => $product["shop_address"], "products" => array($temp_product));

                $cat_products[$product["user_id"]] = $seller;
            }
        }

        usort($cat_products, function ($a, $b) {
            $countA = count($a['products']);
            $countB = count($b['products']);

            if ($countA == $countB) {
                return 0;
            }

            return ($countA > $countB) ? -1 : 1;
        });

        return array_slice($cat_products, 0, $limit);
    }

    function getSeller($user_id) {
        $seller = null;

        // $stmt = $this->conn->prepare("SELECT tbl_users.user_id, user_photo_url, tbl_users.is_active, fname, lname, province, city
        // FROM  tbl_users
        // WHERE tbl_users.is_active = 1 AND tbl_users.user_id = ?
        // ORDER BY fname, lname;");

        $stmt = $this->conn->prepare("SELECT  product_id, u.user_id, u.is_active, fname, lname,
        product_name,  product_description, product_photo_url, unit_price, p.is_active, p.created_at,
        s.shop_name, s.shop_photo_url, s.shop_lon, s.shop_lat, s.shop_contact_no, s.is_active,s.shop_city,s.shop_address
        FROM  tbl_products p
        INNER JOIN tbl_shops s on s.user_id = p.user_id
        INNER JOIN tbl_users u on p.user_id = u.user_id
        WHERE u.is_active = 1 AND u.user_id = ?
        ORDER BY fname, lname;");

        try {
            $stmt->bind_param("i", $user_id);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $seller = $result->fetch_assoc();
            } else {
                throw new \Exception($stmt->error);
            }
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            echo "<script>addAlert('$msg')</script>";
        } finally {
            $stmt->close();
        }

        return $seller;
    }


    public function getProductById($product_id) {
        $record = array();

        $stmt = $this->conn->prepare("SELECT *
        FROM  tbl_products p
        INNER JOIN tbl_users u on p.user_id = u.user_id
        INNER JOIN tbl_shops shop on shop.user_id = p.user_id
        INNER JOIN tbl_categories c on p.category_id = c.category_id
        WHERE product_id=?");

        try {
            $stmt->bind_param("i", $product_id);

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

    function getSearchedProduct($query, $catname, $sort) {
        $seller = array();

        if (strpos($sort, "price") !== false) {
            if ($sort == "price") {
                $sort = "unit_price DESC";
            } else {
                $sort = "unit_price ASC";
            }
        } else {
            if ($sort == "created_at") {
                $sort = "created_at ASC";
            } else {
                $sort = "created_at DESC";
            }
        }


        $stmt = $this->conn->prepare("SELECT p.product_id, p.product_name, p.product_description, p.product_photo_url, p.unit_price, c.category_name
        FROM 
            tbl_products p
        JOIN 
            tbl_categories c ON p.category_id = c.category_id
        WHERE 
            (p.product_name LIKE ? OR p.product_description LIKE ? ) AND c.category_name LIKE ? 
        ORDER BY " . $sort . " ;");



        try {
            $stmt->bind_param("sss", $query, $query, $catname);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    while ($product = $result->fetch_assoc()) {
                        $seller[] = $product;
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

        return $seller;
    }
}

?>