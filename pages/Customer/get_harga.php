<?php
include('../../koneksi.php');

if (isset($_GET['unit_id'])) {
    $unit_id = intval($_GET['unit_id']);

    $sql = "SELECT jm.harga_sewa 
            FROM unit_mobil um
            JOIN jenis_mobil jm ON um.jenis_mobil_id = jm.id
            WHERE um.id = ?";

    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $unit_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    echo json_encode(['harga' => $result['harga_sewa']]);
}
