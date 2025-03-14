<!-- Header Start -->

<?php
require_once("config/db.config.php");
require_once("model/CategoryManager.php");
?>
<header class="header">
    <div class="header__container">
        <a class="header_logo" href="/">
            <img src="/public/img/epasal-primary-logo.png" alt="ePasal - Online Food App" width="120px">
        </a>

        <div class="header__searchbar">
            <!-- Filter -->
            <div class="search_filter_background">
                <span class="search_filter">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" fill="currentColor"
                        class="bi bi-filter" viewBox="0 0 16 16">
                        <path
                            d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5" />
                    </svg>

                    <form class="form_sorting_container" action="search.php" onsubmit="handleFilter(event)"
                        method="get">
                        <label class="form_sorting" for="price">Sort By</label>
                        <select name="sort" id="sortOptions">
                            <option value="price">High to Low</option>
                            <option value="-price">Low to High</option>
                            <option value="-created_at">Latest Foods</option>
                        </select>
                        <button style="margin-top: 8px" type="submit">Submit</button>
                    </form>

                </span>
            </div>

            <!-- Search Bar -->
            <form action="search.php" style="width: 100%" id="searchform">
                <input name="query" type="text" placeholder="Search for products and categories" />
            </form>

            <div class="search_icon_background" onclick="document.querySelector('#searchform').submit();">
                <span class="search_icon"><i class="fas fa-search"></i></span>
            </div>
        </div>

        <div class="header__nav">
            <ul>
                <li class="header_nav-links">
                    <a href="/cart.php">
                        <span class="cart__icon"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                <path
                                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z">
                                </path>
                            </svg></span>
                        <span class="cart__badge">0</span>
                    </a>
                </li>
                <?php

                if (isset($_SESSION) && isset($_SESSION["user_id"])) {
                    echo '
                    <div class="profile__container">
                        <img  class="profile__avatar" src="/' . $_SESSION["user_photo_url"] .'" />
                        <div class="profile__description">
                            <h4>' . $_SESSION["fullname"] . '</h4>
                            <p>Customer <svg height="1em" viewBox="0 0 512 512" fill="currentColor"> <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                            </svg></p>
                        </div>

                        <div class="profile__menu">
                            <a href="/my-orders.php">My Orders</a>
                            <a href="/my-details.php">My Info</a>
                            <a href="/my-shop.php">My Shop Info</a>
                            <a href="/change-password.php">Change Password</a>
                            <a href="/dashboard">Go to Dashboard</a>
                            <a href="/?action=logout">Logout</a>
                        </div>
                    </div>';
                } else {
                    echo '
                        <li class="header_nav-links auth--links">
                            <a href="/login.php">Sign in</a>
                        </li>
                        <li class="header_nav-links auth--links">
                            <a href="/signup.php">Sign up </a>
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
    <?php 
        $categoryManager  = new CategoryManager($conn);
        $categories = $categoryManager->getAllCategories();
    ?>
    <div class="container">
        <nav>
            <ul>
                <?php
                    foreach($categories as $category) {
                        $name = $category["category_name"];
                        echo "<li><a class=\"category\" data-name=\"$name\">$name</a>";
                    }
                ?>
            </ul>
        </nav>
    </div>
</section>

<script>
    function updateQuery(name, value) {
        let searchUrl = new URL(location.origin + "/search.php" + location.search);

        searchUrl.searchParams.set(name, value);
        window.location.href = searchUrl.href;
    }

    function handleFilter(event) {
        event.preventDefault();
        let value = event.target.sort.value;
        updateQuery("sort", value);
    }

    function handleCategory(event) {
        event.preventDefault();
        let value = event.target.getAttribute("data-name");
        updateQuery("category", value);
    }

    let categoryElList = document.querySelectorAll(".category");
    categoryElList = Array.from(categoryElList);

    categoryElList.forEach(categoryEl => {
        categoryEl.addEventListener("click", handleCategory);
    })
</script>
<!-- Category End -->