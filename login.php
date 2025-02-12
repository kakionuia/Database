<?php
include "service/database.php";
session_start();
$message = ""; // Variabel untuk menyimpan pesan

if (isset($_POST['Login'])) {
    $name = $_POST['name'];
    $age = $_POST['age']; // Anggap 'age' sebagai password untuk contoh ini

    // Query untuk memeriksa apakah data ada dalam database
    $sql = "SELECT * FROM user WHERE name='$name' AND age='$age'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['name'] = $name; // Menyimpan nama di session
        header("Location: ../AurelBS/index.html"); // Mengarahkan ke dashboard
    } else {
        $message = "Login gagal: Nama atau password salah!";
    }
    // Menutup koneksi
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #FFAA6E;
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
            background-color: beige;
        }
        .alert {
            display: none;
            position: fixed;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #f44336;
            color: white;
            padding: 20px;
            border-radius: 5px;
            z-index: 1000;
        }
        .alert.success {
            background-color: #4CAF50;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            Nama: <input type="text" name="name" required><br>
            Password: <input type="password" name="age" required><br>
            <input type="submit" value="Login" name="Login">
        </form>
    </div>

    <div id="alert" class="alert"></div>

    <script>
        <?php if ($message): ?>
            const alertBox = document.getElementById('alert');
            alertBox.textContent = "<?php echo $message; ?>";
            alertBox.classList.add("success");
            alertBox.style.display = "block";
            setTimeout(() => {
                alertBox.style.display = "none";
            }, 3000);
        <?php endif; ?>
    </script>
</body>
</html>
