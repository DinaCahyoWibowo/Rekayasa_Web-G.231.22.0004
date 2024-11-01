<?php
// Fungsi curl untuk mengambil data JSON dari URL
function curl($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

// Mengambil data JSON dari URL getWisata.php
$send = curl("http://localhost/rekayasa%20Web/getWisata.php");

// Mengubah data JSON menjadi array PHP
$data = json_decode($send, TRUE);

// Periksa apakah data berhasil di-decode
if(is_array($data)) {
    // Menampilkan hasil dalam bentuk tabel HTML
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>KOTA</th><th>LANDMARK</th><th>TARIF</th></tr>";

    foreach($data as $row) {
        echo "<tr>";
        echo "<td>" . $row["kota"] . "</td>";
        echo "<td>" . $row["landmark"] . "</td>";
        echo "<td>" . $row["tarif"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    // Jika data tidak valid, tampilkan pesan kesalahan
    echo "Tidak ada data yang dapat ditampilkan atau data JSON tidak valid.";
}
?>
