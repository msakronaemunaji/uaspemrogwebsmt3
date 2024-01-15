<?php include 'koneksi.php';?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>TOKO BANGUNAN</title>
  </head>
  <body>

  <div class="container">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">ADMIN TOKO BANGUNAN</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="produk.php">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pembeli.php">pembeli</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pembelian.php">pembelian</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="detailpembelian.php">Detail Pembelian</a>
        </li>
     
      </ul>
    </div>
  </div>
</nav>

  

  <figure class="text-center">
  <blockquote class="blockquote">
    <p> KELOLA PEMBELI </p>
  </blockquote>

  <form action ="proses_pembeli.php" method="POST">

  <div class="mb-3 row">
    <label for="id" class="col-sm-2 col-form-label">id</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" name="id">
    </div>
  </div>

  <div class="mb-3 row">
    <label for="qty" class="col-sm-2 col-form-label">nama</label></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nama">
    </div>
  </div>

  <div class="mb-3 row">
    <label for="harga" class="col-sm-2 col-form-label">alamat</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="alamat">
    </div>
  </div>

  <div class="mb-3 row">
    <label for="stok" class="col-sm-2 col-form-label">nomor hp</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" name="no_hp">
    </div>
  </div>

    <button type="submit" name="btnProses" value="upload" class="btn btn-primary">Tambah Data</button>
    </form>
  </div>


  


</div>
  






          

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>