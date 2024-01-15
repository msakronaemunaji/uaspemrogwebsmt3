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
$alamat = "";
$nomor_hp = "";
$sukses = "";
$error = "";

$sql_get_last_id = "SELECT MAX(id) AS max_id FROM pembeli";
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
    $sql1 = "SELECT * FROM pembeli WHERE id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $id = $r1['id'];
    $nama = $r1['nama'];
    $alamat = $r1['alamat'];
    $nomor_hp = $r1['nomor_hp'];

    if ($id == '') {
        $error = "Data tidak ditemukan";
    }
}

if($op == 'delete'){
    $id = $_GET['id'];
    $sql1 = "DELETE FROM pembeli WHERE id = '$id'";
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
    $alamat = $_POST['alamat'];
    $nomor_hp = $_POST['nomor_hp'];

    $sql_check_id = "SELECT * FROM pembeli WHERE id = '$id'";
    $result_check_id = mysqli_query($koneksi, $sql_check_id);

        // Periksa apakah semua data diisi
        if ($id && $nama && $alamat && $nomor_hp) {
            if ($op == 'edit') {
                $sql1 = "UPDATE pembeli SET id = '$id',nama = '$nama',alamat = '$alamat',nomor_hp='$nomor_hp' WHERE id = '$id'";
                $q1 = mysqli_query($koneksi, $sql1);
                if ($q1) {
                    $sukses = "Data berhasil diperbarui";
                } else {
                    $error = "Data gagal diperbarui";
                }
            } elseif (mysqli_num_rows($result_check_id) > 0) {
                $error = "ID sudah ada dalam database. Gunakan ID yang berbeda.";
            }else {
                $sql1 = "INSERT INTO pembeli (id, nama, alamat, nomor_hp) VALUES ('$id', '$nama', '$alamat', '$nomor_hp')";
                $q1 = mysqli_query($koneksi, $sql1);
                if ($q1) {
                    $sukses = "Data berhasil ditambahkan";
                    $id = $nama = $alamat = $nomor_hp = '';
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
                    header("refresh:5;url=pembeli.php");
                }
                ?>    
                <?php
                if ($sukses) {
                    ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                    <?php
                    header("refresh:5;url=pembeli.php");
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
                        <label for="alamat" class="col-sm-2 col-form-label">alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                value="<?php echo $alamat ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nomor_hp" class="col-sm-2 col-form-label">nomor hp</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nomor_hp" name="nomor_hp"
                                value="<?php echo $nomor_hp ?>">
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
                Data pembeli
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Nomor HP</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2 = "SELECT * FROM pembeli";
                        $q2 = mysqli_query($koneksi, $sql2);
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id = $r2['id'];
                            $nama = $r2['nama'];
                            $alamat = $r2['alamat'];
                            $nomor_hp = $r2['nomor_hp'];
                            ?>
                            <tr>
                                <td scope="row">
                                    <?php echo $id ?>
                                </td>
                                <td scope="row">
                                    <?php echo $nama ?>
                                </td>
                                <td scope="row">
                                    <?php echo $alamat ?>
                                </td>
                                <td scope="row">
                                    <?php echo $nomor_hp ?>
                                </td>
                                <td scope="row">
                                    <a href="pembeli.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-primary">Edit</button></a>
                                    <a href="pembeli.php?op=delete&id=<?php echo $id ?>"><button type="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</button></a>
                                    
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