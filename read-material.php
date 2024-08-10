<?php
require_once 'db.php';

if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];

    $sql = "SELECT * FROM materials WHERE course_id = $course_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($material_row = $result->fetch_assoc()) {
            echo "<h1>" . $material_row['title'] . "</h1>";
            echo "<p>" . $material_row['description'] . "</p>";
            echo "<p>Link Embed: " . $material_row['embed_link'] . "</p>";

            // Tampilkan materi dalam kursus
            $sql_course = "SELECT * FROM courses WHERE id = $course_id";
            $result_course = $conn->query($sql_course);

            if ($result_course->num_rows > 0) {
                while($course_row = $result_course->fetch_assoc()) {
                    echo "<h2>" . $course_row['title'] . "</h2>";
                    echo "<p>" . $course_row['description'] . "</p>";
                    echo "<p>Durasi: " . $course_row['duration'] . "</p>";
                }
            } else {
                echo "<p>Tidak ada kursus yang terkait dengan materi ini.</p>";
            }
        }
    } else {
        echo "Tidak ada materi dalam kursus ini.";
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
    <title>Detail Materi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <a href="index.php" class="btn btn-secondary">Kembali ke Daftar Kursus</a>
</div>

</body>
</html>