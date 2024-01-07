<?php

class UserManager {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addUser($postData) {
        $stmt = $this->conn->prepare("INSERT INTO tbl_users (fname, lname, email, contact_no, gender, dob, password_hash) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $hashed_password = sha1($postData["password"]);

        try {
            $this->validateInput($postData);
            $stmt->bind_param("sssssss", $postData['fname'], $postData['lname'], $postData['email'], $postData['contact_no'], $postData['gender'], $postData['dob'], $hashed_password);

            if ($stmt->execute()) {
                $msg = 'User added successfully.';
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

    public function login($postData) {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_users WHERE email=? and password_hash=?");
        $hashed_password = sha1($_POST["password"], false);

        try {
            $stmt->bind_param("ss", $_POST["email"], $hashed_password);

            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows === 1) {
                    $record = $result->fetch_assoc();
                    session_start();
                    $_SESSION["user_id"] = $record["user_id"];
                    $_SESSION["fullname"] = $record["fname"] . " " . $record["lname"];
                    $_SESSION["email"] = $record["email"];
                    header("Location: /epasale");
                } else {
                    throw new \Exception("Incorrect email or password.");
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