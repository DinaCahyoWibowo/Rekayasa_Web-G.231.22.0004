<?php
class Rest {
    private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "json"; // Nama database
    private $wstTable = 'wisata'; // Nama tabel
    private $dbConnect = null; // Initially null, should be set to a valid mysqli object

    // Fungsi __construct untuk koneksi ke database
    public function __construct(){
        // Create database connection
        $this->dbConnect = new mysqli($this->host, $this->user, $this->password, $this->database);

        // Check if the connection was successful
        if ($this->dbConnect->connect_error) {
            die("Error: Failed to connect to MySQL: " . $this->dbConnect->connect_error);
        }
    }

    // Fungsi untuk membaca data wisata
    public function getWisata($wstId = null) {
        // Ensure dbConnect is valid before running queries
        if ($this->dbConnect instanceof mysqli) {
            $sqlQuery = "SELECT id_wisata, kota, landmark, tarif FROM ".$this->wstTable;
            if ($wstId) {
                $sqlQuery .= " WHERE id_wisata = '".$wstId."'";
            }
            $sqlQuery .= " ORDER BY id_wisata ASC";

            $resultData = $this->dbConnect->query($sqlQuery); // Using query instead of mysqli_query

            if (!$resultData) {
                die("Error in query: " . $this->dbConnect->error);
            }

            $wstData = array();
            while($wstRecord = $resultData->fetch_assoc()) {
                $wstData[] = $wstRecord;
            }

            header('Content-Type: application/json');
            echo json_encode($wstData);
        } else {
            die("Database connection failed.");
        }
    }

    // Fungsi untuk menambahkan data wisata
    public function insertWisata($wstData) {
        if ($this->dbConnect instanceof mysqli) {
            $wstKota = $wstData["kota"];
            $wstLandmark = $wstData["landmark"];
            $wstTarif = $wstData["tarif"];

            $sqlQuery = "INSERT INTO ".$this->wstTable." (kota, landmark, tarif) VALUES ('".$wstKota."', '".$wstLandmark."', '".$wstTarif."')";

            $insertResult = $this->dbConnect->query($sqlQuery);

            if (!$insertResult) {
                die("Error in query: " . $this->dbConnect->error);
            }

            if ($this->dbConnect->affected_rows > 0) {
                $message = "Wisata berhasil ditambahkan.";
                $status = 1;
            } else {
                $message = "Wisata gagal ditambahkan.";
                $status = 0;
            }

            $wstResponse = array('status' => $status, 'status_message' => $message);
            header('Content-Type: application/json');
            echo json_encode($wstResponse);
        } else {
            die("Database connection failed.");
        }
    }

    // Fungsi untuk memperbarui data wisata
    public function updateWisata($wstData) {
        if ($this->dbConnect instanceof mysqli) {
            if (isset($wstData["id"])) {
                $wstId = $wstData["id"];
                $wstKota = $wstData["kota"];
                $wstLandmark = $wstData["landmark"];
                $wstTarif = $wstData["tarif"];

                $sqlQuery = "UPDATE ".$this->wstTable." SET kota='".$wstKota."', landmark='".$wstLandmark."', tarif='".$wstTarif."' WHERE id_wisata = '".$wstId."'";

                $updateResult = $this->dbConnect->query($sqlQuery);

                if (!$updateResult) {
                    die("Error in query: " . $this->dbConnect->error);
                }

                if ($this->dbConnect->affected_rows > 0) {
                    $message = "Wisata berhasil diperbarui.";
                    $status = 1;
                } else {
                    $message = "Wisata gagal diperbarui.";
                    $status = 0;
                }
            } else {
                $message = "Invalid request: Missing ID.";
                $status = 0;
            }

            $wstResponse = array('status' => $status, 'status_message' => $message);
            header('Content-Type: application/json');
            echo json_encode($wstResponse);
        } else {
            die("Database connection failed.");
        }
    }

    // Fungsi untuk menghapus data wisata
    public function deleteWisata($wstId) {
        if ($this->dbConnect instanceof mysqli) {
            if ($wstId) {
                $sqlQuery = "DELETE FROM ".$this->wstTable." WHERE id_wisata = '".$wstId."'";

                $deleteResult = $this->dbConnect->query($sqlQuery);

                if (!$deleteResult) {
                    die("Error in query: " . $this->dbConnect->error);
                }

                if ($this->dbConnect->affected_rows > 0) {
                    $message = "Wisata berhasil dihapus.";
                    $status = 1;
                } else {
                    $message = "Wisata gagal dihapus.";
                    $status = 0;
                }
            } else {
                $message = "Invalid request: Missing ID.";
                $status = 0;
            }

            $wstResponse = array('status' => $status, 'status_message' => $message);
            header('Content-Type: application/json');
            echo json_encode($wstResponse);
        } else {
            die("Database connection failed.");
        }
    }
}
?>
