<?php include 'includes/config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container p-5">

<h2>Kayıt Ol</h2>
<form method="POST">
    <input type="text" name="ad" class="form-control mb-2" placeholder="Ad Soyad" required>
    <input type="email" name="eposta" class="form-control mb-2" placeholder="E-posta" required>
    <input type="password" name="sifre" class="form-control mb-2" placeholder="Şifre" required>
    <button type="submit" name="kayit" class="btn btn-primary">Kayıt Ol</button>
</form>

<?php
if (isset($_POST['kayit'])) {
    $ad = $_POST['ad'];
    $eposta = $_POST['eposta'];
    $sifre = password_hash($_POST['sifre'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO kullanici (ad, eposta, sifre) VALUES (?, ?, ?)");
    if ($stmt->execute([$ad, $eposta, $sifre])) {
        echo "<div class='alert alert-success mt-3'>Kayıt başarılı. <a href='login.php'>Giriş yap</a></div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Kayıt başarısız.</div>";
    }
}
?>
</body>
</html>
