<?php include 'includes/config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container p-5">

<h2>Giriş Yap</h2>
<form method="POST">
    <input type="email" name="eposta" class="form-control mb-2" placeholder="E-posta" required>
    <input type="password" name="sifre" class="form-control mb-2" placeholder="Şifre" required>
    <button type="submit" name="giris" class="btn btn-success">Giriş Yap</button>
</form>

<?php
if (isset($_POST['giris'])) {
    $eposta = $_POST['eposta'];
    $sifre = $_POST['sifre'];

    $stmt = $pdo->prepare("SELECT * FROM kullanici WHERE eposta = ?");
    $stmt->execute([$eposta]);
    $kullanici = $stmt->fetch();

    if ($kullanici && password_verify($sifre, $kullanici['sifre'])) {
        $_SESSION['kullanici'] = $kullanici;
        header("Location: index.php");
    } else {
        echo "<div class='alert alert-danger mt-3'>Giriş başarısız.</div>";
    }
}
?>
</body>
</html>
