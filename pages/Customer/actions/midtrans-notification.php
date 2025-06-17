<?php
// midtrans-notification.php

$raw = file_get_contents("php://input");
file_put_contents("notif_log.txt", $raw); // debug: log isi notifikasi

$data = json_decode($raw, true);

if ($data) {
    // lakukan update status booking di database
    // contoh:
    // update_status($data['order_id'], $data['transaction_status']);
} else {
    file_put_contents("notif_log.txt", "Invalid JSON received");
}

http_response_code(200); // <- penting agar Midtrans tahu berhasil
