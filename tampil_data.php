<?php
session_start();

include("koneksi.php");
include("functions.php");

$user_data = check_login($koneksi);

$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "jwd";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        body {
            width: 1000px;
            margin: auto;
            
        }

        .card {
            margin-top: 10px;
        }

    </style>
</head>
<body>
    <!-- untuk mengeluarkan data -->
<div class="card">
   <div class="card-header text-white bg-secondary">
       Data Barang
   </div>
   <div class="card-body">
       <table class="table">
           <thead>
               <tr>
                   <th scope="col">#</th>
                   <th scope="col">NO</th>
                   <th scope="col">Nama Merek</th>
                   <th scope="col">Warna</th>
                   <th scope="col">Jumlah</th>
                   <th scope="col">Aksi</th>
               </tr>
           </thead>
           <tbody>
               <?php
               $sql2   = "select * from barang order by id desc";
               $q2     = mysqli_query($koneksi, $sql2);
               $urut   = 1;
               while ($r2 = mysqli_fetch_array($q2)) {
                   $id         = $r2['id'];
                   $no        = $r2['no'];
                   $merek       = $r2['merek'];
                   $warna     = $r2['warna'];
                   $jumlah   = $r2['jumlah'];

               ?>
                   <tr>
                       <th scope="row"><?php echo $urut++ ?></th>
                       <td scope="row"><?php echo $no ?></td>
                       <td scope="row"><?php echo $merek ?></td>
                       <td scope="row"><?php echo $warna ?></td>
                       <td scope="row"><?php echo $jumlah ?></td>
                       <td scope="row">
                           <a href="crud.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                           <a href="crud.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
                       </td>
                   </tr>
               <?php
               }
               ?>
           </tbody>
           
       </table>
   </div>
</div>
<a href="crud.php">Tambah Data</a>&nbsp;&nbsp;
<a href="datatable.php">Export Data</a>
</body>
</html>













