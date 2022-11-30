<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>沙花叉Captchaを試す</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        img {
            max-width: 100%;
        }
    </style>
</head>

<body class="p-1">
    <div>
        <?php if (isset($_POST['input']) && isset($_POST['seed'])) : ?>
            <?php require_once __DIR__ . '/req/validate.php'; ?>
            <?php if (validate()) : ?>
                <div class=" alert alert-success" role="alert">
                    あなたは人間でしょう。
                    <a href="mystats.html" class="alert-link">正答率を確認</a>
                </div>
                <script>
                    if ((localStorage.getItem('lastSeed') ?? '0') != '<?= $seed ?>')
                        localStorage.setItem('correct', parseInt(localStorage.getItem('correct') ?? '0') + 1);
                </script>
            <?php else : ?>
                <div class="alert alert-danger" role="alert">
                    あなたはロボットかも知れません。

                    <small>
                        入力: <code><?= htmlspecialchars($_POST['input']) ?></code>
                        正解: <code><?= $string ?></code>
                    </small>

                    <a href="mystats.html" class="alert-link">正答率を確認</a>
                </div>
                <script>
                    if ((localStorage.getItem('lastSeed') ?? '0') != '<?= $seed ?>')
                        localStorage.setItem('incorrect', parseInt(localStorage.getItem('incorrect') ?? '0') + 1);
                </script>
            <?php endif; ?>
            <script>
                localStorage.setItem('lastSeed', '<?= $seed ?>')
            </script>
        <?php endif; ?>
    </div>
    <?php
    $seed = random_int(1, PHP_INT_MAX);
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <h1>沙花叉Captchaを試す</h1>
                </div>
                <form method="POST">
                    <div class="mb-3">
                        <img src="image.php?seed=<?= $seed ?>" alt="This is captcha image">
                    </div>
                    <div class="mb-3">
                        <label for="captchainput" class="form-label">文字を入力</label>
                        <input type="text" class="form-control" id="captchainput" name="input" maxlength=5 minlength="5" required>
                    </div>
                    <input type="hidden" name="seed" value="<?= $seed ?>">
                    <button type="submit" class="btn btn-primary">次へ</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>