<?php require_once("./../../utils/connection.php"); ?>
<?php include_once("./../../model/CategoryManager.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Page</title>
    <link rel="stylesheet" href="/epasale/public/css/global.css" />
    <link rel="stylesheet" href="/epasale/public/css/login.css" />
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
    <?php include_once("./../_sidenav.php"); ?>
    <div class="main dashboard__content" id="main-content">
        <!-- Fetch a Record -->
        <?php
        $record = "";
        $category_id = "";

        if (isset($_GET["id"])) {
            $category_id = (int) $_GET["id"];
            $categoryManager = new CategoryManager($conn);
            $record = $categoryManager->getCategoryById($category_id);
        }
        ?>

        <form method="POST" action="/epasale/dashboard/category/ListCategory.php" class="product-form" id="form-category"
            ENCTYPE="multipart/form-data">
            <h3>Category Information</h3>
            <?php echo "<input value='{$category_id}' name='category_id' hidden />" ?>

            <div class="form-group">
                <label class="form-label" for="category_name">Category Name *</label>
                <input class="form-input" type="text" placeholder="Eg: Foods and Beverages" name="category_name" id="category_name"
                    value="<?php echo $category_id && $record['category_name'] ? $record['category_name'] : ''; ?>">
                <span class="error-msg"></span>
            </div>

            <button type="submit" name="<?php echo $category_id && $record ? "update" : 'submit'; ?>">
                <?php echo $category_id && $record ? "Update Category" : 'Add Category'; ?>
            </button>
        </form>
    </div>
</body>

</html>