<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($title) ?></title>
</head>
<body>
<header>
    <h1><?= htmlspecialchars($title) ?></h1>
    <!-- 예시: $data['menu']가 있으면 메뉴 출력 -->
    <?php if (isset($data['menu'])): ?>
        <nav>
            <ul>
                <?php foreach ($data['menu'] as $item): ?>
                    <li>
                        <a href="<?= htmlspecialchars($item['url']) ?>">
                            <?= htmlspecialchars($item['title']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    <?php endif; ?>
</header>
<main>
    <?= $content ?>
</main>
<footer>
    <p>Copyright &copy; <?= date('Y') ?></p>
</footer>
</body>
</html>
