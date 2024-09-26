<?php
include 'koneksi.php';

// Membuat database
$sql = "CREATE DATABASE IF NOT EXISTS pendidikan";
$conn->query($sql);

// Menggunakan database
$conn->select_db('pendidikan');

// Membuat tabel pengajar
$sql = "CREATE TABLE IF NOT EXISTS pengajar (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    mata_pelajaran VARCHAR(100),
    email VARCHAR(100)
)";

$conn->query($sql);

// Membuat tabel mata_pelajaran
$sql = "CREATE TABLE IF NOT EXISTS mata_pelajaran (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    deskripsi TEXT
)";

$conn->query($sql);

// Membuat tabel pengalaman
$sql = "CREATE TABLE IF NOT EXISTS pengalaman (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    pengajar_id INT(11),
    tahun YEAR,
    deskripsi TEXT,
    FOREIGN KEY (pengajar_id) REFERENCES pengajar(id)
)";

$conn->query($sql);

// Membuat tabel kualifikasi
$sql = "CREATE TABLE IF NOT EXISTS kualifikasi (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    pengajar_id INT(11),
    gelar VARCHAR(100),
    institusi VARCHAR(100),
    tahun_lulus YEAR,
    FOREIGN KEY (pengajar_id) REFERENCES pengajar(id)
)";

$conn->query($sql);

$conn->close();
?>
