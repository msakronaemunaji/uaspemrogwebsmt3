<?php include 'koneksi.php';



// Inisialisasi variabel
$id_detail = $_GET['hapus'];

// Cek apakah id_detail valid
if (!empty($id_detail)) {

  // Query untuk mengambil data detail pembelian
  $query_cek = "SELECT * FROM detail_pembelian WHERE id_detail = '$id_detail'";
  $result_cek = mysqli_query($koneksi, $query_cek);

  // Jika data detail pembelian ditemukan
  if (mysqli_num_rows($result_cek) > 0) {

    // Query untuk menghapus data
    $query_hapus = "DELETE FROM detail_pembelian WHERE id_detail = '$id_detail'";
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
