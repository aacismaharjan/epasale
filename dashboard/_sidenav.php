
<style>
    body {
        font-family: "Poppins", sans-serif;
    }
</style>
<div class="sidebar__container"> <img class="sidebar__logo" src="/epasale/public/img/epasal-primary-logo.png"
        alt="logo" />
    <ul class="sidebar__nav">
        <li class="sidebar__nav-link"><a href="/epasale/dashboard/index.php">Dashboard</a></li>
        <li class="sidebar__nav-link"><a href="/epasale/dashboard/category/AddCategory.php">Categories <i class="fa fa-angle-down"></i></a>
            <ul class="sidebar__nav-dropdown">
                <li><a href="/epasale/dashboard/category/AddCategory.php">Add Category</a></li>
                <li><a href="/epasale/dashboard/category/ListCategory.php">List Category</a></li>
            </ul>
        </li>
        <li class="sidebar__nav-link"><a href="/epasale/dashboard/user/ListSeller.php">Users<i class="fa fa-angle-down"></i></a>
            <ul class="sidebar__nav-dropdown">
            <li><a href="/epasale/dashboard/user/ListAdmin.php">List Admin</a></li>
                <li><a href="/epasale/dashboard/user/ListCustomer.php">List Customer</a></li>
                <li><a href="/epasale/dashboard/user/ListSeller.php">List Sellers</a></li>
                <li><a href="/epasale/dashboard/user/ListDeliveryPerson.php">List Drivers</a></li>
                
            </ul>
        </li>
        <li class="sidebar__nav-link"><a href="#">Products<i class="fa fa-angle-down"></i></a>
            <ul class="sidebar__nav-dropdown">
                <li><a href="/epasale/dashboard/product/AddProduct.php">Add Product</a></li>
                <li><a href="/epasale/dashboard/product/ListProduct.php">List Product</a></li>
            </ul>
        </li>
        <li class="sidebar__nav-link"> <a href="/epasale/dashboard/order/ListOrders.php">List Orders</a></li>
    </ul>
</div>