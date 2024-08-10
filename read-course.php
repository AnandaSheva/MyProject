<?php
require_once 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM courses WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<h1>" . $row['title'] . "</h1>";
            echo "<p>" . $row['description'] . "</p>";
            echo "<p>Durasi: " . $row['duration'] . "</p>";

            // Tampilkan materi dalam kursus
            $sql_materials = "SELECT * FROM materials WHERE course_id = $id";
            $result_materials = $conn->query($sql_materials);

            if ($result_materials->num_rows > 0) {
                echo "<h2>Materi dalam Kursus:</h2>";
                while($material_row = $result_materials->fetch_assoc()) {
                    echo "<h3>" . $material_row['title'] . "</h3>";
                    echo "<p>" . $material_row['description'] . "</p>";
                    echo "<p>Link Embed: " . $material_row['embed_link'] . "</p>";
                    echo "<hr>";
                }
            } else {
                echo "<p>Tidak ada materi dalam kursus ini.</p>";
            }
        }
    } else {
        echo "Kursus tidak ditemukan.";
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
    <title>Detail Kursus</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <a href="index.php" class="btn btn-secondary">Kembali ke Daftar Kursus</a>
</div>

</body>
</html>