<?php if (empty($announcements)): ?>
    <div class="no-announcements">
        <p>No announcements available at the moment.</p>
    </div>
<?php else: ?>
    <?php foreach ($announcements as $announcement): ?>
        <div class="d-flex align-items-start mb-3 p-3 border rounded bg-light">
            <div class="flex-shrink-0 me-3">
                <i class="bi bi-megaphone text-maroon fa-lg"></i>
            </div>
            <div class="flex-grow-1">
                <h6 class="mb-1 text-maroon fw-bold"><?= esc($announcement['title']) ?></h6>
                <div class="text-muted small mb-2">
                    Posted on: <?= date('M d, Y, g:i a', strtotime($announcement['created_at'])) ?>
                </div>
                <div class="announcement-content">
                    <?= esc($announcement['content']) ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
