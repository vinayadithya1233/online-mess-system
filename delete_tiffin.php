<?php
require 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tiffin_id'])) {
    $tiffin_id = mysqli_real_escape_string($connection, $_POST['tiffin_id']);

    // Delete tiffin items
    $deleteItemsQuery = "DELETE FROM tiffin_items WHERE tiffin_id = $tiffin_id";
    mysqli_query($connection, $deleteItemsQuery);

    // Delete tiffin prices
    $deletePriceQuery = "DELETE FROM tiffin_prices WHERE tiffin_id = $tiffin_id";
    mysqli_query($connection, $deletePriceQuery);

    // Delete tiffin
    $deleteTiffinQuery = "DELETE FROM tiffins WHERE tiffin_id = $tiffin_id";
    mysqli_query($connection, $deleteTiffinQuery);

    // Redirect back to index.php
    header("Location: admin/del_tiffin.php");
    exit();
} else {
    // Handle invalid request method or missing tiffin_id
    // You might want to redirect to an error page or display an error message
    echo 'Invalid request or missing tiffin_id.';
}
?>
