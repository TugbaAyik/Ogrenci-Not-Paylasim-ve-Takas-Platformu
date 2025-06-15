<?php include 'includes/config.php'; ?>

<?php
if (!isset($_SESSION['kullanici'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['ekle'])) {
    $baslik = $_POST['baslik'];
    $ders_adi = $_POST['ders_adi'];
    $aciklama = $_POST['aciklama'];
    $dosya = $_FILES['dosya'];
    $kullanici_id = $_SESSION['kullanici']['id'];

    $dosyaAdi = uniqid() . '_' . basename($dosya['name']);
    $hedef = "dosyalar/" . $dosyaAdi;

    if (move_uploaded_file($dosya['tmp_name'], $hedef)) {
        $stmt = $pdo->prepare("INSERT INTO notlar (kullanici_id, ders_adi, baslik, aciklama, dosya_adi) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$kullanici_id, $ders_adi, $baslik, $aciklama, $dosyaAdi]);
        header("Location: index.php");
    } else {
        echo "<div class='alert alert-danger'>Dosya yüklenemedi.</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Not Yükle</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container p-5">

<h2>Yeni Not Yükle</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="ders_adi" class="form-control mb-2" placeholder="Ders Adı" required>
    <input type="text" name="baslik" class="form-control mb-2" placeholder="Not Başlığı" required>
    <textarea name="aciklama" class="form-control mb-2" placeholder="Açıklama" rows="3"></textarea>
    <input type="file" name="dosya" class="form-control mb-3" required>
    <button type="submit" name="ekle" class="btn btn-primary">Yükle</button>
    <a href="index.php" class="btn btn-secondary">Geri Dön</a>
</form>

</body>
</html>
