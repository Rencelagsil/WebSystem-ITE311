<?= $this->extend('templates/header') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 text-dark">
                    <i class="bi bi-person-badge me-2"></i>Teacher Dashboard
                </h1>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
<style>
    .text-maroon {
        color: maroon !important;
    }
</style>

<div class="row mb-4">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-maroon text-uppercase mb-1">
                            Active Courses
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($teacherCourses) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-book fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-maroon text-uppercase mb-1">
                            Total Students
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= array_sum(array_column($teacherCourses, 'students')) ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-people fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-maroon text-uppercase mb-1">
                            New Notifications
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($notifications) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-bell fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-white">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="#" class="btn btn-primary btn-block">
                                <i class="bi bi-plus-circle me-2"></i>Create Course
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="#" class="btn btn-success btn-block">
                                <i class="bi bi-file-earmark-plus me-2"></i>Add Assignment
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="#" class="btn btn-info btn-block">
                                <i class="bi bi-chat-dots me-2"></i>View Messages
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="#" class="btn btn-warning btn-block">
                                <i class="bi bi-graph-up me-2"></i>View Analytics
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- My Courses -->
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-white">My Courses</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Students</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($teacherCourses as $course): ?>
                                    <tr>
                                        <td><?= esc($course['name']) ?></td>
                                        <td><?= $course['students'] ?></td>
                                        <td>
                                            <span class="badge bg-<?= $course['status'] === 'active' ? 'success' : 'secondary' ?>">
                                                <?= esc(ucfirst($course['status'])) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-primary">View</a>
                                            <a href="#" class="btn btn-sm btn-info">Edit</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications -->
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-white">Recent Notifications</h6>
                </div>
                <div class="card-body">
                    <?php foreach ($notifications as $notification): ?>
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <i class="bi bi-<?= $notification['type'] === 'assignment' ? 'file-earmark-text' : ($notification['type'] === 'help' ? 'question-circle' : 'person-plus') ?> text-white"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="small text-gray-800"><?= esc($notification['message']) ?></div>
                                <div class="small text-muted"><?= esc($notification['time']) ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="text-center mt-3">
                        <a href="#" class="btn btn-sm btn-outline-maroon">View All</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Maroon and White Color Scheme */
.border-left-primary {
    border-left: 0.25rem solid #800000 !important;
}
.border-left-success {
    border-left: 0.25rem solid #800000 !important;
}
.border-left-info {
    border-left: 0.25rem solid #800000 !important;
}
.border-left-warning {
    border-left: 0.25rem solid #800000 !important;
}
.text-xs {
    font-size: 0.7rem;
}
.text-gray-300 {
    color: #800000 !important;
}
.text-gray-800 {
    color: #800000 !important;
}

/* Custom Maroon and White Styling */
.card {
    border: 1px solid #800000;
    box-shadow: 0 2px 4px rgba(128, 0, 0, 0.1);
}
.card-header {
    background-color: #800000;
    color: white;
    border-bottom: 1px solid #800000;
}
.btn-primary {
    background-color: #800000;
    border-color: #800000;
}
.btn-primary:hover {
    background-color: #660000;
    border-color: #660000;
}
.btn-success {
    background-color: #800000;
    border-color: #800000;
}
.btn-success:hover {
    background-color: #660000;
    border-color: #660000;
}
.btn-info {
    background-color: #800000;
    border-color: #800000;
}
.btn-info:hover {
    background-color: #660000;
    border-color: #660000;
}
.btn-warning {
    background-color: #800000;
    border-color: #800000;
}
.btn-warning:hover {
    background-color: #660000;
    border-color: #660000;
}
.btn, 
.btn i {
    color: #fff !important;
}
.badge.bg-success {
    background-color: #800000 !important;
}
.badge.bg-secondary {
    background-color: #800000 !important;
}
.btn-outline-maroon {
    color: #800000 !important;
    border-color: #800000;
}
.btn-outline-maroon:hover {
    background-color: #800000;
    color: #fff !important;
}
</style>
<?= $this->endSection() ?>