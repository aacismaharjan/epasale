<?php

class AddressManager {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createAddress($province, $city, $address, $landmark, $note) {
        $addressInsertQuery = "INSERT INTO tbl_addresses (province, city, address, landmark, note) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($addressInsertQuery);
        $stmt->bind_param("sssss", $province, $city, $address, $landmark, $note);
        $stmt->execute();
        $addressId = $stmt->insert_id;
        $stmt->close();

        return $addressId;
    }
}

class OrderManager {
    private $conn;
    private $addressManager;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->addressManager = new AddressManager($conn);
    }

    public function createOrder($cart, $userId, $address, $landmark, $note, $paymentMethod) {
        $this->conn->begin_transaction();

        try {
            // Create a new address
            $userAddressId = $this->addressManager->createAddress("Bagmati", "Kathmandu", $address, $landmark, $note);

            if ($userAddressId === false) {
                throw new Exception("Error creating user address.");
            }

            // Insert into tbl_orders
            $orderInsertQuery = "INSERT INTO tbl_orders (user_id, address_id, payment_method, created_at) VALUES (?, ?, ?, NOW())";
            $stmt = $this->conn->prepare($orderInsertQuery);
            $stmt->bind_param("iis", $userId, $userAddressId, $paymentMethod);

            if (!$stmt->execute()) {
                throw new Exception("Error inserting order into tbl_orders.");
            }

            $orderId = $stmt->insert_id;
            $stmt->close();

            $cartArray = json_decode($cart, true);

            foreach ($cartArray as $productId => $quantity) {
                // Insert into tbl_order_details
                $orderDetailsInsertQuery = "INSERT INTO tbl_order_details (order_id, product_id, quantity)
                    SELECT ?, ?, ?
                    FROM tbl_products
                    WHERE product_id = ?";

                $stmt = $this->conn->prepare($orderDetailsInsertQuery);
                $stmt->bind_param("iiii", $orderId, $productId, $quantity, $productId);

                if (!$stmt->execute()) {
                    throw new Exception("Error inserting order details into tbl_order_details.");
                }

                $stmt->close();
            }

            // Commit the transaction
            $this->conn->commit();

            // Clear the cart cookie
            setcookie('cart', '', time() - 3600, '/');

            echo Alert::show("Your order has been placed.");

            
        } catch (Exception $e) {
            // Roll back the transaction on error
            $this->conn->rollback();
            echo Alert::show("Error: " . $e->getMessage());
        }

         // Redirect after 5 seconds
         echo '<meta http-equiv="refresh" content="2;url=/epasale">';
    }

    public function getCustomerOrders($userId) {
        // Retrieve customer orders from the database based on the user ID
        $query = "SELECT * FROM tbl_orders WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getInvoice($orderId) {
        $query = "SELECT 
                    o.order_id, 
                    o.user_id, 
                    o.order_status, 
                    o.payment_method, 
                    o.payment_status, 
                    o.total_amount, 
                    o.created_at as order_date, 
                    u.fname, 
                    u.lname, 
                    u.email, 
                    u.contact_no, 
                    a.address, 
                    a.landmark, 
                    a.note 
                  FROM tbl_orders o
                  INNER JOIN tbl_users u ON o.user_id = u.user_id
                  INNER JOIN tbl_addresses a ON o.address_id = a.address_id
                  WHERE o.order_id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        $orderDetails = $result->fetch_assoc();
        $stmt->close();
    
        return $orderDetails;
    }

    public function generateInvoiceItems($orderId) {
        // Fetch order details from the database using the $orderId variable
        $orderManager = new OrderManager($this->conn);
        $orderDetails = $orderManager->getInvoiceItems($orderId);
    
        // Check if order details are available
        if ($orderDetails) {
            $grand_total = 0;
            // Loop through each item in the order and display it dynamically
            foreach ($orderDetails as $item) {
                $grand_total += $item["total_amount"];
                echo '<tr>';
                echo '<td>' . $item['product_name'] . '</td>';
                echo '<td>' . $item['quantity'] . '</td>';
                echo '<td> Rs. ' . $item['unit_price'] . '</td>';
                echo '<td> Rs. ' . $item['total_amount'] . '</td>';
                echo '</tr>';
            }
    
            // Grand Total Row
            echo '<tr>';
            echo '<td colspan="3">Grand Total</td>';
            echo '<td>Rs. ' . $grand_total . '</td>';
            echo '</tr>';
        } else {
            echo '<tr><td colspan="4">No items found</td></tr>';
        }
    }

    public function getInvoiceItems($orderId) {
        $query = "SELECT
                    p.product_name,
                    od.quantity,
                    p.unit_price,
                    (od.quantity * p.unit_price) as total_amount
                  FROM tbl_order_details od
                  INNER JOIN tbl_products p ON od.product_id = p.product_id
                  WHERE od.order_id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        $items = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $items;
    }


    function updateOrder($orderId, $param, $value) {
        // Validate parameters to prevent SQL injection
        $orderId = intval($orderId);
        $param = strtolower($param);
    
        // Check if the provided parameter is valid
        if ($param !== 'payment_status' && $param !== 'order_status') {
            return "Invalid parameter. Accepted values are 'payment_status' or 'order_status'.";
        }
    
        // Prepare and execute the SQL query
        $sql = "UPDATE tbl_orders SET $param = ? WHERE order_id = ?";
        $stmt = $this->conn->prepare($sql);

        // Bind parameters and execute the query
        $stmt->bind_param("si", $value, $orderId);
        $result = $stmt->execute();
    
        // Close the statement and connection
        $stmt->close();
    }


}
?>