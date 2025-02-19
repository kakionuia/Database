<?php
include "service/database.php";
$message = ""; // Variabel untuk menyimpan pesan

if (isset($_POST['Submit'])) {
    $username = $_POST['name'];
    $password = $_POST['password'];
    $id = $_POST['id'];
    $nama = $_POST['pengguna'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO user (name, password, id, pengguna) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $username, $password, $id, $nama);

    if ($stmt->execute()) {
        $message = "Data berhasil dimasukkan";
        header("Location: ../percobaan/login.php"); // Mengarahkan ke dashboard
        exit();
    } else {
        $message = "Error: Data sudah ada, ganti yang lain";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Formulir Pengguna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to left, #FFAA6E, #fefefe);
            background-size: 300%;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            animation: bg 12s infinite ease-in-out;
        }

        @keyframes bg {
            0% { background-position: 100% 50%; }
            50% { background-position: 50% 100%; }
            100% { background-position: 100% 50%; }
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            width: 100%;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: scale(0.9); }
            100% { opacity: 1; transform: scale(1); }
        }

        h2 {
            text-align: center;
            color: #333;
            animation: slideDown 2s ease-in-out;
        }

        @keyframes slideDown {
            0% { transform: translateX(-50px); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }

        form {
            display: flex;
            flex-direction: column;
            animation: formSlideUp 1s ease-in-out;
        }

        @keyframes formSlideUp {
            0% { transform: translateY(50px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1); }
        }

        input[type="text"], input[type="password"] {
            padding: 8px;
            margin: 5px 0;
            border: none;
            animation: inputFadeIn 1s ease-in-out;
            border-bottom: 1px #ccc solid;
        }

        input[type="text"], input[type="password"]:focus {
            outline: none;
        }

        @keyframes inputFadeIn {
            0% { opacity: 0; transform: translateY(10px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #FFAA6E;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.4s;
            animation: buttonBounce 1s ease-in-out;
        }

        @keyframes buttonBounce {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        input[type="submit"]:hover {
            background-color: #FFF39A;
            color: black;
            transform: scale(1.1);
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
            animation: alertFadeIn 1s ease-in-out;
        }

        .alert.success {
            background-color: #eee;
            color: #333;
        }

        @keyframes alertFadeIn {
            0% { opacity: 0; transform: translateY(-10px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .warn {
            margin-top: -15px;
            font-size: 10px;
            margin-bottom: 10px;
            color: #333;
        }

        .login {
            text-decoration: none;
        }

        .have {
            font-size: 13px;
            text-align: center;
        }

        hr {
            position: relative;
            bottom: 15px;
            width: 50%;
            border: 2px solid #FFAA6E;
            border-radius: 5px;
            overflow: hidden;
            animation: hrAnimation 2s ease-in-out forwards;
        }

        @keyframes hrAnimation {
            0% { width: 0; }
            100% { width: 50%; }
        }

        .container label{
            display: flex;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <hr>
        <form action="" method="POST">
            <label for="id">ID:</label> <input type="text" name="id" id="id"><br>
            <label for="user">Username:</label> <input type="text" name="name" id="name" required><br>
            <label for="name">Nama: </label><input type="text" name="pengguna" id="pengguna" required><br>
            <label for="password">Password:</label> <input type="password" name="password" id="password" required><br>
            <label for="alert" class="warn">*Password jangan kepanjangan</label>
            <input type="submit" value="Submit" name="Submit">
            <p class="have">Sudah punya akun? <a href="login.php" class="login">Log-in</a></p>
        </form>
    </div>

    <div id="alert" class="alert"></div>

    <script>
        <?php if (!empty($message)): ?>
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
