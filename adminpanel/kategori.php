<?php
    session_start();
    require "../koneksi.php";

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");
    $jumlahKategori = mysqli_num_rows($queryKategori);
    




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .no-decoration{
            text-decoration: none;
        }







    </style>

</head>
<body>
      <?php require "navbar.php"; ?>
       <div class="container mt-5">
         <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page"> 
                <a href="../adminpanel/" class="no-decoration text-muted"></a><i class="fa-solid fa-house"></i> Home</li>
              <li class="breadcrumb-item active" aria-current="page">
                Kategori</li>
            </ol>
         </nav>

         <div class="my-5 col-12 col-md-6">
            <h3>Tambah Kategori</h3>

            <form action="" method="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" id="kategori" name="kategori" placeholder="input nama kategori"
                    class="form-control">
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="submit"
                    name="simpan_kategori">Simpan</button>
                </div>
            </form>

            <?php
                if(isset($_POST['simpan_kategori'])){
                    $kategori = htmlspecialchars($_POST['kategori']);

                    $queryExist = mysqli_query($con, "SELECT nama FROM kategori WHERE
                    nama='$kategori'");
                    $jumlahDataKatagoriBaru = mysqli_num_rows($queryExist);

                    if($jumlahDataKatagoriBaru > 0){
                        ?>
                        <div class="alert alert-primary mt-3" role="alert">
                            Kategori Sudah Ada
                        </div>
                        <?php

                    }
                    else{
                        $querySimpan = mysqli_query($con, "INSERT INTO kategori (nama) VAlUES
                        ('$kategori')");

                        if($querySimpan){
                            ?>
                            <div class="alert alert-primary mt-3" role="alert">
                            Kategori Berasil Tersimpan
                            </div>
                            <meta http-equiv="refresh" content="1; url=kategori.php" />
                            <?php

                        }
                        else{
                            echo mysqli_error($con);
                        }
                    }
                }   
            ?>
         </div>


         <div class="mt-3">
            <h2>List Kategori</h2>

            <div class="table-responsive mt-5">
                <table class="table ">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if($jumlahKategori==0){
                        ?>
                           <tr>
                            <td colspan=3 class="text-center">Data kategori tidak tersedia</td>
                           </tr>

                        <?php
                            }
                            else{
                                $jumlah = 1;
                                while($data=mysqli_fetch_array($queryKategori)){
                        ?>
                                <tr>
                                    <td><?php echo $jumlah; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td>
                                        <a href="kategori-detail.php?p=<?php echo $data['id']; ?>"
                                        class="btn btn-info"><i class="fas fa-search"></i></a>
                                    </td>
                                </tr>
                        
                        <?php
                                $jumlah++;
                                }
                            }                       
                        ?>
                  
                    </tbody>
                </table>
            </div>
         </div>
       </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
       <script src="https://kit.fontawesome.com/YOUR-KIT-ID.js" crossorigin="anonymous"></script>
</body>
</html>