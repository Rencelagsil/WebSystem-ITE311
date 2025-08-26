<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <h1 class="text-center mb-4">Contact Us</h1>
    <p class="text-center mb-5">We’d love to hear from you! Reach out through any of our channels below.</p>

    <div class="row justify-content-center text-center">
        <div class="col-md-4 mb-4">
            <a href="https://facebook.com/yourpage" target="_blank" class="text-decoration-none text-dark">
                <i class="bi bi-facebook" style="font-size: 2.5rem; color: #3b5998;"></i>
                <p class="mt-2">Facebook</p>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="https://instagram.com/yourpage" target="_blank" class="text-decoration-none text-dark">
                <i class="bi bi-instagram" style="font-size: 2.5rem; color: #E1306C;"></i>
                <p class="mt-2">Instagram</p>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="mailto:yourmail@example.com" class="text-decoration-none text-dark">
                <i class="bi bi-envelope-fill" style="font-size: 2.5rem; color: maroon;"></i>
                <p class="mt-2">Email</p>
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
