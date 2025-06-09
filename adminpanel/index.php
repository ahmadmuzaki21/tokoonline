<?php
    require "session.php";
    require "../koneksi.php";


    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");
    $jumlahKategori = mysqli_num_rows($queryKategori);
    
    $queryProduk = mysqli_query($con, "SELECT * FROM produk");
    $jumlahProduk = mysqli_num_rows($queryProduk);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>
        .kotak { 
            border: solid;
        }

        .summary-kategori{
            background-color: #0a6b4a;
            border-radius: 15px;
        }
        .summary-produk{
            background-color: #0a516b;
            border-radius: 15px;
        }
        .no-decoration {
            text-decoration: none;
        }
        .no-decoration::hover{
            color: blue;
        }






    </style>


</head>
<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page"> <i class="fa-solid fa-house"></i> Home</li>
          </ol>
        </nav>
        <h2>haloooooooooooooooo <?php echo $_SESSION['username']; ?></h2>

        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="summary-kategori p-3">

                    <div class="row">
                        <div class="col-6">
                       <i class="fa-solid fa-bars fa-8x"></i>
                    </div>
                    <div class="col-6 text-white">
                        <h3 class="fs-2 text">Kategori</h3>
                        <p class="fs-4"><?php echo  $jumlahKategori;?> Kategori</p>
                        <p><a href="kategori.php" class=" text-white no-decoration">Lihat Ditail</a></p>
                    </div>
                </div>
            </div>
         </div>


                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="summary-produk p-3">
                    <div class="row">
                        <div class="col-6">
                       <i class="fa-solid fa-box fa-8x"></i>
                    </div>
                    <div class="col-6 text-white">
                        <h3 class="fs-2 text">Produk</h3>
                        <p class="fs-4"><?php echo  $jumlahProduk;?> Produk</p>
                        <p><a href="produk.php" class=" text-white no-decoration">Lihat Ditail</a></p>
                    </div>
                    </div>
                    </div>
                </div>






            </div>
        </div>
    </div>



















       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
       <script src="https://kit.fontawesome.com/YOUR-KIT-ID.js" crossorigin="anonymous"></script>
    </body>
</html>