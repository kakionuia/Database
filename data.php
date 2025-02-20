<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../AurelBS/css/bootstrap.min.css">
    <style>
        body{
            background:  #FFAA6E;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="#">Home</a>
        <a class="nav-link" href="#">Features</a>
        <a class="nav-link" href="#">Pricing</a>
        <a class="nav-link disabled">Disabled</a>
      </div>
    </div>
  </div>
</nav>

    <div class="card w-50 mx-auto mt-5">
        <div class="card-header text-white bg-secondary">
            Data Pengunjung Pingu Cafe
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">id</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    require "../percobaan/service/database.php";
                       $no = 1;
                       $data = mysqli_query($conn, "select * from user");
                       while($row = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                        <th scope="row"><?php echo $no++; ?></th>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['pengguna']; ?></td>
                        <td><?php echo $row['password']; ?></td>
                        <td>
                            <a href='edit.php?nama=<?php echo $row['name']; ?>' class="btn btn-warning">Edit</a>
                            <a href="data.php?nama=<?php echo $row['name']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php
                       }  
                       ?>
                </tbody>
            </table>

            <?php 
            if(isset($_GET['nama'])){
                mysqli_query($conn, "delete from user where name = '$_GET[nama]'");
                echo "data berhasil dihapus";
                echo "<meta http-equiv='refresh' content='1;url=data.php'>";
            }
            ?>
        </div>
    </div>

    <script src="../AurelBS/js/bootstrap.js"></script>
</body>
</html>
