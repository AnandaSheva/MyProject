<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];

    $sql = "UPDATE courses SET title = '$title', description = '$description', duration = '$duration' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Kursus berhasil diperbarui!";
    } else {
        echo "Gagal memperbarui kursus: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kursus</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h1>Edit Kursus</h1>

    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM courses WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                    <div class="form-group">
                        <label for="title">Judul:</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $row['title']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi:</label>
                        <textarea class="form-control" id="description" name="description"><?php echo $row['description']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="duration">Durasi:</label>
                        <input type="text" class="form-control" id="duration" name="duration" value="<?php echo $row['duration']; ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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