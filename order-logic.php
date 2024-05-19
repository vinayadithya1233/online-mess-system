<?php
require 'config/constants.php';
require 'config/database.php';

if (isset($_SESSION['user-id'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Collect and sanitize form data
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $mobileno = mysqli_real_escape_string($connection, $_POST['mobileno']);
        $preferred_time = mysqli_real_escape_string($connection, $_POST['time']);
        $start_date = mysqli_real_escape_string($connection, $_POST['Start-date']);
        $end_date = mysqli_real_escape_string($connection, $_POST['end-date']);
        $address = mysqli_real_escape_string($connection, $_POST['address']);
        $tiffin_id = mysqli_real_escape_string($connection, $_POST['tiffin']);
        $user_id = $_SESSION['user-id'];  // Retrieve user-id from the session

        // Validate inputs (add more validation as needed)
        if (empty($name) || empty($mobileno) || empty($preferred_time) || empty($start_date) || empty($end_date) || empty($address) || empty($tiffin_id)) {
            $_SESSION['order-error'] = 'All fields are required.';
            header('Location: ' . ROOT_URL . 'order.php');
            exit();
        }

        // Insert data into the orders table using prepared statements
        $insert_query = "INSERT INTO orders (name, mobileno, preferred_time, start_date, end_date, address, tiffin_id, user_id) 
                         VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $insert_query);
        mysqli_stmt_bind_param($stmt, "ssssssii", $name, $mobileno, $preferred_time, $start_date, $end_date, $address, $tiffin_id, $user_id);

        if (mysqli_stmt_execute($stmt)) {
            // Order placed successfully
            $_SESSION['order-success'] = 'Order placed successfully!';
            header('Location: ' . ROOT_URL . 'order.php');
            exit();
        } else {
            // Error in placing order
            $_SESSION['order-error'] = 'Error placing the order. Please try again.';
            header('Location: ' . ROOT_URL . 'order.php');
            exit();
        }
    } else {
        // Redirect if the form is not submitted
        header('Location: ' . ROOT_URL . 'order.php');
        exit();
    }
} else {
    // User is not signed in, redirect to the signin page
    $_SESSION['order-error'] = 'Please sign in to place an order.';
    header('Location: ' . ROOT_URL . 'signin.php');
    exit();
}
?>
