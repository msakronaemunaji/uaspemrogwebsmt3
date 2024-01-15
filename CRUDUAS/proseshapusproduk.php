<?php include 'koneksi.php';

// Inisialisasi variabel
$id = $_GET['hapus'];

// Cek apakah id valid
if (!empty($id)) {

  // Query untuk mengambil data detail produk
  $query_cek = "SELECT * FROM produk WHERE id = '$id'";
  $result_cek = mysqli_query($koneksi, $query_cek);

  // Jika data detail produk ditemukan
  if (mysqli_num_rows($result_cek) > 0) {

    // Query untuk menghapus data
    $query_hapus = "DELETE FROM produk WHERE id= '$id'";
    mysqli_query($koneksi, $query_hapus);

    // Tampilkan pesan konfirmasi dan redirect ke halaman index
    echo "<script>alert('Data berhasil dihapus!'); document.location.href = 'halamanutama.php';</script>";

  } else {

    // Tampilkan pesan error dan redirect ke halaman index
    echo "<script>alert('Data detail produk tidak ditemukan!'); document.location.href = 'halamanutama.php';</script>";

  }

} else {

  // Tampilkan pesan error dan redirect ke halaman index
  echo "<script>alert('ID detail produk tidak valid!'); document.location.href = 'halamanutama.php';</script>";

}

?>
