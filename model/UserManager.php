<?php

class UserManager {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function catchException(callable $operation) {
        try {
            $operation();
        } catch (\Exception $e) {
            Alert::show($e->getMessage());
        }
    }

    public function addUser($postData, $fileData) {
        $this->conn->begin_transaction();
        $stmt = $this->conn->prepare("INSERT INTO tbl_users (fname, lname, email, user_photo_url, contact_no, gender, dob, password_hash) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $hashed_password = sha1($postData["password"]);

        $this->catchException(function () use ($stmt, $postData, $fileData, $hashed_password) {
            $user_photo_url = $fileData['user_photo_url'];

            if (isset($fileData["user_photo_url"]) && $fileData["user_photo_url"]["error"] != UPLOAD_ERR_NO_FILE) {
                $fileUploader = new FileUploader();
                $user_photo_url = $fileUploader->uploadPhoto($fileData["user_photo_url"], "public/img/user", "USER_" . $postData["fname"]);
            } else {
                $user_photo_url = null;
            }

            $this->validateInput($postData);
            $stmt->bind_param("ssssssss", $postData['fname'], $postData['lname'], $postData['email'], $user_photo_url, $postData['contact_no'], $postData['gender'], $postData['dob'], $hashed_password);

            if ($stmt->execute()) {
                $userID = $stmt->insert_id;
                $newStmt = $this->conn->prepare("INSERT INTO tbl_user_roles (role_id, user_id) VALUES (3, $userID)"); // User Role
                if (!$newStmt->execute()) {
                    throw new Exception($newStmt->error);
                }
                Alert::show("User added successfully.");
                $this->conn->commit();
            } else
                throw new \Exception($stmt->error);
        });

        $stmt->close();
    }

    public function getRoles($user_id) {
        $roles = array();
        $this->catchException(function () use ($user_id, &$roles) {
            $stmt = $this->conn->prepare("select role_name from tbl_user_roles ur
                    left join tbl_roles r on ur.role_id = r.role_id
                    where ur.user_id = ?;");
            $stmt->bind_param("i", $user_id);

            if ($stmt->execute()) {
                $result = $stmt->get_result();

                while ($role = $result->fetch_assoc()) {
                    $roles[] = $role["role_name"];
                }
            }
        });
        return $roles;
    }

    public function login($postData) {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_users WHERE email=? and password_hash=?");
        $hashed_password = sha1($postData["password"], false);


        $this->catchException(function () use ($stmt, $postData, $hashed_password) {
            $stmt->bind_param("ss", $postData["email"], $hashed_password);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows === 1) {
                    $record = $result->fetch_assoc();

                    if ($record["is_active"] == 0)
                        throw new \Exception("Your account was disabled. Please contact the admin.");

                    $_SESSION["user_id"] = $record["user_id"];
                    $_SESSION["fullname"] = $record["fname"] . " " . $record["lname"];
                    $_SESSION["email"] = $record["email"];
                    $_SESSION["roles"] = $this->getRoles($record["user_id"]);
                    $_SESSION["user_photo_url"] = $record["user_photo_url"];

                    $redirect_url = "/epasale";

                    if (isset($_SESSION["redirect_url"])) {
                        $redirect_url = $_SESSION["redirect_url"];
                    }

                    header("Location: $redirect_url");
                } else {
                    throw new \Exception("Incorrect email or password.");
                }
            }
        });
    }

    public function getUserById($userID) {
        $record = null;

        $this->catchException(function () use ($userID, &$record) {
            $stmt = $this->conn->prepare("SELECT * FROM view_users WHERE user_id=?");

            $stmt->bind_param("i", $userID);

            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $record = $result->fetch_assoc();
                }
            } else {
                throw new \Exception($stmt->error);
            }

            $stmt->close();
        });
        return $record;
    }

    function patchUser($user_id, $param, $value) {
        $this->catchException(function () use ($user_id, $param, $value) {
            // Validate parameters to prevent SQL injection
            $user_id = intval($user_id);
            $param = strtolower($param);

            // Prepare and execute the SQL query
            $sql = "UPDATE tbl_users SET $param = ? WHERE user_id = ?";
            $stmt = $this->conn->prepare($sql);

            // Bind parameters and execute the query
            $stmt->bind_param("si", $value, $user_id);
            $result = $stmt->execute();

            // Close the statement and connection
            $stmt->close();
        });
    }


    function updateUser($postData, $fileData) {
        $this->catchException(function () use ($postData, $fileData) {
            list($userID, $fname, $lname, $gender, $dob, $contact_no, $email) = array_values($postData);

            $user_photo_url = $fileData['user_photo_url'];

            if (isset($_FILES["user_photo_url"]) && $_FILES["user_photo_url"]["error"] != UPLOAD_ERR_NO_FILE) {
                $fileUploader = new FileUploader();
                $user_photo_url = $fileUploader->uploadPhoto($fileData["user_photo_url"], "public/img/user", "USER_" . $postData["fname"]);
            } else {
                $user_photo_url = null;
            }

            $sqlUpdate = "UPDATE tbl_users SET fname = ?, lname=?, email=?, contact_no=?,gender=?, dob=?";
            // Conditionally add user_photo_url to the SQL query and bind the parameter
            if ($user_photo_url !== null) {
                $sqlUpdate .= ", user_photo_url = ?";
                $stmtUpdate = $this->conn->prepare($sqlUpdate . " WHERE user_id = ?");
                $stmtUpdate->bind_param("sssssssi", $fname, $lname, $email, $contact_no, $gender, $dob, $user_photo_url, $userID);
            } else {
                $stmtUpdate = $this->conn->prepare($sqlUpdate . " WHERE user_id = ?");
                $stmtUpdate->bind_param("ssssssi", $fname, $lname, $email, $contact_no, $gender, $dob, $userID);
            }

            $result = $stmtUpdate->execute();

            // Close the statement and connection
            $stmtUpdate->close();
        });
    }

    public function getShopById($userID) {
        $record = null;

        $this->catchException(function () use ($userID, &$record) {
            $stmt = $this->conn->prepare("SELECT * FROM tbl_shops s
            INNER JOIN tbl_users u on u.user_id = s.user_id
             WHERE u.user_id=?");

            $stmt->bind_param("i", $userID);

            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $record = $result->fetch_assoc();
                }
            } else {
                throw new \Exception($stmt->error);
            }

            $stmt->close();
        });
        return $record;
    }

    function patchShop($user_id, $param, $value) {
        $this->catchException(function () use ($user_id, $param, $value) {
            // Validate parameters to prevent SQL injection
            $user_id = intval($user_id);
            $param = strtolower($param);

            // Prepare and execute the SQL query
            $sql = "UPDATE tbl_shops SET $param = ? WHERE user_id = ?";
            $stmt = $this->conn->prepare($sql);

            // Bind parameters and execute the query
            $stmt->bind_param("si", $value, $user_id);
            $result = $stmt->execute();

            // Close the statement and connection
            $stmt->close();
        });
    }

    function updateShopOrCreate($postData, $fileData) {
        $this->catchException(function () use ($postData, $fileData) {
            // Extract data from $postData array
            $userID = (int) $postData['userID']; // Assuming 'shopID' is the hidden input field containing the user ID
            $shopName = $postData['shop_name'];
            $shopPhotoURL = $fileData['shop_photo_url']; // Assuming 'shop_photo' is the file input field containing the photo URL
            $shopCity = $postData['shop_city'];
            $shopAddress = $postData['shop_address'];
            $shopLon = $postData['shop_lon'];
            $shopLat = $postData['shop_lat'];
            $shopContactNo = $postData['shop_contact_no'];

            // Check if the shop already exists for the given user_id
            $sqlCheck = "SELECT COUNT(*) as count FROM tbl_shops WHERE user_id = ?";
            $stmtCheck = $this->conn->prepare($sqlCheck);
            $stmtCheck->bind_param("i", $userID);
            $stmtCheck->execute();
            $resultCheck = $stmtCheck->get_result();
            $rowCheck = $resultCheck->fetch_assoc();

            if (isset($_FILES["shop_photo_url"]) && $_FILES["shop_photo_url"]["error"] != UPLOAD_ERR_NO_FILE) {
                $fileUploader = new FileUploader();
                $shopPhotoURL = $fileUploader->uploadPhoto($fileData["shop_photo_url"], "public/img/shops", "SHOP_" . $postData["shop_name"]);
            } else {
                $shopPhotoURL = null;
            }

            // If shop doesn't exist, create one
            if ($rowCheck['count'] == 0) {
                // Insert a new shop record
                $sqlInsert = "INSERT INTO tbl_shops (user_id, shop_name, shop_photo_url, shop_city, shop_address, shop_lon, shop_lat, shop_contact_no) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmtInsert = $this->conn->prepare($sqlInsert);
                $stmtInsert->bind_param("issssdds", $userID, $shopName, $shopPhotoURL, $shopCity, $shopAddress, $shopLon, $shopLat, $shopContactNo);
                $stmtInsert->execute();
                $stmtInsert->close();
            } else {
                // Update existing shop record
                $sqlUpdate = "UPDATE tbl_shops SET shop_name = ?, shop_city = ?, shop_address = ?, shop_lon = ?, shop_lat = ?, shop_contact_no = ?";
                // Conditionally add shop_photo_url to the SQL query and bind the parameter
                if ($shopPhotoURL !== null) {
                    $sqlUpdate .= ", shop_photo_url = ?";
                    $stmtUpdate = $this->conn->prepare($sqlUpdate . " WHERE user_id = ?");
                    $stmtUpdate->bind_param("ssssddsi", $shopName, $shopCity, $shopAddress, $shopLon, $shopLat, $shopContactNo, $shopPhotoURL, $userID);
                } else {
                    $stmtUpdate = $this->conn->prepare($sqlUpdate . " WHERE user_id = ?");
                    $stmtUpdate->bind_param("ssssddi", $shopName, $shopCity, $shopAddress, $shopLon, $shopLat, $shopContactNo, $userID);
                }
                $stmtUpdate->execute();
                $stmtUpdate->close();
            }

            $stmtCheck->close();
        });
    }

    public function getAllShop() {
        $users = array();
        $stmt = $this->conn->prepare("SELECT * FROM tbl_shops s
        INNER JOIN tbl_users u on u.user_id = s.user_id");

        try {
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


    public function changePassword($postData) {

        $stmtSelect = $this->conn->prepare("SELECT user_id, password_hash FROM tbl_users WHERE email = ?");
        $stmtSelect->bind_param("s", $_SESSION["email"]);

        try {
            $stmtSelect->execute();
            $result = $stmtSelect->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();
                $tempPasswordHash = sha1($_POST["password"]);

                if ($tempPasswordHash == $user['password_hash']) {
                    if ($postData["password1"] != $postData["password2"])
                        throw new \Exception("Confirm password mismatched");

                    $hashed_password = sha1($_POST["password1"]);

                    $stmtUpdate = $this->conn->prepare("UPDATE tbl_users SET password_hash = ? WHERE user_id = ?");
                    $stmtUpdate->bind_param("si", $hashed_password, $user['user_id']);

                    if ($stmtUpdate->execute()) {
                        Alert::show("Password changed successfully.");
                        return true;
                    } else {
                        throw new \Exception($stmtUpdate->error);
                    }
                } else {
                    throw new \Exception("Your current password is incorrect.");
                }
            } else {
                throw new \Exception("User not found.");
            }
        } catch (\Exception $e) {
            Alert::show($e->getMessage());
        } finally {
            $stmtSelect->close();
            if (isset($stmtUpdate)) {
                $stmtUpdate->close();
            }
        }

        return false;
    }


    private function validateInput($postData) {
        $errors = array();

        // Validate first_name
        if (empty($postData['fname'])) {
            $errors[] = "First name should not be blank.";
        }

        // Validate last_name
        if (empty($postData['lname'])) {
            $errors[] = "Last name should not be blank.";
        }

        // Validate phone_no
        if (empty($postData['contact_no'])) {
            $errors[] = "Phone no. should not be blank.";
        }

        // Validate email
        if (empty($postData['email'])) {
            $errors[] = "Email address should not be blank.";
        }

        if (empty($postData['password'])) {
            $errors[] = "Password should not be blank.";
        }

        if (!empty($errors)) {
            throw new \Exception(implode("<br>", $errors));
        }
    }
}

?>
