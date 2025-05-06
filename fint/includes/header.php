<header class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="index.php">
        <img src="assets/img/logo.png" alt="Financial Management" height="30" class="d-inline-block align-text-top me-2">
        Financial Management
    </a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="w-100"></div>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap d-flex align-items-center">
            <span class="text-white me-3"><?php echo isset($_SESSION['full_name']) ? $_SESSION['full_name'] : ''; ?></span>
            <a class="nav-link px-3" href="logout.php">Sign out</a>
        </div>
    </div>
</header>
