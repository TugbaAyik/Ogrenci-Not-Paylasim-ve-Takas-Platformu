<?php include 'includes/config.php'; ?>
<?php if (!isset($_SESSION['kullanici'])) { header("Location: login.php"); exit; } ?>

<!DOCTYPE html>
<html>
<head>
    <title>Ana Sayfa - Notlar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container p-5">

<h2>Hoş geldiniz, <?php echo $_SESSION['kullanici']['ad']; ?>!</h2>
<a href="upload.php" class="btn btn-success mb-3">Yeni Not Yükle</a>
<a href="logout.php" class="btn btn-danger mb-3 float-end">Çıkış Yap</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Ders</th>
            <th>Başlık</th>
            <th>Açıklama</th>
            <th>Dosya</th>
            <th>Tarih</th>
            <th>İşlemler</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $stmt = $pdo->query("SELECT * FROM notlar ORDER BY tarih DESC");
    while ($row = $stmt->fetch()) {
        echo "<tr>
            <td>{$row['ders_adi']}</td>
            <td>{$row['baslik']}</td>
            <td>{$row['aciklama']}</td>
            <td><a href='dosyalar/{$row['dosya_adi']}' target='_blank'>İndir</a></td>
            <td>{$row['tarih']}</td>
            <td>";
        if ($row['kullanici_id'] == $_SESSION['kullanici']['id']) {
            echo "<a href='edit.php?id={$row['id']}' class='btn btn-sm btn-warning'>Düzenle</a> 
                  <a href='delete.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Silmek istediğinize emin misiniz?')\">Sil</a>";
        } else {
            echo "-";
        }
        echo "</td></tr>";
    }
    ?>
    </tbody>
</table>

</body>
</html>
