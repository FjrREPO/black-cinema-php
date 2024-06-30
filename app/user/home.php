<?php
session_start();
if ($_SESSION['user_role'] != "user") {
    header("location: ../../masuk");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Black Cinema</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-black text-white">
    <?php include "pages/navbar.php"; ?>
    <?php include "pages/content.php"; ?>
</body>

</html>