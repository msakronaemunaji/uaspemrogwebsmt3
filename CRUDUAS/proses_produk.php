<?php include 'koneksi.php';

if (isset($_POST['btnProses']) && $_POST['btnProses'] == 'upload') {
  
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $jenis_jenis_id = $_POST['jenis_jenis_id'];
    
    mysqli_query($koneksi,"INSERT INTO produk VALUES('$id', '$nama', '$harga', '$stok', '$jenis_jenis_id')");
    echo '<script>alert("Data Berhasil ditambahkan"); document.location.href = "halamanutama.php"; </script>';

}else{

    // Inisialisasi variabel
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $jenis_jenis_id = $_POST['jenis_jenis_id'];

    // Gunakan prepared statement untuk mencegah serangan SQL injection
    $stmt = $koneksi->prepare("UPDATE produk SET nama=?,harga =?, stok=?, jenis_jenis_id=? ,  WHERE id=?");
    $stmt->bind_param("sssss", $nama, $harga, $stok, $jenis_jenis_id, $id);
    $stmt->execute();
    $stmt->close();

    echo '<script>alert("Data Berhasil Diedit"); document.location.href = "halamanutama.php"; </script>';
}

// Inisialisasi variabel
$id = $_GET['hapus'];

// Cek apakah id_detail valid
if (!empty($id)) {

  // Query untuk mengambil data detail pembelian
  $query_cek = "SELECT * FROM produk  WHERE id = '$id'";
  $result_cek = mysqli_query($koneksi, $query_cek);

  // Jika data detail pembelian ditemukan
  if (mysqli_num_rows($result_cek) > 0) {

    // Query untuk menghapus data
    $query_hapus = "DELETE FROM produk WHERE id_detail = '$id'";
    mysqli_query($koneksi, $query_hapus);

    // Tampilkan pesan konfirmasi dan redirect ke halaman index
    echo "<script>alert('Data berhasil dihapus!'); document.location.href = 'halamanutama.php';</script>";

  } else {

    // Tampilkan pesan error dan redirect ke halaman index
    echo "<script>alert('Data detail pembelian tidak ditemukan!'); document.location.href = 'halamanutama.php';</script>";

  }

} else {

  // Tampilkan pesan error dan redirect ke halaman index
  echo "<script>alert('ID detail pembelian tidak valid!'); document.location.href = 'halamanutama.php';</script>";



}
?>
