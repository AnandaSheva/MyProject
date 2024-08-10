<?php
require_once 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM courses WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Kursus berhasil dihapus!";
    } else {
        echo "Gagal menghapus kursus: " . $conn->error;
    }
} else {
    echo "ID kursus tidak diberikan.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Kursus</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h1>Hapus Kursus</h1>

    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM courses WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <p>Apakah Anda yakin ingin menghapus kursus <strong><?php echo $row['title']; ?></strong>?</p>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
                <?php
            }
        } else {
            echo "Kursus tidak ditemukan.";
        }
    } else {
        echo "ID kursus tidak diberikan.";
    }
?>

</div>

</body>
</html>