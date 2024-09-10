<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body>
    <?php include __DIR__ . '/../partials/header.php'; ?>
    <main>
        <?= $content ?>
    </main>
    <?php include __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>