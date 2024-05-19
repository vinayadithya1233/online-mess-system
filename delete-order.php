<?php
require 'config/database.php'; // Include your database configuration file

// Enable error reporting for debugging
ini_set('display_errors', 1);

// Check if the 'id' parameter is present in the URL
if (isset($_GET['id'])) {
    $order_id = $_GET['id'];

    // SQL query to delete the order with the specified 'id'
    $delete_order_query = "DELETE FROM orders WHERE id = ?";

    // Use a prepared statement for security
    $stmt = mysqli_prepare($connection, $delete_order_query);

    if ($stmt) {
        // Bind the 'id' parameter to the prepared statement
        mysqli_stmt_bind_param($stmt, "i", $order_id);

        // Execute the prepared statement
        $execute_result = mysqli_stmt_execute($stmt);

        // Check if the execution was successful
        if ($execute_result) {
            // Redirect to the orders page after successful deletion
            header("Location: user_index.php");
            exit();
        } else {
            // Display an error message if execution fails
            echo "Error executing the deletion query: " . mysqli_error($connection);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Display an error message if the prepared statement fails
        echo "Error preparing the deletion statement: " . mysqli_error($connection);
    }
} else {
    // Redirect to the orders page if 'id' is not provided in the URL
    header('location'.ROOT_URL.'user_index.php');
    exit();
}

// Close the database connection
mysqli_close($connection);
?>
