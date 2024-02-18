<?php require_once("./../config/db.config.php"); ?>
<?php require_once("./../config/dashboard.auth.php"); ?>

<?php
$row = "";
$stmt = $conn->prepare("SELECT 
        (SELECT count(*) FROM view_users WHERE role_name= \"User\") AS customers,
        (SELECT count(*) FROM view_users WHERE role_name= \"Seller\") AS sellers,
        (SELECT count(*) FROM view_users WHERE role_name= \"Delivery Person\") AS drivers,
        (SELECT count(*) FROM view_users WHERE role_name= \"Admin\") AS admins,
        (SELECT count(*) FROM tbl_products) AS total_products,
        (SELECT count(*) FROM tbl_categories) AS total_categories,
        (SELECT sum(total_amount) FROM see_orders_detail) AS total_revenue,
        (SELECT count(*) FROM tbl_orders) AS total_orders;");
if ($stmt->execute()) {
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}
$stmt->close();

$row_seller = "";
$user_id = $_SESSION["user_id"];
$stmt = $conn->prepare("
   SELECT (SELECT COUNT(*) FROM tbl_products where user_id = $user_id) AS total_products, 
   sum(quantity) as total_quantity_sold, sum(total_amount) as total_revenue from see_orders_detail
   WHERE seller_id = $user_id;
");
if ($stmt->execute()) {
    $result = $stmt->get_result();
    $row_seller = $result->fetch_assoc();
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/epasale/public/css/style.css" />
    <link rel="stylesheet" href="/epasale/public/css/dashboard.css" />
</head>

<body>
    <?php include_once("./../includes/_sidenav.php"); ?>

    <?php include_once("./../includes/_header.dash.php"); ?>

    <div id="main-content">
            <?php
            // Check if the user has permission to view these statistics
            if (hasRole($_SESSION["roles"], ['Admin'])) {
                ?>
                <p>Statistics for Admin</p>
                <div class="stat-wrapper">
                    <div class="stat-card">
                        <span class="stat-card-title">Sellers</span>
                        <span class="stat-card-number">
                            <?php echo isset($row["sellers"]) ? $row["sellers"] : 'N/A'; ?>
                        </span>
                    </div>

                    <div class="stat-card">
                        <span class="stat-card-title">Customers</span>
                        <span class="stat-card-number">
                            <?php echo isset($row["customers"]) ? $row["customers"] : 'N/A'; ?>
                        </span>
                    </div>

                    <div class="stat-card">
                        <span class="stat-card-title">Admins</span>
                        <span class="stat-card-number">
                            <?php echo isset($row["admins"]) ? $row["admins"] : 'N/A'; ?>
                        </span>
                    </div>

                    <div class="stat-card">
                        <span class="stat-card-title">Delivery Person</span>
                        <span class="stat-card-number">
                            <?php echo isset($row["drivers"]) ? $row["drivers"] : 'N/A'; ?>
                        </span>
                    </div>

                    <div class="stat-card">
                        <span class="stat-card-title">Total Products</span>
                        <span class="stat-card-number">
                            <?php echo isset($row["total_products"]) ? $row["total_products"] : 'N/A'; ?>
                        </span>
                    </div>

                    <div class="stat-card">
                        <span class="stat-card-title">Total Categories</span>
                        <span class="stat-card-number">
                            <?php echo isset($row["total_categories"]) ? $row["total_categories"] : 'N/A'; ?>
                        </span>
                    </div>

                    <div class="stat-card">
                        <span class="stat-card-title">Total Orders</span>
                        <span class="stat-card-number">
                            <?php echo isset($row["total_orders"]) ? $row["total_orders"] : 'N/A'; ?>
                        </span>
                    </div>

                    <div class="stat-card">
                        <span class="stat-card-title">Total Revenue</span>
                        <span class="stat-card-number">
                            <?php echo isset($row["total_revenue"]) ? $row["total_revenue"] : 'N/A'; ?>
                        </span>
                    </div>
                </div>
            <?php } ?>


            <?php
            // Check if the user has permission to view these statistics
            if (hasRole($_SESSION["roles"], ['Seller'])) {
                ?>

                <p>Statistics for Seller </p>
                <div  class="stat-wrapper">
                    <div class="stat-card">
                        <span class="stat-card-title">Total Products</span>
                        <span class="stat-card-number">
                            <?php echo isset($row_seller["total_products"]) ? $row_seller["total_products"] : 'N/A'; ?>
                        </span>
                    </div>

                    <div class="stat-card">
                        <span class="stat-card-title">Sold Items(Units)</span>
                        <span class="stat-card-number">
                           <?php echo isset($row_seller["total_quantity_sold"]) ? $row_seller["total_quantity_sold"] : '0'; ?>
                        </span>
                    </div>

                    <div class="stat-card">
                        <span class="stat-card-title">Total Revenue (Rs.)</span>
                        <span class="stat-card-number">
                             <?php echo isset($row_seller["total_revenue"]) ? $row_seller["total_revenue"] : '0'; ?>
                        </span>
                    </div>
                </div>
            <?php } ?>
    </div>

    <script src="/epasale/public/js/dashboard.js"></script>
</body>

</html>