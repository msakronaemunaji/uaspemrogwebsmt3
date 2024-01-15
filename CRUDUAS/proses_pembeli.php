<?php include 'koneksi.php';

if (isset($_POST['btnProses']) && $_POST['btnProses'] == 'upload') {
  
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $nohp = $_POST['no_hp'];
    
    mysqli_query($koneksi,"INSERT INTO pembeli VALUES('$id', '$nama', '$alamat', '$nohp')");
    echo '<script>alert("Data Berhasil ditambahkan"); document.location.href = "index.php"; </script>';
}
?>
