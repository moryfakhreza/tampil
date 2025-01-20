<?php
require_once 'sql.php';

$limit = 10;

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$test = new Test();

$query = "SELECT * FROM tb_develop LIMIT $limit OFFSET $offset";
$result = $test->conn->query($query);

$total_query = "SELECT COUNT(*) FROM tb_develop";
$total_result = $test->conn->query($total_query);
$total_rows = $total_result->fetch_row()[0];
$total_pages = ceil($total_rows / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Table Data</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Data Table</h1>
    <a href="form.php"><button>Tambah Data</button></a> 
    <table>
        <tr>
            <th>Nomor</th>
            <th>Status</th>
            <th>IP Address</th>
            <th>Tag Value</th>
            <th>File Name</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['nomor']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['ip_address']; ?></td>
                <td><?php echo $row['tag_value']; ?></td>
                <td><?php echo $row['file_name']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><button onclick="showImage('<?php echo $row['file_name']; ?>')">Lihat Gambar</button></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="index.php?page=<?php echo $page - 1; ?>">&laquo; Previous</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="index.php?page=<?php echo $i; ?>" <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
        <?php endfor; ?>
        <?php if ($page < $total_pages): ?>
            <a href="index.php?page=<?php echo $page + 1; ?>">Next &raquo;</a>
        <?php endif; ?>
    </div>

    <div id="imageModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('imageModal').style.display='none'">&times;</span>
            <img id="modalImage" src="" alt="Image" style="width:100%">
        </div>
    </div>

    <script>
        function showImage(fileName) {
            var modal = document.getElementById('imageModal');
            var modalImg = document.getElementById("modalImage");
            modal.style.display = "block";
            modalImg.src = "uploads/" + fileName; 
        }
    </script>
</body>
</html>