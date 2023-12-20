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
    <!-- google font end -->
</head>

<body>
    <div class="sidebar__container"> <img class="sidebar__logo" src="/epasale/public/img/epasal-primary-logo.png"
            alt="logo" />
        <ul class="sidebar__nav">
            <li class="sidebar__nav-link"> <a href="#">Dashboard <i class="fa fa-angle-down"></i></a>
                <ul class="sidebar__nav-dropdown">
                    <li><a href="#">Sales Overview</a></li>
                    <li><a href="#">Inventory Status</a></li>
                    <li><a href="#">Financial Overview</a></li>
                    <li><a href="#">Customer Insights</a></li>
                </ul>
            </li>
            <li class="sidebar__nav-link"> <a href="#">Manage Users <i class="fa fa-angle-down"></i></a>
                <ul class="sidebar__nav-dropdown">
                    <li><a href="#">Customer Profiles</a></li>
                    <li><a href="#">Feedback and Reviews</a></li>
                    <li><a href="#">Customer Support Tickets</a></li>
                    <li><a href="#">User Overview</a></li>
                </ul>
            </li>
            <li class="sidebar__nav-link"> <a href="#">Manage Shops <i class="fa fa-angle-down"></i></a>
                <ul class="sidebar__nav-dropdown">
                    <li><a href="#">Product Management</a></li>
                    <li><a href="#">Customer Management</a></li>
                    <li><a href="#">Order Processing</a></li>
                    <li><a href="#">Marketing and Promotions</a></li>
                    <li><a href="#">Security and Compliance</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="table__customer">
        <table>
            <th>Name</th>
            <th>Contact</th>
            <th>Email</th>
            <th>DOB</th>
            <th>Shopping Address</th>
            <th>Billing Address</th>
            <th>Created At</th>
            <th>Active Status</th>
            <tr>
                <td>Alisha Pokhrel</td>
                <td>9860020252</td>
                <td>alisha.pokhrel021@gmail.com</td>
                <td>2003-05-08</td>
                <td>Kalanki</td>
                <td>Bafal</td>
                <td>Bafal</td>
                <td>Not Active</td>
            </tr>
            <tr>
                <td>Anisha Pokhrel</td>
                <td>9841629421</td>
                <td>anisha.pokhrel031@gmail.com</td>
                <td>2004-06-07</td>
                <td>Ktm</td>
                <td>Pokhara</td>
                <td>Ktm</td>
                <td>Active</td>
            </tr>
            <tr>
                <td>Anish Pokhrel</td>
                <td>9810154589</td>
                <td>anish.pokhrel041@gmail.com</td>
                <td>2001-09-03</td>
                <td>Ktm</td>
                <td>Dharan</td>
                <td>Dharan</td>
                <td>Not Active</td>
            </tr>
            <tr>
                <td>Aayush Pokhrel</td>
                <td>9861596739</td>
                <td>aayush.pokhrel031@gmail.com</td>
                <td>2002-06-07</td>
                <td>Ktm</td>
                <td>Ktm</td>
                <td>Ktm</td>
                <td>Active</td>
            </tr>
            <tr>
                <td>Niti Pokhrel</td>
                <td>9750596739</td>
                <td>niti.pokhrel031@gmail.com</td>
                <td>2001-03-07</td>
                <td>Dharan</td>
                <td>Dharan</td>
                <td>Dharan</td>
                <td>Not Active</td>
            </tr>
            <tr>
                <td>Aayanka Pokhrel</td>
                <td>9861596739</td>
                <td>aayanka.pokhrel031@gmail.com</td>
                <td>2000-03-01</td>
                <td>Jhapa</td>
                <td>Jhapa</td>
                <td>Jhapa</td>
                <td>Active</td>
            </tr>
        </table>
    </div>
</body>

</html>