<?php require_once("./config/db.config.php"); ?>
<?php require_once("./model/OrderManager.php"); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <!-- CSS Stylesheets Start -->
    <link rel="stylesheet" href="/epasale/public/css/style.css">
    <link rel="stylesheet" href="/epasale/public/css/order.css">
    <!-- CSS Stylesheets End -->
</head>

<body>
    <!-- Includes header partial from ./includes/_header.php -->
    <?php include_once("includes/_header.php"); ?>




    <br />
    <div class="order__section">
        <div class="order__container">
            <h3 class="order__h3">My Orders</h3>
            <table class="order__table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Status</th>
                        <th>Payment Method</th>
                        <th>Total Amount</th>
                        <th>Order Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $orderManager = new OrderManager($conn);
                    $orders = $orderManager->getCustomerOrders($_SESSION["user_id"]);

                    // Display the order table
                    if (!empty($orders)) {
                        foreach ($orders as $order) {
                            echo '<tr>';
                            echo '<td>' . $order['order_id'] . '</td>';
                            echo '<td>' . $order['order_status'] . '</td>';
                            echo '<td>' . $order['payment_method'] . '</td>';
                            echo '<td>' . $order['total_amount'] . '</td>';
                            echo '<td>' . $order['created_at'] . '</td>';
                            echo '<td><a class="button btn-primary" href="/epasale/invoice.php?orderID=' . $order['order_id'] . '">Invoice</a></td>';
                            echo '</tr>';
                        }

                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo '<p>No orders found.</p>';
                    }

                    ?>
                </tbody>

            </table>
        </div>

        <br />

        <!-- Includes footer partial from ./includes/_footer.php -->
        <?php include_once("includes/_footer.php"); ?>

    </div>
</body>

</html>