<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $material_id = $_POST['material_id'];
    $course_id = $_POST['course_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $embed_link = $_POST['embed_link'];

    $sql = "UPDATE materials SET title = '$title', description = '$description', embed_link = '$embed_link' WHERE id = $material_id";
    if ($conn->query($sql) === TRUE) {
        echo "Materi berhasil diperbarui!";
    } else {
        echo "Gagal memperbarui materi: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Materi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h1>Edit Materi</h1>

    <?php
    if (isset($_GET['material_id'])) {
        $material_id = $_GET['material_id'];

        $sql = "SELECT * FROM materials WHERE id = $material_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($material_row = $result->fetch_assoc()) {
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="hidden" name="material_id" value="<?php echo $material_row['id']; ?>">
                    <input type="hidden" name="course_id" value="<?php echo $material_row['course_id']; ?>">

                    <div class="form-group">
                        <label for="title">Judul:</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $material_row['title']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi:</label>
                        <textarea class="form-control" id="description" name="description"><?php echo $material_row['description']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="embed_link">Link Embed:</label>
                        <input type="text" class="form-control" id="embed_link" name="embed_link" value="<?php echo $material_row['embed_link']; ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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