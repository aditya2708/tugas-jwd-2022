<?php

include 'koneksi.php';

session_start();

	include("koneksi.php");
	include("functions.php");

	$user_data = check_login($koneksi);

$no        = "";
$merek       = "";
$warna     = "";
$jumlah   = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id         = $_GET['id'];
    $sql1       = "delete from barang where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "select * from barang where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $no        = $r1['no'];
    $merek       = $r1['merek'];
    $warna     = $r1['warna'];
    $jumlah   = $r1['jumlah'];

    if ($no == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $no        = $_POST['no'];
    $merek       = $_POST['merek'];
    $warna     = $_POST['warna'];
    $jumlah   = $_POST['jumlah'];

    if ($no && $merek && $warna && $jumlah) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update barang set no = '$no',merek ='$merek',warna = '$warna',jumlah='$jumlah' where id = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into barang(no,merek,warna,jumlah) values ('$no','$merek','$warna','$jumlah')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
if (isset($_POST['kembali'])){
    header('location: index.php');
};
if (isset($_POST['ulangi'])){
    header('location: index.php');
};
if (isset($_POST['lihat_data'])){
    header('location: tampil_data.php');
};

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Tambah Data Barang
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="no" class="col-sm-2 col-form-label">NO</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="no" name="no" value="<?php echo $no ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="merek" class="col-sm-2 col-form-label">Merek</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="merek" name="merek" value="<?php echo $merek ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="warna" class="col-sm-2 col-form-label">Warna</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="warna" name="warna" value="<?php echo $warna ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?php echo $jumlah ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                        <input type="submit" name="ulangi" value="Ulangi" class="btn btn-primary" />
                        <input type="submit" name="kembali" value="Kembali" class="btn btn-primary" />
                    </div>
                    
                       
                   
                </form>
            </div>
        </div>

                <!--LIHAT DATA--->
                <br><br>
                <a href="tampil_data.php">Lihat Data</a>
    </div>
</body>

</html>
