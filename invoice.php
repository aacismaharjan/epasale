<?php require_once("./config/db.config.php"); ?>
<?php require_once("./model/OrderManager.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ePasal Table</title>
    <!-- CSS Stylesheets Start -->
    <link rel="stylesheet" href="/epasale/public/css/style.css">
    <link rel="stylesheet" href="/epasale/public/css/order.css">
    <!-- CSS Stylesheets End -->
</head>

<body>
    <!-- Includes header partial from ./includes/_header.php -->
    <?php include_once("includes/_header.php"); ?>

    <?php
    $orderManager = new OrderManager($conn);

    $order_id = $_GET["orderID"];
    $invoice = $orderManager->getInvoice($order_id);
    ?>

    <!-- Table Start -->
    <div class="invoice__container">
        <div class="invoice__header">
            <div class="row">
                <div class="col-6" style="display: flex">
                    <img class="invoice__brand" src="/epasale/public/img/epasal-primary-logo.png">
                </div>
                <div class="col-6">
                    <div class="invoice__headertext">
                        <h1 class="text-white ">INVOICE</h1>
                        <p class="text-white">Invoice No.:
                            <?php echo $invoice["order_id"]; ?>
                        </p>
                        <p class="text-white">Date:
                            <?php echo date("Y-m-d", strtotime($invoice["order_date"])); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="invoice__body">
            <div class="row">
                <div class="col-6">
                    <h1 class="invoice__title">Bill From:</h1>
                    <p class="invoice__subtitle">ePasale</p>
                    <p class="invoice__subtitle">Kathmandu</p>
                    <p class="invoice__subtitle">98XXXXXXXX</p>
                </div>
                <div class="col-6">
                    <h1 class="invoice__title text-right">Bill To:</h1>
                    <p class="invoice__subtitle text-right">
                        <?php echo $invoice["fname"] . " " . $invoice["lname"]; ?>
                    </p>
                    <p class="invoice__subtitle text-right">
                        <?php echo $invoice["address"]; ?>
                    </p>
                    <p class="invoice__subtitle text-right">
                        <?php echo $invoice["contact_no"]; ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="invoice__body">
            <table class="invoice__table">
                <thead>
                    <tr>
                        <th>Items</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Call the generateInvoiceItems method with the order ID
                    $orderManager->generateInvoiceItems($order_id);
                    ?>
                </tbody>
            </table>
            <h3 class="invoice__title">Payment Status:
                <?php echo $invoice["payment_status"]; ?>
            </h3>
            <h3 class="invoice__title">Payment Mode:
                <?php echo $invoice["payment_method"]; ?>
            </h3>
        </div>
    </div>
    <!-- Table End -->

    <!-- Includes footer partial from ./includes/_footer.php -->
    <?php include_once("includes/_footer.php"); ?>
</body>

</html>