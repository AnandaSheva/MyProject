<?php
require_once 'db.php';

if (isset($_GET['material_id'])) {
    $material_id = $_GET['material_id'];

    $sql = "DELETE FROM materials WHERE id = $material_id";
    if ($conn->query($sql) === TRUE) {
        echo "Materi berhasil dihapus!";
    } else {
        echo "Gagal menghapus materi: " . $conn->error;
    }
} else {
    echo "ID materi tidak diberikan.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Materi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h1>Hapus Materi</h1>

    <?php
    if (isset($_GET['material_id'])) {
        $material_id = $_GET['material_id'];

        $sql = "SELECT * FROM materials WHERE id = $material_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($material_row = $result->fetch_assoc()) {
                ?>
                <p>Apakah Anda yakin ingin menghapus materi <strong><?php echo $material_row['title']; ?></strong>?</p>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="hidden" name="material_id" value="<?php echo $material_row['id']; ?>">

                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
                <?php
            }
        } else {
            echo "Materi tidak ditemukan.";
        }
    } else {
        echo "ID materi tidak diberikan.";
    }
?>

</div>

</body>
</html>