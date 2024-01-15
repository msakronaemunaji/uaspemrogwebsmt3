<?php include 'koneksi.php';

if (isset($_POST['btnProses']) && $_POST['btnProses'] == 'upload') {
  
    $id_detail = $_POST['id_detail'];
    $qty = $_POST['qty'];
    $harga = $_POST['harga'];
    $pembelian_id_pembelian = $_POST['pembelian_id_pembelian'];
    $produk_id = $_POST['produk_id'];
    
    mysqli_query($koneksi,"INSERT INTO detail_pembelian VALUES('$id_detail', '$qty', '$harga', '$pembelian_id_pembelian', '$produk_id')");
    echo '<script>alert("Data Berhasil ditambahkan"); document.location.href = "halamanutama.php"; </script>';
    
}else{

    // Inisialisasi variabel
    $id_detail = $_POST['id_detail'];
    $qty = $_POST['qty'];
    $harga = $_POST['harga'];
    $pembelian_id_pembelian = $_POST['pembelian_id_pembelian'];
    $produk_id = $_POST['produk_id'];

    // Gunakan prepared statement untuk mencegah serangan SQL injection
    $stmt = $koneksi->prepare("UPDATE detail_pembelian SET qty=?, harga=?, pembelian_id_pembelian=?, produk_id=? WHERE id_detail=?");
    $stmt->bind_param("sssss", $qty, $harga, $pembelian_id_pembelian, $produk_id, $id_detail);
    $stmt->execute();
    $stmt->close();

    echo '<script>alert("Data Berhasil Diedit"); document.location.href = "halamanutama.php"; </script>';
}






?>
