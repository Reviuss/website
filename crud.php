<?php
include 'koneksi.php';

// Menambah pengajar
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $mata_pelajaran = $_POST['mata_pelajaran'];
    $email = $_POST['email'];

    $sql = "INSERT INTO pengajar (nama, mata_pelajaran, email) VALUES ('$nama', '$mata_pelajaran', '$email')";
    $conn->query($sql);
}

// Menghapus pengajar
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM pengajar WHERE id=$id";
    $conn->query($sql);
    
    // Redirect ke index.php setelah menghapus
    header("Location: index.php");
    exit();
}


// Mengambil data pengajar
$sql = "SELECT * FROM pengajar";
$result = $conn->query($sql);
?>
