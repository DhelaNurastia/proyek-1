<?php
require_once "../../../koneksi.php";

// === Update UNIT MOBIL ===
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update"]) && isset($_POST["plat_nomor"])) {
    $id = $_POST["id"];
    $plat_nomor = $_POST["plat_nomor"];
    $warna = $_POST["warna"];
    $tahun_beli = $_POST["tahun_beli"];
    $status = $_POST["status"];
    $jenis_mobil_id = $_POST["jenis_mobil_id"];
    $transmisi = $_POST["transmisi"] ?? null;

    // Proses upload foto jika ada
    if (!empty($_FILES["foto"]["name"])) {
        $nama_file = basename($_FILES["foto"]["name"]);
        $target = __DIR__ . "/../../../uploads/foto-mobil/" . $nama_file;
        move_uploaded_file($_FILES["foto"]["tmp_name"], $target);
    } else {
        $nama_file = null;
    }

    if ($nama_file) {
        $stmt = mysqli_prepare($db, "UPDATE unit_mobil SET jenis_mobil_id=?, plat_nomor=?, warna=?, tahun_beli=?, status=?, transmisi=?, foto=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "sssssssi", $jenis_mobil_id, $plat_nomor, $warna, $tahun_beli, $status, $transmisi, $nama_file, $id);
    } else {
        $stmt = mysqli_prepare($db, "UPDATE unit_mobil SET jenis_mobil_id=?, plat_nomor=?, warna=?, tahun_beli=?, status=?, transmisi=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "ssssssi", $jenis_mobil_id, $plat_nomor, $warna, $tahun_beli, $status, $transmisi, $id);
    }

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: index.php?success=Data unit mobil berhasil diperbarui");
    exit;
}

// === Update JENIS MOBIL ===
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update"]) && isset($_POST["nama"])) {
    $id = (int) $_POST["id"];
    $nama = trim($_POST["nama"]);
    $harga_sewa = (int) $_POST["harga_sewa"];
    $jumlah_kursi = (int) $_POST["jumlah_kursi"];

    if (empty($nama) || empty($harga_sewa) || empty($jumlah_kursi)) {
        $error = "Semua field wajib diisi.";
        header("location: edit.php?id=$id&error=" . urlencode($error));
        exit;
    }

    $stmt = mysqli_prepare($db, "UPDATE jenis_mobil SET nama = ?, harga_sewa = ?, jumlah_kursi = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "siii", $nama, $harga_sewa, $jumlah_kursi, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: index.php?success=Data jenis mobil diperbarui");
    exit;
}

// === CREATE JENIS MOBIL ===
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["create"])) {
    $jenis_mobil_id = $_POST["jenis_mobil_id"];
    $plat_nomor = $_POST["plat_nomor"];
    $warna = $_POST["warna"];
    $tahun_beli = $_POST["tahun_beli"];
    $status = $_POST["status"];
    $transmisi = $_POST["transmisi"];

    // Proses upload foto
    $foto = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['foto']['tmp_name'];
        $foto = time() . '_' . basename($_FILES['foto']['name']);
        move_uploaded_file($tmp_name, __DIR__ . "/../../../uploads/dokumen-user/foto-mobil/" . $foto);
    }

    // Simpan ke database
    $stmt = mysqli_prepare($db, "INSERT INTO unit_mobil (jenis_mobil_id, plat_nomor, warna, tahun_beli, status, foto, transmisi) VALUES (?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "issssss", $jenis_mobil_id, $plat_nomor, $warna, $tahun_beli, $status, $foto, $transmisi);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Redirect ke index
    header("Location: index.php?success=Berhasil menambah unit");
    exit;
}

// Hapus data unit mobil
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];

    // Hapus dari database
    $stmt = $db->prepare("DELETE FROM unit_mobil WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    // Redirect kembali ke index
    header("Location: index.php?success=Data berhasil dihapus");
    exit;
}
