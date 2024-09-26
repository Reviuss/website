<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

include 'koneksi.php';

// Menambah atau mengupdate pengajar
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $mata_pelajaran = $_POST['mata_pelajaran'];
    $email = $_POST['email'];

    if (isset($_POST['id']) && $_POST['id'] != '') {
        // Update
        $id = $_POST['id'];
        $sql = "UPDATE pengajar SET nama='$nama', mata_pelajaran='$mata_pelajaran', email='$email' WHERE id='$id'";
        $conn->query($sql);
    } else {
        // Insert
        $sql = "INSERT INTO pengajar (nama, mata_pelajaran, email) VALUES ('$nama', '$mata_pelajaran', '$email')";
        $conn->query($sql);
    }
}

// Mengambil data pengajar
$sql = "SELECT * FROM pengajar";
$result = $conn->query($sql);

// Cek apakah ada id untuk diupdate
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editQuery = "SELECT * FROM pengajar WHERE id=$id";
    $editData = $conn->query($editQuery)->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengajar</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* CSS untuk menyembunyikan tabel */
        #pengajarTable {
            display: none; /* Awalnya sembunyi */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar Pengajar</h1>
        <a href="logout.php" style="float: right; color: #007bff;">Logout</a>

        <input type="text" id="search" placeholder="Cari pengajar..." onkeyup="searchTable()" style="width: 100%; padding: 10px; margin-bottom: 20px;">
        <button onclick="toggleTable()" style="margin-bottom: 20px;">Tampilkan/Sembunyikan Daftar Pengajar</button>

        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo isset($editData) ? $editData['id'] : ''; ?>">
            <input type="text" name="nama" placeholder="Nama" required value="<?php echo isset($editData) ? $editData['nama'] : ''; ?>">
            <input type="text" name="mata_pelajaran" placeholder="Mata Pelajaran" required value="<?php echo isset($editData) ? $editData['mata_pelajaran'] : ''; ?>">
            <input type="email" name="email" placeholder="Email" required value="<?php echo isset($editData) ? $editData['email'] : ''; ?>">
            <button type="submit" name="tambah"><?php echo isset($editData) ? 'Update Pengajar' : 'Tambah Pengajar'; ?></button>
        </form>

        <table id="pengajarTable">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Mata Pelajaran</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['mata_pelajaran']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <a href="index.php?edit=<?php echo $row['id']; ?>" class="edit">Edit</a>
                    <a href="crud.php?delete=<?php echo $row['id']; ?>" class="delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <script>
    function toggleTable() {
        const table = document.getElementById('pengajarTable');
        if (table.style.display === "none") {
            table.style.display = "table"; // Tampilkan tabel
        } else {
            table.style.display = "none"; // Sembunyikan tabel
        }
    }

    function searchTable() {
        const input = document.getElementById('search');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('pengajarTable');
        const tr = table.getElementsByTagName('tr');

        for (let i = 1; i < tr.length; i++) {
            const td = tr[i].getElementsByTagName('td');
            let found = false;
            for (let j = 0; j < td.length; j++) {
                if (td[j]) {
                    const txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        found = true;
                    }
                }
            }
            tr[i].style.display = found ? "" : "none";
        }
    }
    </script>
</body>
</html>
