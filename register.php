<?php
include "service/database.php";
$message = ""; // Variabel untuk menyimpan pesan

if(isset($_POST['Submit'])){
    $name = $_POST['name'];
    $age = $_POST['age'];

    // Query untuk memasukkan data
    $sql = "INSERT INTO user (name, age) VALUES ('$name', $age)";

    if ($conn->query($sql)) {
        $message = "Data berhasil dimasukkan";
        header("Location: ../percobaan/login.php"); // Mengarahkan ke dashboard

    } else {
        $message = "Error: Data sudah ada, ganti yang lain";
    }
    // Menutup koneksi
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulir Pengguna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFAA6E;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="text"], input[type="password"] {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            padding: 10px;
            background-color: #FFAA6E;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #FFAA6E
        }
        /* CSS untuk jendela peringatan */
        .alert {
            display: none;
            position: fixed;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #f44336; /* Merah untuk error */
            color: white;
            padding: 20px;
            border-radius: 5px;
            z-index: 1000;
        }
        .alert.success {
            background-color: #eee;
            color: #333; /* Hijau untuk sukses */
        }

        .warn {
            margin-top: -25px;
            font-size: 10px;
            margin-bottom: 10px;
            color: #333;
        }

        .login{
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form action="register.php" method="POST">
            Nama: <input type="text" name="name" required><br>
            Password: <input type="password" name="age" required><br>
            <label for="alert" class="warn">*Password hanya bisa diisi angka</label>
            <p >Sudah punya akun? <a href="login.php" class="login">Log-in</a></p>
            <input type="submit" value="Submit" name="Submit">
        </form>
    </div>

    <!-- Jendela Peringatan -->
    <div id="alert" class="alert"></div>

    <script>
        // Menampilkan jendela peringatan jika ada pesan
        <?php if ($message): ?>
            const alertBox = document.getElementById('alert');
            alertBox.textContent = "<?php echo $message; ?>";
            alertBox.classList.add("success"); // Tambahkan kelas sukses jika berhasil
            alertBox.style.display = "block"; // Tampilkan jendela peringatan
            setTimeout(() => {
                alertBox.style.display = "none"; // Sembunyikan setelah 3 detik
            }, 3000);
        <?php endif; ?>
    </script>
</body>
</html>
