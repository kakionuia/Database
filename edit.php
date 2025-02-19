<!DOCTYPE html>
<?php
include "../percobaan/service/database.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="../AurelBS/css/bootstrap.min.css">
    <style>
        body {
            background: #FFAA6E;
        }
    </style>
</head>

<body>
    <div class="card w-50 mx-auto mt-5">
        <div class="card-header text-white bg-secondary">
            <h3>Edit data pengunjung cafe</h3>
        </div>
        <div class="card-body d-flex">
            <form action="" method="post">
                <table class="table">
                    <tr>
                        <td width="120">Id</td>
                        <td><input type="number" name="id" value="" required></td>
                    </tr>
                    <tr>
                        <td width="120">Username</td>
                        <td><input type="text" name="name" value="" required></td>
                    </tr>
                    <tr>
                        <td width="120">Nama</td>
                        <td><input type="text" name="pengguna" value="" required></td>
                    </tr>
                    <tr>
                        <td width="120">Password</td>
                        <td><input type="password" name="password" value="" required></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Submit" name="Submit" class="btn btn-primary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <?php
    if (isset($_POST['Submit'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $pengguna = $_POST['pengguna'];
        $password = $_POST['password'];

        $update_sql = "UPDATE user SET name='$name', pengguna='$pengguna', password='$password' WHERE id='$id'";

        $update = mysqli_query($conn, $update_sql);

        if($update){
            echo "Data berhasil diupdate";
            header("Location: ../percobaan/data.php");
        } else {
            echo "Data gagal diupdate";
        }
    }

    ?>
</body>

</html>
