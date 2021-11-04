<!-- <?php
session_start();
# jika saat load halaman ini, pastikan telah login
# sbg petugas
// if (!isset($_SESSION["petugas"])) {
//     header("location:login.php");
// }
// ?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Mobil</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
       <div class="card">
           <div class="card-header bg-dark">
               <h4 class="text-white">
                   Daftar Mobil
               </h4>
           </div>

           <div class="card-body">
               <form action="list-buku.php" method="get">
                   <input type="text" name="search"
                   class="form-control mb-2"
                   placeholder="Masukkan Keyword Pencarian" />
               </form>

               <ul class="list-group">
                   <?php
                   include "connection.php"; 
                   if(isset($_GET["search"])){
                       $cari = $_GET["search"];
                       $sql = "select * from mobil 
                       where nomor_mobil like '%$cari%' 
                       or merk like '%$cari%'
                       or jenis like '%$cari%'
                       or tahun_pembuatan like '%$cari%' or warna like '%$cari'";
                   }else{
                       $sql = "select * from mobil";
                   }

                   # eksekusi SQL
                   $hasil = mysqli_query($connect, $sql);
                   while ($mobil = mysqli_fetch_array($hasil)) {
                       ?>
                       <li class="list-group-item">
                           <div class="row">
                               <div class="col-lg-4">
                                   <!-- untuk gambar -->
                                   <img src="foto/fortuner.jpg?>"
                                   width="300" />
                               </div>
                               <div class="col-lg-6">
                                   <!-- untuk deskripsi mobil -->
                                   <h5><?=$mobil["merk"]?></h5>
                                   <h6>Nomor mobil: <?=$mobil["nomor_mobil"]?></h6>
                                   <h6>Jenis Mobil: <?=$mobil["jenis"]?></h6>
                                   <h6>Warna: <?=$mobil["warna"]?></h6>
                                   <h6>Tahun Pembuatan: <?=$mobil["tahun_pembuatan"]?></h6>
                               </div>
                               <div class="col-lg-2">
                                   <a href="form-mobil.php?id_mobil=<?=$mobil["id_mobil"]?>">
                                        <button class="btn btn-info btn-block">
                                            Edit
                                        </button>
                                    </a>

                                    <a href="process-mobil.php?isbn=<?=$mobil["id_mobil"]?>"
                                    onclick="return confirm('Are you sure?')">
                                        <button class="btn btn-danger btn-block">
                                            Hapus
                                        </button>
                                    </a>
                                   
                               </div>
                           </div>
                       </li>
                       <?php
                }
                   ?>
               </ul>
           </div>
       </div> 
    </div>
</body>
</html>