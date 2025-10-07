<?= $this->extend('templates/header') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 text-maroon">
                    <i class="bi bi-speedometer2 me-2"></i>
                    <?php if ($userRole === 'admin'): ?>Admin Dashboard
                    <?php elseif ($userRole === 'teacher'): ?>Teacher Dashboard
                    <?php elseif ($userRole === 'student'): ?>Student Dashboard
                    <?php endif; ?>
                </h1>
            </div>
        </div>
    </div>

<style>
    .text-maroon {
        color: maroon !important;
    }
</style>

<!-- Admin Dashboard-->
<?php if ($userRole === 'admin'): ?>
<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <!-- Total Users -->
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-maroon text-uppercase mb-1">
                            Total Users
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalUsers ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-people-fill fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <!-- Total Courses -->
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-maroon text-uppercase mb-1">
                            Total Courses
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $courseCount ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-book fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Management Actions -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-white">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="#" class="btn btn-outline-maroon btn-block">
                            <i class="bi bi-person-plus me-2"></i>Manage Users
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="#" class="btn btn-outline-maroon btn-block">
                            <i class="bi bi-book me-2"></i>Manage Courses
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="#recentActivitySection" class="btn btn-outline-maroon btn-block">
                            <i class="bi bi-graph-up me-2"></i>Recent Activity
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="#" class="btn btn-outline-maroon btn-block">
                            <i class="bi bi-gear me-2"></i>Settings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="row" id="recentActivitySection">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-white">Recent Activity</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Action</th>
                                <th>Target</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentActivities as $activity): ?>
                                <tr>
                                    <td><?= esc($activity['name']) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $activity['role'] === 'Teacher' ? 'info' : 'warning' ?>">
                                            <?= esc($activity['role']) ?>
                                        </span>
                                    </td>
                                    <td><?= esc($activity['action']) ?></td>
                                    <td><?= esc($activity['target']) ?></td>
                                    <td><?= date('M d, Y H:i', strtotime($activity['created_at'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Teacher Dashboard-->
<?php elseif ($userRole === 'teacher'): ?>
<!-- Quick Stats -->
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
                        <a href="#" class="btn btn-outline-maroon btn-block">
                            <i class="bi bi-plus-circle me-2"></i>Create Course
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="#" class="btn btn-outline-maroon btn-block">
                            <i class="bi bi-file-earmark-plus me-2"></i>Add Assignment
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="#" class="btn btn-outline-maroon btn-block">
                            <i class="bi bi-chat-dots me-2"></i>View Messages
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="#" class="btn btn-outline-maroon btn-block">
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
                                    <td><?= esc($course['title']) ?></td>
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

<!-- Student Dashboard-->
<?php elseif ($userRole === 'student'): ?>
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
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="enrolled-count"><?= count($enrolledCourses) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-book fa-2x text-gray-300"></i>
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
                            Available Courses
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="available-count"><?= count($availableCourses) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-book fa-2x text-gray-300"></i>
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
                        <a href="#courses" class="btn btn-outline-maroon btn-block">
                            <i class="bi bi-search me-2"></i>Browse Courses
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="#" class="btn btn-outline-maroon btn-block">
                            <i class="bi bi-file-earmark-arrow-up me-2"></i>Submit Assignment
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="#deadlines" class="btn btn-outline-maroon btn-block">
                            <i class="bi bi-clock me-2"></i>Upcoming Deadlines
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="#recent-grades" class="btn btn-outline-maroon btn-block">
                            <i class="bi bi-calendar me-2"></i>View Grades
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Enrolled Courses -->
    <div class="col-lg-6" id="enrolled-courses">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-white">Enrolled Courses</h6>
            </div>
            <div class="card-body">
                <?php if (empty($enrolledCourses)): ?>
                    <p class="text-muted">You are not enrolled in any courses yet.</p>
                <?php else: ?>
                    <?php foreach ($enrolledCourses as $course): ?>
                        <div class="d-flex align-items-center mb-3 p-3 border rounded">
                            <div class="flex-shrink-0">
                                <i class="bi bi-book text-maroon fa-2x"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1"><?= esc($course['title']) ?></h6>
                                <p class="mb-1 text-muted small"><?= esc($course['description']) ?></p>
                                <small class="text-muted">Enrolled on: <?= date('M d, Y', strtotime($course['enrollment_date'])) ?></small>
                            </div>
                            <div class="flex-shrink-0">
                                <a href="#" class="btn btn-sm btn-outline-maroon">View</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Available Courses -->
    <div class="col-lg-6" id="available-courses">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-white">Available Courses</h6>
            </div>
            <div class="card-body">
                <?php if (empty($availableCourses)): ?>
                    <p class="text-muted">No courses available for enrollment.</p>
                <?php else: ?>
                    <?php foreach ($availableCourses as $course): ?>
                        <div class="d-flex align-items-center mb-3 p-3 border rounded">
                            <div class="flex-shrink-0">
                                <i class="bi bi-book text-maroon fa-2x"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1"><?= esc($course['title']) ?></h6>
                                <p class="mb-1 text-muted small"><?= esc($course['description']) ?></p>
                            </div>
                            <div class="flex-shrink-0">
                                <button class="btn btn-sm btn-outline-maroon enroll-btn" data-course-id="<?= $course['id'] ?>">Enroll</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

</div>

<!-- Upcoming Deadlines -->
<div class="row mt-4" id ="deadlines">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-white">Upcoming Deadlines</h6>
            </div>
            <div class="card-body">
                <?php foreach ($upcomingDeadlines as $deadline): ?>
                    <div class="d-flex align-items-center mb-3 p-3 border rounded">
                        <div class="flex-shrink-0">
                            <i class="bi bi-clock text-maroon fa-2x"></i>
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
<div class="row mt-4" id="recent-grades">
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

<script>
$(document).ready(function() {
    $('.enroll-btn').on('click', function(e) {
        e.preventDefault();

        var courseId = $(this).data('course-id');
        var button = $(this);
        var originalText = button.text();

        // Disable button and change text
        button.prop('disabled', true).text('Enrolling...');

        $.post('<?= base_url('course/enroll') ?>', {
            course_id: courseId
        }, function(response) {
                if (response.success) {
                    // Show success message
                    showAlert('success', response.message);

                    // Move course to enrolled list
                    var courseCard = button.closest('.d-flex');
                    var courseTitle = courseCard.find('h6').text();
                    var courseDesc = courseCard.find('p').text();

                    // Remove from available
                    courseCard.remove();

                    // Add to enrolled
                    var enrolledHtml = '<div class="d-flex align-items-center mb-3 p-3 border rounded">' +
                        '<div class="flex-shrink-0"><i class="bi bi-book text-maroon fa-2x"></i></div>' +
                        '<div class="flex-grow-1 ms-3">' +
                        '<h6 class="mb-1">' + courseTitle + '</h6>' +
                        '<p class="mb-1 text-muted small">' + courseDesc + '</p>' +
                        '<small class="text-muted">Enrolled on: ' + new Date().toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) + '</small>' +
                        '</div>' +
                        '<div class="flex-shrink-0"><a href="#" class="btn btn-sm btn-outline-maroon">View</a></div>' +
                        '</div>';

                    $('#enrolled-courses .card-body').append(enrolledHtml);

                    // Update counts
                    var enrolledCount = $('#enrolled-courses .card-body .d-flex').length;
                    var availableCount = $('#available-courses .card-body .d-flex').length;
                    $('#enrolled-count').text(enrolledCount);
                    $('#available-count').text(availableCount);

                } else {
                    // Show error message
                    showAlert('danger', response.message);
                    // Re-enable button
                    button.prop('disabled', false).text(originalText);
                }
            },
            error: function() {
                showAlert('danger', 'An error occurred. Please try again.');
                button.prop('disabled', false).text(originalText);
            }
        });
    });

    function showAlert(type, message) {
        var alertHtml = '<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
            message +
            '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
            '</div>';
        $('.container-fluid').prepend(alertHtml);
        // Auto dismiss after 5 seconds
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
    }
});
</script>

<?php endif; ?>
</div>

<style>
/* Maroon and White Color Scheme */
.border-left-primary,
.border-left-success,
.border-left-info,
.border-left-warning {
    border-left: 0.25rem solid #800000 !important;
}

.text-xs {
    font-size: 0.7rem;
}

.text-gray-300,
.text-gray-800 {
    color: #800000 !important;
}

.card {
    border: 1px solid #800000;
    box-shadow: 0 2px 4px rgba(128, 0, 0, 0.1);
}
.card-header {
    background-color: #800000;
    color: white;
    border-bottom: 1px solid #800000;
}

/* Solid Buttons */
.btn-primary,
.btn-success,
.btn-info,
.btn-warning {
    background-color: #800000;
    border-color: #800000;
    color: #fff !important;
}
.btn-primary:hover,
.btn-success:hover,
.btn-info:hover,
.btn-warning:hover {
    background-color: #660000;
    border-color: #660000;
}

/* Outline Buttons */
.btn-outline-maroon {
    color: #800000 !important;
    border-color: #800000;
}
.btn-outline-maroon:hover {
    background-color: #800000;
    color: #fff !important;
}

/* Badges */
.badge.bg-danger,
.badge.bg-info,
.badge.bg-warning,
.badge.bg-success,
.badge.bg-secondary {
    background-color: #800000 !important;
}

/* Progress Bar */
.progress-bar {
    background-color: #800000;
}
</style>
<?= $this->endSection() ?>
