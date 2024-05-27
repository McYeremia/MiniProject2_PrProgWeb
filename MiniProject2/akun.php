<?php
    session_start();

    ///cek login
    if (!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }

    require "functions.php";
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Akun Harmoni Konser</title>
</head>
<body>
    <form method="Post" action="logout.php">
        <button type="submit" name="logout">Logout</button>
    
    </form>
    
</body>
</html>