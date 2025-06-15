<?php include 'includes/config.php'; ?>
<?php
if (!isset($_SESSION['kullanici'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$kullanici_id = $_SESSION['kullanici']['id'];

$stmt = $pdo->prepare("SELECT * FROM notlar WHERE id = ? AND kullanici_id = ?");
$stmt->execute([$id, $kullanici_id]);
$not = $stmt->fetch();

if (!$not) {
    echo "Yetkisiz işlem.";
    exit;
}

if (isset($_POST['guncelle'])) {
    $baslik = $_POST['baslik'];
    $ders = $_POST['ders_adi'];
    $aciklama = $_POST['aciklama'];

    $stmt = $pdo->prepare("UPDATE notlar SET ders_adi = ?, baslik = ?, aciklama = ? WHERE id = ? AND kullanici_id = ?");
    $stmt->execute([$ders, $baslik, $aciklama, $id, $kullanici_id]);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Not Düzenle</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container p-5">

<h2>Not Düzenle</h2>
<form method="POST">
    <input type="text" name="ders_adi" class="form-control mb-2" value="<?= htmlspecialchars($not['ders_adi']) ?>" required>
    <input type="text" name="baslik" class="form-control mb-2" value="<?= htmlspecialchars($not['baslik']) ?>" required>
    <textarea name="aciklama" class="form-control mb-2" rows="3"><?= htmlspecialchars($not['aciklama']) ?></textarea>
    <button type="submit" name="guncelle" class="btn btn-primary">Güncelle</button>
    <a href="index.php" class="btn btn-secondary">İptal</a>
</form>

</body>
</html>
