<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "user";
$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak bisa terkoneksi ke database");
}
$id = "";
$nama = "";
$harga = "";
$stok = "";
$jenis_jenis_id = "";
$sukses = "";
$error = "";

$sql_get_last_id = "SELECT MAX(id) AS max_id FROM produk";
$result_get_last_id = mysqli_query($koneksi, $sql_get_last_id);
$row = mysqli_fetch_assoc($result_get_last_id);
$next_id = $row['max_id'] + 1;

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'edit') {
    $id = $_GET['id'];
    $sql1 = "SELECT * FROM produk WHERE id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $id = $r1['id'];
    $nama = $r1['nama'];
    $harga = $r1['harga'];
    $stok = $r1['stok'];
    $jenis_jenis_id = $r1['jenis_jenis_id'];

    if ($id == '') {
        $error = "Data tidak ditemukan";
    }
}

if($op == 'delete'){
    $id = $_GET['id'];
    $sql1 = "DELETE FROM produk WHERE id = '$id'";
    $q1 = mysqli_query($koneksi,$sql1);
    if ($q1) {
        $sukses = "data berhasil dihapus";
    }else {
        $error  = "data gagal dihapus";
    }
}

if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $jenis_jenis_id = $_POST['jenis_jenis_id'];

    $sql_check_id = "SELECT * FROM produk WHERE id = '$id'";
    $result_check_id = mysqli_query($koneksi, $sql_check_id);

        // Periksa apakah semua data diisi
        if ($id && $nama && $harga && $stok && $jenis_jenis_id) {
            if ($op == 'edit') {
                $sql1 = "UPDATE produk SET id = '$id',nama = '$nama',harga = '$harga',stok='$stok',jenis_jenis_id = '$jenis_jenis_id' WHERE id = '$id'";
                $q1 = mysqli_query($koneksi, $sql1);
                if ($q1) {
                    $sukses = "Data berhasil diperbarui";
                } else {
                    $error = "Data gagal diperbarui";
                }
            } elseif (mysqli_num_rows($result_check_id) > 0) {
                $error = "ID sudah ada dalam database. Gunakan ID yang berbeda.";
            }else {
                $sql1 = "INSERT INTO produk (id, nama, harga, stok, jenis_jenis_id) VALUES ('$id', '$nama', '$harga', '$stok', '$jenis_jenis_id')";
                $q1 = mysqli_query($koneksi, $sql1);
                if ($q1) {
                    $sukses = "Data berhasil ditambahkan";
                    $id = $nama = $harga = $stok = $jenis_jenis_id =  '';
                } else {
                    $error = "Data gagal ditambahkan";
                }
            }
        } else {
            $error = "Tolong isi semua data";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 1000px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!-- create data -->
        <div class="card">
            <div class="card-header">
                Create / Edit
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                    <?php
                    header("refresh:5;url=produk.php");
                }
                ?>    
                <?php
                if ($sukses) {
                    ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                    <?php
                    header("refresh:5;url=produk.php");
                }
                ?>
                <form action="" method="post">
                    <div class="mb-3 row">
                        <label for="id" class="col-sm-2 col-form-label">id</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="id" name="id"
                                placeholder="<?php echo $next_id ?>" value="<?php echo $id ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="harga" class="col-sm-2 col-form-label">harga</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="harga" name="harga"
                                value="<?php echo $harga ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="stok" class="col-sm-2 col-form-label">stok</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="stok" name="stok"
                                value="<?php echo $stok ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="sjenis_jejnis_id" class="col-sm-2 col-form-label">jenis_jenis_d</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="jenis_jenis_id" name="jenis_jenis_id"
                                value="<?php echo $jenis_jenis_id ?>">
                        </div>
                    </div>

                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-secondary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- show data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data produk
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Stok</th>
                            <th scope="col">jenis_jenis_id</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2 = "SELECT * FROM produk";
                        $q2 = mysqli_query($koneksi, $sql2);
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id = $r2['id'];
                            $nama = $r2['nama'];
                            $harga = $r2['harga'];
                            $stok = $r2['stok'];
                            $jenis_jenis_id = $r2['jenis_jenis_id']
                            ?>
                            <tr>
                                <td scope="row">
                                    <?php echo $id ?>
                                </td>
                                <td scope="row">
                                    <?php echo $nama ?>
                                </td>
                                <td scope="row">
                                    <?php echo $harga ?>
                                </td>
                                <td scope="row">
                                    <?php echo $stok ?>
                                </td>
                                <td scope="row">
                                    <?php echo $jenis_jenis_id ?>
                                </td>
                                <td scope="row">
                                    <a href="produk.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-primary">Edit</button></a>
                                    <a href="produk.php?op=delete&id=<?php echo $id ?>"><button type="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</button></a>
                                    
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>