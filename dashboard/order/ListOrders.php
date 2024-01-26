<?php require_once("./../../config/db.config.php"); ?>
<?php require_once("./../../config/dashboard.auth.php"); ?>
<?php include_once("./../../model/CategoryManager.php"); ?>
<?php include_once("./../../model/OrderManager.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Page</title>
    <link rel="stylesheet" href="/epasale/public/css/global.css" />
    <link rel="stylesheet" href="/epasale/public/css/dashboard.css" /> <!-- google font start -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto+Condensed:wght@300&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <style>
        body {
            background: #eeeeee;
        }
    </style>
</head>

<body>
    <?php include_once("./../../includes/_sidenav.php"); ?>
    <div class="dashboard__content">
        <div class="alert-container"></div>
        <?php
        $categoryManager = new CategoryManager($conn);
        $orderManager = new OrderManager($conn);

        // Alert::dd($categoryManager->getAllOrders());
        
        if (isset($_POST['submit']))
            $categoryManager->addCategory($_POST);

        if (isset($_POST['update']))
            $categoryManager->updateCategory($_POST);

        if (isset($_POST["payment_status"])) {
            $orderManager->updateOrder($_POST["orderID"], "payment_status", $_POST["payment_status"]);
        }

        if (isset($_POST["order_status"])) {
            $orderManager->updateOrder($_POST["orderID"], "order_status", $_POST["order_status"]);
        }
        ?>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th align="left">Order ID</th>
                        <th align="left">User ID</th>
                        <th align="left">First Name</th>
                        <th align="left">Last Name</th>
                        <th align="left">Total Amount</th>
                        <th align="left">City</th>
                        <th align="left">Created At</th>
                        <th align="left">Is Active</th>
                        <th align="left">Payment Method</th>
                        <th align="left">Payment Status</th>
                        <th align="left">Order Status</th>
                        <th align="left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $adminList = $categoryManager->getAllOrders();

                    foreach ($adminList as $row) {
                        $admin_id = $row["user_id"];

                        echo "<td>{$row["order_id"]}</td>";
                        echo "<td>{$row["user_id"]}</td>";
                        echo "<td>{$row["fname"]}</td>";
                        echo "<td>{$row["lname"]}</td>";

                        echo "<td>{$row["total_amount"]}</td>";
                        echo "<td>{$row["city"]}</td>";
                        echo "<td>{$row["created_at"]}</td>";
                        echo "<td>{$row["is_active"]}</td>";
                        
                            echo "<td>{$row["payment_method"]}</td>";
                            echo '<td>
                                <form method="post">
                                    <input name="orderID" value="' . $row["order_id"] . '" hidden />
                                    <select name="order_status" onchange="this.parentElement.submit();">
                                        <option value="Pending" ' . ($row["order_status"] == "Pending" ? "selected=true" : "") . ' >Pending</option>
                                        <option value="Processing" ' . ($row["order_status"] == "Processing" ? "selected=true" : "") . ' >Processing</option>
                                        <option value="Packaging" ' . ($row["order_status"] == "Packaging" ? "selected=true" : "") . ' >Packaging</option>
                                        <option value="Out for Delivery" ' . ($row["order_status"] == "Out for Delivery" ? "selected=true" : "") . ' >Out for Delivery</option>
                                        <option value="Completed" ' . ($row["order_status"] == "Completed" ? "selected=true" : "") . ' >Completed</option>
                                        <option value="Cancelled" ' . ($row["order_status"] == "Cancelled" ? "selected=true" : "") . ' >Cancelled</option>
                                    </select>
                                </form>
                            </td>';
                               
                                echo '<td>
                                <form method="post">
                                    <input name="orderID" value="' . $row["order_id"] . '" hidden />
                                    <select name="payment_status" onchange="this.parentElement.submit();">
                                        <option value="Unpaid" ' . ($row["payment_status"] == "Unpaid" ? "selected=true" : "") . ' >Not Paid</option>
                                        <option value="Paid" ' . ($row["payment_status"] == "Paid" ? "selected=true" : "") . ' >Paid</option>
                                    </select>
                                </form>
                            </td>';
                                echo "<td align='center'>
                                            <a class='button btn-primary' target='_blank' href='/epasale/invoice.php?orderID=" . $row["order_id"] . "'>View Invoice</a>
                                    </td>";
                                echo "</tr>";

                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>