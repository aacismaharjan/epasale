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

    public function addUser($postData) {
        $stmt = $this->conn->prepare("INSERT INTO tbl_users (fname, lname, email, contact_no, gender, dob, password_hash) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $hashed_password = sha1($postData["password"]);

        $this->catchException(function () use ($stmt, $postData, $hashed_password) {
            $this->validateInput($postData);
            $stmt->bind_param("sssssss", $postData['fname'], $postData['lname'], $postData['email'], $postData['contact_no'], $postData['gender'], $postData['dob'], $hashed_password);

            if ($stmt->execute())
                Alert::show("User added successfully.");
            else
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
                        throw new \Exception("Your account was blocked. Please contact the admin.");

                    $_SESSION["user_id"] = $record["user_id"];
                    $_SESSION["fullname"] = $record["fname"] . " " . $record["lname"];
                    $_SESSION["email"] = $record["email"];
                    $_SESSION["roles"] = $this->getRoles($record["user_id"]);

                    header("Location: /epasale");
                } else {
                    throw new \Exception("Incorrect email or password.");
                }
            }
        });
    }

    function updateUser($user_id, $param, $value) {
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