<?= $this->extend('templates/header') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 text-dark">
                    <i class="bi bi-speedometer2 me-2"></i>Admin Dashboard
                </h1>
            </div>
        </div>
    </div>

<style>
    .text-maroon {
        color: maroon !important;
    }
</style>

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
                        <a href="#" class="btn btn-primary btn-block">
                            <i class="bi bi-person-plus me-2"></i>Manage User
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="#" class="btn btn-success btn-block">
                            <i class="bi bi-book me-2"></i>Manage Courses
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="#recentActivitySection" class="btn btn-info btn-block">
                            <i class="bi bi-graph-up me-2"></i>Recent Activity
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="#" class="btn btn-info btn-block">
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
                            <?php
                            // Example recent activity data 
                            $recentActivities = [
                                ['name'=>'Jane Smith','role'=>'Teacher','action'=>'Added','target'=>'New Course: "Math 101"','created_at'=>'2025-09-21 09:50'],
                                ['name'=>'Mike Johnson','role'=>'Teacher','action'=>'Updated','target'=>'Course: "Science 201"','created_at'=>'2025-09-20 16:45'],
                                ['name'=>'Alice Brown','role'=>'Student','action'=>'Submitted','target'=>'Assignment: "History HW1"','created_at'=>'2025-09-19 14:30'],
                                ['name'=>'David Lee','role'=>'Student','action'=>'Completed','target'=>'Quiz: "Math 101 Quiz 1"','created_at'=>'2025-09-18 10:15'],
                                ['name'=>'Sarah Green','role'=>'Teacher','action'=>'Graded','target'=>'Student Assignment: "Science Lab 2"','created_at'=>'2025-09-18 09:45'],
                            ];
                            ?>

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


<style>
/* Maroon and White Color Scheme */
.border-left-primary,
.border-left-success {
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
.card {
    border: 1px solid #800000;
    box-shadow: 0 2px 4px rgba(128, 0, 0, 0.1);
}
.card-header {
    background-color: #800000;
    color: white;
    border-bottom: 1px solid #800000;
}
.btn-primary,
.btn-success,
.btn-info,
.btn-warning {
    background-color: #800000;
    border-color: #800000;
}
.btn-primary:hover,
.btn-success:hover,
.btn-info:hover,
.btn-warning:hover {
    background-color: #660000;
    border-color: #660000;   
}
.btn, 
.btn i {
    color: #fff !important;
}
.badge.bg-danger,
.badge.bg-info,
.badge.bg-warning {
    background-color: #800000 !important;
}

</style>
<?= $this->endSection() ?>
