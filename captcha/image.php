<?php
require_once __DIR__ . '/../req/db.php';
$session = $_GET['session'] ?? $_POST['session'] ?? null;

if (!isset($session) || !isSessionAvailable($_GET['session']))
    die('No session available');

$fail = false;

if (isset($_POST['input']) && isset($_POST['seed']) && isset($session)) {
    require_once __DIR__ . '/../req/validate.php';
    if (validate()) {
        $url = setUserPassed($_POST['session']);
        header('Location: ' . $url, true, 303);
    } else
        $fail = true;
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>沙花叉Captcha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="p-1">
    <?php if ($fail) : ?>
        <div class="alert alert-danger" role="alert">
            入力された文字が違います。再度お試しください。
        </div>
    <?php endif; ?>
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
                        <img src="../image.php?seed=<?= $seed ?>" alt="This is captcha image">
                    </div>
                    <div class="mb-3">
                        <label for="captchainput" class="form-label">文字を入力</label>
                        <input type="text" class="form-control" id="captchainput" name="input">
                    </div>
                    <input type="hidden" name="seed" value="<?= $seed ?>">
                    <input type="hidden" name="session" value="<?= $session ?>">
                    <button type="submit" class="btn btn-primary">次へ</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>