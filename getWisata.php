<?php
// Koneksi ke database
$connect = mysqli_connect("localhost", "root", "", "json");

// Query untuk mengambil data dari tabel wisata
$sql = "SELECT * FROM wisata";
$result = mysqli_query($connect, $sql);

// Array untuk menyimpan data JSON
$json_array = array();

while($row = mysqli_fetch_assoc($result)) {
    $json_array[] = $row;
}

// Encode array ke format JSON dan tampilkan
echo json_encode($json_array);
?>
