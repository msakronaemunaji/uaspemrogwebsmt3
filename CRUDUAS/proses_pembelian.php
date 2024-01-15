<?php include 'koneksi.php';

if (isset($_POST['btnProses']) && $_POST['btnProses'] == 'upload') {
  
    $id_pembelian = $_POST['id_pembelian'];
    $tanggal_pembelian = $_POST['tgl_pembelian'];
    $pembeli_id = $_POST['pembeli_id'];
    
    mysqli_query($koneksi,"INSERT INTO pembelian VALUES('$id_pembelian', '$tgl_pembelian', '$pembeli_id')");
    echo '<script>alert("Data Berhasil ditambahkan"); document.location.href = "halamanutama.php"; </script>';

} else {

    // Inisialisasi variabel
    $id_pembelian = $_POST['id_pembelian'];
    $tanggal_pembelian = $_POST['tgl_pembelian'];
    $pembeli_id = $_POST['pembeli_id'];
 
    // Gunakan prepared statement untuk mencegah serangan SQL injection
    $stmt = $koneksi->prepare("UPDATE pembelian SET tgl_pembelian=?, pembeli_id=? WHERE id_pembelian=?");
    $stmt->bind_param("sss", $tgl_pembelian, $pembeli_id, $id_pembelian);
    $stmt->execute();
    $stmt->close();
 
    echo '<script>alert("Data Berhasil Diedit"); document.location.href = "halamanutama.php"; </script>';
}
?>





?>
