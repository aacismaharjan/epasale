<?php require_once("./config/db.config.php"); ?>
<?php require_once("./model/OrderManager.php"); ?>
<?php require_once("./model/CartManager.php"); ?>
<?php

 hasPermission(["User"]);
 $orderManager = new OrderManager($conn);

 if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
   if($_POST["submit"] == "checkout" && isset($_COOKIE["cart"])) {
     $orderManager = new OrderManager($conn);
     $orderManager->createOrder($_COOKIE["cart"], $_SESSION["user_id"], $_POST["contact_no"], $_POST["address"],$_POST["landmark"], $_POST["note"], $_POST["payment_method"]);
   }
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CheckOut Page</title>

  <!-- CSS Stylesheets Start -->
  <link rel="stylesheet" href="/epasale/public/css/style.css">
  <link rel="stylesheet" href="/epasale/public/css/login.css" />
  <!-- CSS Stylesheets End -->
</head>

<body>
  <!-- Includes header partial from ./includes/_header.php -->
  <?php include_once("includes/_header.php"); ?>

  <!-- chec section includes product summary and product billing -->
  <div class="chec__sec">

    <div class="checinfo">
      <h3 class="checinfo__h3">Order Summary</h3>
      <?php


        $cartManager = new CartManager($conn);

        $cart = array();
        if (isset($_COOKIE["cart"])) {
          $cart = $cartManager->getProductsFromCarts($_COOKIE["cart"]);
        } else {
          echo "Your cart is empty.";
        }

       
      ?>
      <div class="checinfo__cards">


        <?php
        $grandtotal = 0;
        $subtotal = 0;
        foreach ($cart as $product) {
          $total = $product["unit_price"] * $product["quantity"];
          $subtotal += $total;

          echo '
                <div class="checinfo__card">
                <img class="checinfo__img" src="/epasale/' . $product["product_photo_url"] . '" alt="photo of lassi" />
      
                <div class="checinfo__content">
                  <h3 class="checkinfo__cardh3">' . $product["product_name"] . '</h3>
                  <p class="checinfo__qty">Qty: ' . $product["quantity"] . '</p>
                  <p class="checinfo__price">Total: Rs. ' . $total . '</p>
                </div>
              </div>';
        }
        ?>
      </div>
    </div>

    <div class="chec">
      <form class="chec__billing form__wrapper" method="POST">
        <h4 class="checinfo__h3">CheckOut</h4>
        <h3 class="check_h3">Billing Address (Currently Kathmandu)</h3>

        <div class="form-group">
          <label class="form-label" for="contact_no">Mobile Number*</label>
          <input class="form-input" id="contact_no" name="contact_no" placeholder="eg: 9810154589" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="address">Address *</label>
          <select class="form-input" id="address" name="address">
            <option value="Baneshwor">Baneshwor</option>
            <option value="Dhumbarahi">Dhumbarahi</option>
            <option value="Kalanki">Kalanki</option>
            <option value="Teku">Teku</option>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label" for="landmark">Street name / Landmark / Building*</label>
          <input class="form-input" id="landmark" name="landmark" placeholder="eg: Mueseum Marg" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="fame">Delivery Note (Additional Address Information)</label>
          <textarea class="form-input" id="note" rows="2" name="note"
            placeholder="eg: Call me When you reach Museum Marg."></textarea>
        </div>

        <?php
        $delivery_fees = 10.00;
        $delivery_discount = 10.00;
        $grandtotal = $subtotal + $delivery_fees - $delivery_discount;
        ?>

        <div class="chec__orderinfo">
          <h3 class="check_h3">Order Summary</h3>
          <table class="chec__orderinfotable">
            <tr>
              <td>Items Total</td>
              <td align="right">Rs.
                <?php echo $subtotal; ?>
              </td>
            </tr>
            <tr>
              <td>Delivery Fee</td>
              <td align="right">Rs.
                <?php echo $delivery_fees; ?>
              </td>
            </tr>
            <tr>
              <td>Delivery Discount</td>
              <td align="right">Rs.
                <?php echo $delivery_discount; ?>
              </td>
            </tr>
            <tr>
              <td>Total Payment</td>
              <td align="right">Rs.
                <?php echo $grandtotal; ?>
              </td>
            </tr>
          </table>
        </div>

        <div class="chec__pay">
          <h3 class="check_h3">Payment Method</h3>
          <div class="form-group">
            <select class="form-input" name="payment_method">
              <option selected="true" value="COD">Cash on Delivery</option>
              <option value="khalti" disabled>Khalti (Comming Soon)</option>
            </select>
          </div>
        </div>

        <button type="submit" name="submit" value="checkout" class="button btn-primary">Complete Checkout</button>

      </form>
    </div>


  </div>

  <!-- Includes footer partial from ./includes/_footer.php -->
  <?php include_once("includes/_footer.php"); ?>

</body>

</html>

<!-- This logo will be replaced by header @agrani ko -->
<!-- <img class="logo" src="Primary Logo.png" alt="logo" /> -->