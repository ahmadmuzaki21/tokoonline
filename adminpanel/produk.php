<?php
    session_start();
    require "../koneksi.php";

    $query = mysqli_query($con, "SELECT * FROM produk");
    $jumlahProduk = mysqli_num_rows($query);

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");
    
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
     <style>
        .no-decoration{
            text-decoration: none;
        }
        form div{
            margin-bottom: 10px;
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
                Produk</li>
            </ol>
         </nav>
         
          <!-- tambah Produk -->
    <div class="my-5 col-12 col-md-6">
        <h3>Tambah Produk</h3>

        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control" autocomplete="off"
                required>
            </div>
            <div>
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" class="form-control" required>
                    <option value="">Pilih Satu</option>
                    <?php
                    while($data=mysqli_fetch_array($queryKategori)){
                        ?>

                        <option value="<?php echo $data['id'];?>"><?php echo $data['nama'];?></option>
                        <?php
                    }
                    
                    ?>
                </select>
            </div>
            <div>
                <label for="harga">Harga</label>
                <input type="number" class="form-control" name="harga" required>
            </div>
            <div>
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control">
            </div>
            <div>
                <label for="detail">Detail</label>
                <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div>
                <label for="ketersedian_stok">Ketersedian Stok</label>
                <select name="ketersedian_stok" id="ketersedian_stok" class="form-control">
                    <option value="tersedia">Tersedia</option>
                    <option value="habis">Habis</option>
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
            </div>
        </form>

        <?php
             if(isset($_POST['simpan'])){
                $nama = htmlspecialchars($_POST['nama']??'');
                $kategori = htmlspecialchars($_POST['kategori']);
                $harga = htmlspecialchars($_POST['harga']);
                $detail = htmlspecialchars($_POST['detail']);
                $ketersedian_stok = htmlspecialchars($_POST['ketersedian_stok']);

                $target_dir = "../image/";
                $nama_file = basename($_FILES["foto"]["name"]);
                $target_file = $target_dir . $nama_file;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $image_size = $_FILES["foto"]["size"];
                $random_name = generateRandomString(20);
                $new_name = $random_name . "." . $imageFileType;

                


                if($nama=='' || $kategori=='' || $harga==''){
        ?>
                   <div class="alert alert-warning mt-3" role="alert">
                            Nama, Kategori dan harga wajib di isi
                   </div>    
        <?php
                }
                else{
                    if($nama_file!=''){
                        if($image_size > 500000){
        ?>
                   <div class="alert alert-warning mt-3" role="alert">
                            File tidak boleh lebih dari 100kb
                   </div>    
        <?php
                        }
                        else{
                            if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType !=
                            'gif'){
        ?>
                   <div class="alert alert-warning mt-3" role="alert">
                            File wajib bertipe jpg atau png atau gif
                   </div>    
        <?php
                            }
                            else{
                                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir .
                            $new_name);
                            }
                        }
                        
                    }

                    // query insert to produk table//
                    $queryTambah = mysqli_query($con, "INSERT INTO produk (kategori_id, nama, harga,
                    foto, detail, ketersedian_stok) VALUES('$kategori', '$nama', '$harga', 
                    '$new_name', '$detail', '$ketersedian_stok') ");
                    if($queryTambah){
         ?>
                   <div class="alert alert-primary mt-3" role="alert">
                            Produk Berhasil Tersimpan
                   </div>    
                   <meta http-equiv="refresh" content="1; url=produk.php" />
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
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Ketersedian Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                           if($jumlahProduk==0){
                            ?>
                            <tr>
                            <td colspan=5 class="text-center">Data Produk tidak tersedia</td>
                           </tr>
                            <?php
                           }
                           else{
                            $jumlah = 1;
                            while($data=mysqli_fetch_array($query)){
                                ?>
                                <tr>
                                    <td><?php echo $jumlah; ?></td>
                                    <td><?php echo $data['nama'];?></td>
                                    <td><?php echo $data['kategori_id'];?></td>
                                    <td><?php echo $data['harga'];?></td>
                                    <td><?php echo $data['ketersedian_stok'];?></td>
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