<?= $this->extend('template') ?>

<?= $this->section('content') ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Dashboard</h1>
        <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger">Logout</a>
    </div>

    <div class="alert alert-success" role="alert">
        Welcome, <?= esc(session('userEmail')) ?>!
    </div>

    <p>This is a dashboard page.</p>
<?= $this->endSection() ?>


