<?php
// Get current route (like 'login', 'register', 'dashboard', etc.)
$currentRoute = service('router')->getMatchedRoute()[0] ?? '';
$session = session();
$userRole = $session->get('userRole'); // Role saved in session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ITE311</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        body {
            background-color: #ffffff;
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background-color: #800000 !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding-left: 15px;
            padding-right: 15px;
        }

        .navbar-brand,
        .nav-link {
            color: #ffffff !important;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #ffcccc !important;
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            background-color: #800000;
            color: white;
            height: 100%;
            position: fixed;
            top: 56px;
            left: 0;
            overflow-y: auto;
            z-index: 1000;
        }
        .sidebar .nav-link {
            color: #ffffff;
            padding: 10px 20px;
            display: block;
        }
        .sidebar .nav-link.active, 
        .sidebar .nav-link:hover {
            background-color: #a52a2a;
            color: #fff;
        }

        /* Update main content styles */
        main {
            flex: 1;
            padding-top: 80px;
            transition: margin-left 0.3s;
        }

        /* Update the content margin when sidebar is present */
        .has-sidebar main {
            margin-left: 240px;
            width: calc(100% - 240px);
            padding: 80px 20px 20px 20px;
        }

        /* Update container within main */
        .has-sidebar main .container-fluid {
            padding-right: 15px;
            padding-left: 15px;
            max-width: 100%;
        }

        /* Remove the fixed width from container in admin pages */
        .has-sidebar main .container {
            max-width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        /* Ensure the cards don't overflow */
        .card {
            width: 100%;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
        <!-- Navbar -->
            <nav class="navbar navbar-expand-lg fixed-top">
                <div class="container-fluid">
                    <a class="navbar-brand" href="<?= base_url('/') ?>">ITE311</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
                    </button>

            <!-- Right-side Menu -->
            <ul class="navbar-nav">
                <?php if ($session->get('isLoggedIn')): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('login') ?>">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

  <!-- Sidebar for Admin -->
    <?php if ($session->get('isLoggedIn') && $userRole === 'admin'): ?>
    <div class="sidebar">
        <nav class="nav flex-column">
            <a class="nav-link <?= ($currentRoute === 'admin/dashboard') ? 'active' : '' ?>" 
            href="<?= base_url('admin/dashboard') ?>"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>

            <a class="nav-link <?= ($currentRoute === 'admin/users') ? 'active' : '' ?>" 
            href="<?= base_url('admin/users') ?>"><i class="bi bi-people me-2"></i>Users</a>

            <a class="nav-link <?= ($currentRoute === 'admin/courses') ? 'active' : '' ?>" 
            href="<?= base_url('admin/courses') ?>"><i class="bi bi-journal-bookmark me-2"></i>Courses</a>

            <a class="nav-link <?= ($currentRoute === 'admin/settings') ? 'active' : '' ?>" 
            href="<?= base_url('admin/settings') ?>"><i class="bi bi-gear me-2"></i>Settings</a>
            <hr class="text-white">

            <a class="nav-link" href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
        </nav>
    </div>
    <script>
        document.body.classList.add("has-sidebar");
    </script>
    <?php endif; ?>

        <!-- Sidebar for Teacher -->
        <?php if ($session->get('isLoggedIn') && $userRole === 'teacher'): ?>
    <div class="sidebar">
        <nav class="nav flex-column">
            <a class="nav-link <?= ($currentRoute === 'teacher/dashboard') ? 'active' : '' ?>" 
            href="<?= base_url('teacher/dashboard') ?>"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>

            <a class="nav-link <?= ($currentRoute === 'teacher/course') ? 'active' : '' ?>" 
            href="<?= base_url('teacher/course') ?>"><i class="bi bi-journal-bookmark me-2"></i>Add Courses</a>

            <a class="nav-link <?= ($currentRoute === 'teacher/assignment') ? 'active' : '' ?>" 
            href="<?= base_url('teacher/assignment') ?>"><i class="bi bi-pencil-square me-2"></i>Add Assignments</a>
            
            <a class="nav-link <?= ($currentRoute === 'teacher/grades') ? 'active' : '' ?>" 
            href="<?= base_url('teacher/grades') ?>"><i class="bi bi-mortarboard me-2"></i>Add Grades</a>

            <a class="nav-link <?= ($currentRoute === 'teacher/settings') ? 'active' : '' ?>" 
            href="<?= base_url('teacher/settings') ?>"><i class="bi bi-gear me-2"></i>Settings</a>
            <hr class="text-white">

            <a class="nav-link" href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
        </nav>
    </div>
    <script>
        document.body.classList.add("has-sidebar");
    </script>
    <?php endif; ?>

    <!-- Sidebar for Student -->
        <?php if ($session->get('isLoggedIn') && $userRole === 'student'): ?>
    <div class="sidebar">
        <nav class="nav flex-column">
            <a class="nav-link <?= ($currentRoute === 'student/dashboard') ? 'active' : '' ?>" 
            href="<?= base_url('student/dashboard') ?>"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>

            <a class="nav-link <?= ($currentRoute === 'student/course') ? 'active' : '' ?>" 
                href="<?= base_url('student/course') ?>"><i class="bi bi-journal-bookmark me-2"></i>Courses</a>
                
                <a class="nav-link <?= ($currentRoute === 'student/assignment') ? 'active' : '' ?>" 
                href="<?= base_url('student/assignment') ?>"><i class="bi bi-pencil-square me-2"></i>Assignments</a>

                <a class="nav-link <?= ($currentRoute === 'student/grades') ? 'active' : '' ?>" 
                href="<?= base_url('student/grades') ?>"><i class="bi bi-mortarboard me-2"></i>Grades</a>

                <a class="nav-link <?= ($currentRoute === 'student/settings') ? 'active' : '' ?>"          
            href="<?= base_url('student/settings') ?>"><i class="bi bi-gear me-2"></i>Settings</a>
            <hr class="text-white">

            <a class="nav-link" href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
        </nav>
    </div>
    <script>
        document.body.classList.add("has-sidebar");
    </script>
    <?php endif; ?>

<!-- Dynamic Content -->
    <main class="container">
        <?= $this->renderSection('content') ?>
    </main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
