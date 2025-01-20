<?php
require_once 'sql.php';

$limit = 10;

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$search = isset($_GET['search']) ? $_GET['search'] : '';

$test = new Test();

$query = "SELECT * FROM tb_develop WHERE nomor LIKE '%$search%' OR status LIKE '%$search%' OR ip_address LIKE '%$search%' OR tag_value LIKE '%$search%' OR file_name LIKE '%$search%' OR date LIKE '%$search%' LIMIT $limit OFFSET $offset";
$result = $test->conn->query($query);

$total_query = "SELECT COUNT(*) FROM tb_develop WHERE nomor LIKE '%$search%' OR status LIKE '%$search%' OR ip_address LIKE '%$search%' OR tag_value LIKE '%$search%' OR file_name LIKE '%$search%' OR date LIKE '%$search%'";
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

    <div class="table-container">
        <a href="form.php"><button>Tambah Data</button></a>
        <form class="search-form" method="GET" action="index.php">
            <input type="text" name="search" placeholder="Search..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
        </form>
    </div>
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
                <td>
                    <a href="uploads/<?php echo $row['file_name']; ?>" target="_blank">
                        <button>Lihat Gambar</button>
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="index.php?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>">&laquo; Previous</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="index.php?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>" <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
        <?php endfor; ?>
        <?php if ($page < $total_pages): ?>
            <a href="index.php?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>">Next &raquo;</a>
        <?php endif; ?>
    </div>
</body>
</html>