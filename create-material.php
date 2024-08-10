<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_id = $_POST['course_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $embed_link = $_POST['embed_link'];

    $sql = "INSERT INTO materials (course_id, title, description, embed_link) VALUES ('$course_id', '$title', '$description', '$embed_link')";
    if ($conn->query($sql) === TRUE) {
        echo "Materi baru berhasil ditambahkan!";
    } else {
        echo "Gagal menambahkan materi: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Materi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h1>Tambah Materi</h1>

    <?php
    if (isset($_GET['course_id'])) {
        $course_id = $_GET['course_id'];

        $sql = "SELECT * FROM courses WHERE id = $course_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="hidden" name="course_id" value="<?php echo $row['id']; ?>">

                    <div class="form-group">
                        <label for="title">Judul:</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi:</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="embed_link">Link Embed:</label>
                        <input type="text" class="form-control" id="embed_link" name="embed_link" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
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