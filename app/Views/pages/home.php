<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <h1 class="display-4 mb-4" style="font-weight: bold; color: #800000;">Welcome to ITE311</h1>
            <p class="lead mb-4" style="color: #4d0000;">Your comprehensive learning management system for Information Technology Education.</p>
            
            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px;">
                        <div class="card-body text-center">
                            <i class="bi bi-mortarboard" style="font-size: 3rem; color: #800000;"></i>
                            <h5 class="card-title mt-3" style="color: #800000;">Students</h5>
                            <p class="card-text text-muted">Access your courses, assignments, and grades in one place.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px;">
                        <div class="card-body text-center">
                            <i class="bi bi-person-badge" style="font-size: 3rem; color: #800000;"></i>
                            <h5 class="card-title mt-3" style="color: #800000;">Teachers</h5>
                            <p class="card-text text-muted">Manage your courses and track student progress effectively.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px;">
                        <div class="card-body text-center">
                            <i class="bi bi-shield-check" style="font-size: 3rem; color: #800000;"></i>
                            <h5 class="card-title mt-3" style="color: #800000;">Administrators</h5>
                            <p class="card-text text-muted">Oversee the entire system and manage users and courses.</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<?= $this->endSection() ?>
