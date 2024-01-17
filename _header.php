<!-- Header Start -->
<header class="header">
    <div class="header__container">
        <a class="header_logo" href="/epasale/">
            <img src="/epasale/public/img/epasal-primary-logo.png" alt="ePasal - Online Food App" width="120px">
        </a>

        <div class="header__searchbar">
            <div class="search_filter_background">
                <span class="search_filter">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                        <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5" />
                    </svg>

                    <form class="form_sorting_container" action="search.php" method="get">
                        <label class="form_sorting" for="price">Price</label> <br>
                        <select name="sort" id="sortOptions">
                            <option value="price">High to Low</option>
                            <option value="-price">Low to High</option>
                        </select><br>
                        <button type="submit">Submit</button>
                    </form>

                </span>
            </div>

            <form action="search.php" style="width: 100%">
                <input name="query" type="text" placeholder="Search for products and categories" />
                
            </form>

            <div class="search_icon_background">
                    <span class="search_icon"><i class="fas fa-search"></i></span>
                </div>
        </div>

        <div class="header__nav">
            <ul>
                <li class="header_nav-links">
                    <a href="/epasale/cart.php">
                        <span class="cart__icon"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                            </svg></span>
                        <span class="cart__badge">0</span>
                    </a>
                </li>
                <form>

                    <?php

                    if (isset($_SESSION) && isset($_SESSION["user_id"])) {
                        echo '
                    <button class="profile-container">
                        <div class="profile-description">
                            <h4>' . $_SESSION["fullname"] . '</h4>
                            <p>Customer <svg height="1em" viewBox="0 0 512 512" fill="currentColor"> <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                            </svg></p>
                        </div>

                        <div class="profile-menu">
                            <a href="/epasale/my-orders.php">My Orders</a>
                            <a href="/epasale/?action=logout">Logout</a>
                        </div>
                    </button>';
                    } else {
                        echo '
                        <li class="header_nav-links">
                            <a href="/epasale/login.php">Sign in</a>
                        </li>
                        <li class="header_nav-links">
                            <a href="/epasale/signup.php">Sign up </a>
                        </li>';
                    }

                    ?>
            </ul>
        </div>
    </div>
</header>
<!-- Header End -->

<!-- Category Start -->
<section id="nav-category">
    <div class="container">
        <nav>
            <ul>
                <li><a href="/epasale/search.php?category=chicken" class="category">Chicken</a>
                <li><a href="/epasale/search.php?category=Beef" class="category">Beef</a>
                <li><a href="/epasale/search.php?category=Veg" class="category">Veg</a>
                <li><a href="/epasale/search.php?category=Sweets" class="category">Sweets & Deserts</a>
                <li><a href="/epasale/search.php?category=Snacks" class="category">Snacks</a>
                <li><a href="/epasale/search.php?category=Juice" class="category">Juice</a>
                <li><a href="/epasale/search.php?category=Soft Drink" class="category">Soft Drinks</a>
            </ul>
        </nav>
    </div>
</section>
<!-- Category End -->