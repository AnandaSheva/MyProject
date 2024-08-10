<?php
require_once 'db.php';

// Query untuk mendapatkan semua kursus
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Course</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h1>Daftar Kursus</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Durasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['duration']; ?></td>
                    <td>
                        <a href="read-course.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Detail</a>
                        <a href="update-course.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary">Edit</a>
                        <a href="delete-course.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="container mt-5">
    <a href="create-course.php" class="btn btn-success">Tambah Kursus Baru</a>
</div>

</body>
</html>