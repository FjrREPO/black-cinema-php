<?php
include "../../../../../config/conn.php";
session_start();

// Memastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    echo 'not_logged_in';
    exit();
}

$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Debugging: Print POST data
    echo 'POST data: ';
    print_r($_POST);

    // Check if the required POST parameters are set
    $username = isset($_POST['username']) ? mysqli_real_escape_string($conn, $_POST['username']) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
    $telephone = isset($_POST['telephone']) ? mysqli_real_escape_string($conn, $_POST['telephone']) : '';

    // Debugging: Print the values
    echo 'Username: ' . $username . '<br>';
    echo 'Email: ' . $email . '<br>';
    echo 'Telephone: ' . $telephone . '<br>';

    // Ensure all fields are present
    if (!empty($username) && !empty($email) && !empty($telephone)) {
        $query = "UPDATE user SET user_username = '$username', user_email = '$email', user_telepon = '$telephone' WHERE user_id = $userId";

        // Execute the query and check for errors
        if (mysqli_query($conn, $query)) {
            echo 'success';
        } else {
            echo 'error: ' . mysqli_error($conn); // Tambahkan pesan error MySQL untuk debugging
        }
    } else {
        echo 'missing_fields';
    }

    mysqli_close($conn);
} else {
    echo 'invalid_request';
}
