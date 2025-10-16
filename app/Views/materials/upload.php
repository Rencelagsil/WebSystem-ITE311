<?= $this->extend('templates/header') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-white">Upload Material for <?= esc($course['title']) ?></h6>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('upload_success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('upload_success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('upload_error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('upload_error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('admin/course/' . $course['id'] . '/upload') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="material_file" class="form-label">Select File</label>
                            <input type="file" class="form-control" id="material_file" name="material_file" required>
                            <div class="form-text">
                                Allowed file types: PDF, DOC, DOCX, PPT.
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-maroon me-md-2">Cancel</a>
                            <button type="submit" class="btn btn-outline-maroon">Upload Material</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.text-maroon {
    color: maroon !important;
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
