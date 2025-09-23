<?php
// Get current route (like 'login', 'register', 'dashboard', etc.)
$currentRoute = service('router')->getMatchedRoute()[0] ?? '';
$session = session();
$userRole = $session->get('userRole'); // Role saved in session

// Sidebar menus per role
$menus = [
    'admin' => [
        ['route' => 'admin/dashboard', 'icon' => 'bi-speedometer2', 'label' => 'Dashboard'],
        ['route' => 'admin/users', 'icon' => 'bi-people', 'label' => 'Users'],
        ['route' => 'admin/courses', 'icon' => 'bi-journal-bookmark', 'label' => 'Courses'],
        ['route' => 'admin/settings', 'icon' => 'bi-gear', 'label' => 'Settings'],
    ],
    'teacher' => [
        ['route' => 'teacher/dashboard', 'icon' => 'bi-speedometer2', 'label' => 'Dashboard'],
        ['route' => 'teacher/course', 'icon' => 'bi-journal-bookmark', 'label' => 'Courses'],
        ['route' => 'teacher/assignment', 'icon' => 'bi-pencil-square', 'label' => 'Assignments'],
        ['route' => 'teacher/grades', 'icon' => 'bi-mortarboard', 'label' => 'Grades'],
        ['route' => 'teacher/settings', 'icon' => 'bi-gear', 'label' => 'Settings'],
    ],
    'student' => [
        ['route' => 'student/dashboard', 'icon' => 'bi-speedometer2', 'label' => 'Dashboard'],
        ['route' => 'student/course', 'icon' => 'bi-journal-bookmark', 'label' => 'Courses'],
        ['route' => 'student/assignment', 'icon' => 'bi-pencil-square', 'label' => 'Assignments'],
        ['route' => 'student/grades', 'icon' => 'bi-mortarboard', 'label' => 'Grades'],
        ['route' => 'student/settings', 'icon' => 'bi-gear', 'label' => 'Settings'],
    ]
];

// Sidebar render function
function renderSidebar($role, $menus, $currentRoute) {
    if (!isset($menus[$role])) return;

    echo '<div class="sidebar"><nav class="nav flex-column">';
    foreach ($menus[$role] as $menu) {
        $active = ($currentRoute === $menu['route']) ? 'active' : '';
        echo '<a class="nav-link '.$active.'" href="'.base_url($menu['route']).'">
                <i class="bi '.$menu['icon'].' me-2"></i>'.$menu['label'].'</a>';
    }
    echo '<hr class="text-white">
          <a class="nav-link" href="'.base_url('logout').'"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>';
    echo '</nav></div>';
    echo "<script>document.body.classList.add('has-sidebar');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ITE311</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        html, 
        body { 
            height: 100%; 
            margin: 0;
            display: flex;
            flex-direction: column; 
        }
        body { 
            background-color: #fff;
            color: #333; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
        }
        .navbar { 
            background-color: #800000 !important; box-shadow: 0 2px 4px rgba(0,0,0,0.1); 
        }
        .navbar-brand,
        .nav-link { color: #fff !important; font-weight: 500; 
        } 
        .nav-link:hover { 
            color: #ffcccc !important; 
        }
        .sidebar { 
            width: 240px; 
            background-color: #800000; 
            color: #fff; 
            height: 100%; 
            position: fixed; 
            top: 56px; 
            left: 0; 
            overflow-y: auto; 
            z-index: 1000; 
        }
        .sidebar 
        .nav-link { 
            color: #fff; 
            padding: 10px 20px; 
            display: block; 
        }      
        .sidebar 
        .nav-link.active, 
        .sidebar 
        .nav-link:hover { 
            background-color: #a52a2a; 
            color: #fff; 
        }
        main { 
            flex: 1; 
            padding-top: 80px; 
            transition: margin-left 0.3s; 
        }
        .has-sidebar main { 
            margin-left: 240px; 
            width: calc(100% - 240px); 
            padding: 80px 20px 20px; 
        }
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
            <ul class="navbar-nav ms-auto">
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
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('login') ?>">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Sidebar -->
    <?php if ($session->get('isLoggedIn')) renderSidebar($userRole, $menus, $currentRoute); ?>

    <!-- Dynamic Content -->
    <main class="container-fluid">
        <?= $this->renderSection('content') ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
