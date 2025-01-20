<?php
session_start();
require_once 'sql.php';

$action = $_GET['action'];

switch ($action) {

    case 'tambah_data':
        $test = new Test();
        $test->status = $_POST['status'];
        $test->ip_address = $_POST['ip_address'];
        $test->tag_value = $_POST['tag_value'];
        $test->date = $_POST['date'];
        
        $target_dir = "uploads/"; 
        $target_file = $target_dir . basename($_FILES["file_name"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["file_name"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }

        if (file_exists($target_file)) {
            echo "File sudah ada.";
            $uploadOk = 0;
        }

        if ($_FILES["file_name"]["size"] > 100000000000000) {
            echo "Ukuran file terlalu besar.";
            $uploadOk = 0;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "File tidak terunggah.";
        } else {
            if (move_uploaded_file($_FILES["file_name"]["tmp_name"], $target_file)) {
                $test->file_name = basename($_FILES["file_name"]["name"]);
                if ($test->create()) {
                    header('Location: index.php');
                } else {
                    echo "Gagal menambahkan data.";
                }
            } else {
                echo "Terjadi kesalahan saat mengunggah file.";
            }
        }
        break;

}
?>