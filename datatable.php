<?php
session_start();

include("koneksi.php");
include("functions.php");

$user_data = check_login($koneksi);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/af-2.4.0/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/r-2.3.0/datatables.min.css"/>
<style>
    body{
        
        max-width: 1000px;
       
        margin:auto;
       
    }
    #a{
        font-size: 20px;
    }
  
</style>
</head>
<body>
<a href="crud.php" id="a">kembali</a><br><br><br><br>
    <table id="table">
        <thead>
        <tr>
            <th>no</th>
            <th>merek</th>
            <th>warna</th>
            <th>jumlah</th>
        </tr>
        </thead>
        <tbody>
      
    
    <?php
    include 'koneksi.php';
    $barang = mysqli_query($koneksi, "select * from barang");
    while($row = mysqli_fetch_array($barang)){
        echo " <tr>
        <th>".$row['no']."</th>
        <th>".$row['merek']."</th>
        <th>".$row['warna']."</th>
        <th>".$row['jumlah']."</th>
    </tr>";
    }
    ?>
    </tbody>
    </table>


<script>
        $(document).ready(function() {
            var table = $('#table').DataTable( {
                buttons: [ 'copy','print', 'excel', 'pdf' ],
                dom: 
                "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                "<'row'<'col-md-12'tr>>" +
                "<'row'<'col-md-5'i><'col-md-7'p>>",
                lengthMenu:[
                    [5,10,25,50,100,-1],
                    [5,10,25,50,100,"All"]
                ]
            } );
        
            table.buttons().container()
                .appendTo( '#table_wrapper .col-md-5:eq(0)' );
        } );
    </script>



 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/af-2.4.0/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/r-2.3.0/datatables.min.js"></script>
</body>
</html>