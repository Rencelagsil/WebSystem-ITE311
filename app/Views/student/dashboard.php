<?= $this->extend('templates/header') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 text-dark">
                    <i class="bi bi-mortarboard me-2"></i>Student Dashboard
                </h1>
            </div>
        </div>
    </div>

   <style>
    .text-maroon {
        color: maroon !important;
    }
</style>

<!-- Quick Stats -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-maroon text-uppercase mb-1">
                            Enrolled Courses
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($enrolledCourses) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-book fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-maroon text-uppercase mb-1">
                            Upcoming Deadlines
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($upcomingDeadlines) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-maroon text-uppercase mb-1">
                            Average Grade
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= number_format(array_sum(array_column($recentGrades, 'grade')) / count($recentGrades), 1) ?>%
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-trophy fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-maroon text-uppercase mb-1">
                            Completed Assignments
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($recentGrades) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-check-circle fa-2x text-gray-300"></i>
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
                                <i class="bi bi-search me-2"></i>Browse Courses
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="#" class="btn btn-success btn-block">
                                <i class="bi bi-file-earmark-arrow-up me-2"></i>Submit Assignment
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="#" class="btn btn-info btn-block">
                                <i class="bi bi-chat-dots me-2"></i>Ask Question
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="#" class="btn btn-warning btn-block">
                                <i class="bi bi-calendar me-2"></i>View Schedule
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- My Courses -->
        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-white">My Courses</h6>
                </div>
                <div class="card-body">
                    <?php foreach ($enrolledCourses as $course): ?>
                        <div class="d-flex align-items-center mb-3 p-3 border rounded">
                            <div class="flex-shrink-0">
                                <i class="bi bi-book text-white fa-2x"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1"><?= esc($course['name']) ?></h6>
                                <p class="mb-1 text-muted small">Instructor: <?= esc($course['instructor']) ?></p>
                                <div class="progress mb-1" style="height: 6px;">
                                    <div class="progress-bar" role="progressbar" style="width: <?= $course['progress'] ?>%" 
                                         aria-valuenow="<?= $course['progress'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small class="text-muted">Progress: <?= $course['progress'] ?>%</small>
                            </div>
                            <div class="flex-shrink-0">
                                <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Upcoming Deadlines -->
        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-white">Upcoming Deadlines</h6>
                </div>
                <div class="card-body">
                    <?php foreach ($upcomingDeadlines as $deadline): ?>
                        <div class="d-flex align-items-center mb-3 p-3 border rounded">
                            <div class="flex-shrink-0">
                                <i class="bi bi-clock text-white fa-2x"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1"><?= esc($deadline['assignment']) ?></h6>
                                <p class="mb-1 text-muted small">Course: <?= esc($deadline['course']) ?></p>
                                <small class="text-muted">Due: <?= date('M d, Y', strtotime($deadline['due_date'])) ?></small>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="badge bg-<?= $deadline['status'] === 'pending' ? 'warning' : 'success' ?>">
                                    <?= esc(ucfirst($deadline['status'])) ?>
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Grades -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-white">Recent Grades</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Assignment</th>
                                    <th>Grade</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recentGrades as $grade): ?>
                                    <tr>
                                        <td><?= esc($grade['course']) ?></td>
                                        <td><?= esc($grade['assignment']) ?></td>
                                        <td>
                                            <span class="badge bg-<?= $grade['grade'] >= 90 ? 'success' : ($grade['grade'] >= 80 ? 'info' : ($grade['grade'] >= 70 ? 'warning' : 'danger')) ?>">
                                                <?= $grade['grade'] ?>%
                                            </span>
                                        </td>
                                        <td><?= date('M d, Y', strtotime($grade['date'])) ?></td>
                                        <td>
                                            <span class="badge bg-success">Graded</span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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
.badge.bg-success {
    background-color: #800000 !important;
}
.badge.bg-info {
    background-color: #800000 !important;
}
.badge.bg-warning {
    background-color: #800000 !important;
}
.badge.bg-danger {
    background-color: #800000 !important;
}
.progress-bar {
    background-color: #800000;
}
</style>
<?= $this->endSection() ?>