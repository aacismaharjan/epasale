<header class="dashboard-header" id="dashboard-header">
    <?php
    $full_name = $_SESSION["fullname"]
        ?>

    <button class="btn-icon" id="btn-menu-toggle">
        <svg height="1em" viewBox="0 0 448 512">
            <path
                d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
        </svg>
    </button>

    <button class="profile__container profile__container--dashboard">
        <div class="profile__avatar">
            <?php echo $full_name[0]; ?>
        </div>
        <div class="profile__description">
            <h4>
                <?php echo $full_name; ?>
            </h4>
            <p>Admin <svg height="1em" viewBox="0 0 512 512">
                    <path
                        d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                </svg></p>
        </div>

        <div class="profile__menu">
            <a href="/mysite/dashboard/admin/my-details">My Details</a>
            <a href="/epasale/?action=logout">Logout</a>
        </div>
    </button>


</header>


<script>
    let btn = document.getElementById("btn-menu-toggle");

    btn.addEventListener("click", () => {
        let menu = document.getElementById("main-sidenav");
        let mainContent = document.getElementById("main-content");
        let mainHeader = document.getElementById("dashboard-header");

        menu.classList.toggle("sidenav-collapse");
        mainContent.classList.toggle("content-collapse");
        mainHeader.classList.toggle("content-collapse");
    })

</script>