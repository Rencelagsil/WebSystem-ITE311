<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="text-center mb-5" style="color: #800000; font-weight: bold;">About ITE311</h1>
            
            <div class="row mb-5">
                <div class="col-md-6">
                    <h3 class="mb-3" style="color: #800000;">Our Mission</h3>
                    <p class="lead text-muted">To provide a comprehensive and user-friendly learning management system that enhances the educational experience for students, teachers, and administrators in Information Technology Education.</p>
                </div>
                <div class="col-md-6">
                    <h3 class="mb-3" style="color: #800000;">Our Vision</h3>
                    <p class="lead text-muted">To be the leading platform that bridges the gap between traditional education and modern technology, making learning more accessible and effective for everyone.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <h3 class="text-center mb-4" style="color: #800000;">Key Features</h3>
                    <div class="row">
                        <?php 
                        $features = [
                            "Role-based Access Control",
                            "Secure Authentication",
                            "Responsive Design",
                            "Course Management",
                            "Assignment Tracking",
                            "Grade Management"
                        ];
                        foreach($features as $feature): ?>
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill" style="font-size: 1.5rem; color: #800000; margin-right: 0.75rem;"></i>
                                <span style="color: #4d0000; font-weight: 500;"><?= $feature ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection() ?>
