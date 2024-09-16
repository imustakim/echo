<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <link href="/public/assets/css/style.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <?php include __DIR__ . '/../partials/header.php'; ?>
    <main class="container mx-auto px-4 py-8">
        <?= $content ?>
    </main>
    <?php include __DIR__ . '/../partials/footer.php'; ?>
</body>

<script src="/public/assets/js/script.js"></script>
</html>