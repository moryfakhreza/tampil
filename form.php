<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Tambah Data</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Tambah Data</h1>
    <form action="action.php?action=tambah_data" method="post" enctype="multipart/form-data">
        
        <label for="status">Status:</label><br>
        <input type="text" id="status" name="status" required><br>
        
        <label for="ip_address">IP Address:</label><br>
        <input type="text" id="ip_address" name="ip_address" required><br>
        
        <label for="tag_value">Tag Value:</label><br>
        <input type="text" id="tag_value" name="tag_value" required><br>
        
        <label for="file_name">File Name (Upload Gambar):</label><br>
        <input type="file" id="file_name" name="file_name" accept="image/*" required><br>
        
        <label for="date">Date:</label><br>
        <input type="date" id="date" name="date" required><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>