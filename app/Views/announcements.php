<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .announcement {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
        }
        .announcement h3 {
            margin-top: 0;
            color: #333;
        }
        .announcement .date {
            color: #666;
            font-size: 0.9em;
            margin-bottom: 10px;
        }
        .announcement .content {
            line-height: 1.6;
        }
        .no-announcements {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 40px;
        }
    </style>
</head>
<body>
    <h1>Announcements</h1>

    <?php if (empty($announcements)): ?>
        <div class="no-announcements">
            <p>No announcements available at the moment.</p>
        </div>
    <?php else: ?>
        <?php foreach ($announcements as $announcement): ?>
            <div class="announcement">
                <h3><?= esc($announcement['title']) ?></h3>
                <div class="date">
                    Posted on: <?= date('F j, Y, g:i a', strtotime($announcement['created_at'])) ?>
                </div>
                <div class="content">
                    <?= esc($announcement['content']) ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
