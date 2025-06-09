<?php
    session_start();
    require "../koneksi.php";

    $id = $_GET['p'];

    $query = mysqli_query($con, "SELECT * FROM kategori WHERE id='$id'");
    $data = mysqli_fetch_array($query);
    


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-5">
      <h2>Detail Kategori</h2>

        <div class="col-12 col-md-6">
           <form action="" method="post">
            <div>
                <label for="Kategori">Kategori</label>
                 <input type="text"  name="kategori" id="kategori" class="form-control" value="<?php echo
                $data['nama'];?>">
             </div>
             <div class="mt-5 d-flex justify-content-between">
                <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
                <button type="submit" class="btn btn-danger" name="deleteBtn">Delete</button>
             </div>
           </form>

           <?php
           if(isset($_POST['editBtn'])){
               $kategori = htmlspecialchars($_POST['kategori']);

               if($data['nama']==$kategori){
                ?>
                    <meta http-equiv="refresh" content="1; url=kategori.php" />
                <?php
            }
            else{
                $query = mysqli_query($con, "SELECT * FROM kategori WHERE nama='$kategori'");
                $jumlahdata = mysqli_num_rows($query);

                if($jumlahdata > 0){
                    ?>
                     <div class="alert alert-primary mt-3" role="alert">
                            Kategori Sudah Ada
                     </div>
                    <?php
                }
                else{
                    $querySimpan = mysqli_query($con, "UPDATE kategori SET nama='$kategori' WHERE
                    id='$id'");

                        if($querySimpan){
                            ?>
                            <div class="alert alert-primary mt-3" role="alert">
                            Kategori Berasil Diupdate
                            </div>
                            <meta http-equiv="refresh" content="1; url=kategori.php" />
                            <?php
                        }
                        else{
                            echo mysqli_error($con);
                        }
                }
            }
           }
           
           if(isset($_POST['deleteBtn'])){
            $queryDelete = mysqli_query($con, "DELETE FROM kategori Where id='$id'");

            if($queryDelete){
                ?>
                <div class="alert alert-primary mt-3" role="alert">
                            Kategori Berasil Dihapus
                </div>
                <meta http-equiv="refresh" content="1; url=kategori.php" />
                <?php
            }
            else{
                echo mysqli_error($con);
            }
           }
           ?>
        </div>
    </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>