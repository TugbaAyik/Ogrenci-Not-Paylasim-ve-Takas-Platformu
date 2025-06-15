<?php include 'includes/config.php'; ?>
<?php
if (!isset($_SESSION['kullanici'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$kullanici_id = $_SESSION['kullanici']['id'];

$stmt = $pdo->prepare("SELECT dosya_adi FROM notlar WHERE id = ? AND kullanici_id = ?");
$stmt->execute([$id, $kullanici_id]);
$not = $stmt->fetch();

if (!$not) {
    echo "Yetkisiz işlem.";
    exit;
}

unlink("dosyalar/" . $not['dosya_adi']); // Dosyayı sil

$stmt = $pdo->prepare("DELETE FROM notlar WHERE id = ? AND kullanici_id = ?");
$stmt->execute([$id, $kullanici_id]);

header("Location: index.php");
?>
