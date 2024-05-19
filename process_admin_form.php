<?php
// process_admin_form.php
require 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tiffin_name = mysqli_real_escape_string($connection, $_POST['tiffin_name']);
    $tiffin_description = mysqli_real_escape_string($connection, $_POST['tiffin_description']);
    $tiffin_price = floatval($_POST['tiffin_price']);
    $tiffin_style = mysqli_real_escape_string($connection, $_POST['tiffin_style']);

    // File upload handling
    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["tiffin_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a valid image
    if (!getimagesize($_FILES["tiffin_image"]["tmp_name"])) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["tiffin_image"]["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // You might want to redirect to an error page or display an error message
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($_FILES["tiffin_image"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["tiffin_image"]["name"])) . " has been uploaded.";

            // Insert tiffin information into the tiffins table using prepared statements
            $tiffinInsertQuery = $connection->prepare("INSERT INTO tiffins (tiffin_name, tiffin_description, tiffin_image, tiffin_price, tiffin_style) VALUES (?, ?, ?, ?,?)");
            $tiffinInsertQuery->bind_param("sssds", $tiffin_name, $tiffin_description, $targetFile, $tiffin_price,   $tiffin_style);

            if ($tiffinInsertQuery->execute()) {
                // Get the tiffin_id of the inserted row
                $tiffin_id = $connection->insert_id;

                // Insert tiffin items into the tiffin_items table using prepared statements
                if (isset($_POST['items']) && isset($_POST['quantities'])) {
                    $items = array_map(function ($item) use ($connection) {
                        return mysqli_real_escape_string($connection, $item);
                    }, $_POST['items']);

                    $quantities = array_map('intval', $_POST['quantities']);

                    $itemInsertQuery = $connection->prepare("INSERT INTO tiffin_items (tiffin_id, item_name, item_quantity) VALUES (?, ?, ?)");
                    $itemInsertQuery->bind_param("iss", $tiffin_id, $item_name, $item_quantity);

                    // Loop through items and insert into the tiffin_items table
                    for ($i = 0; $i < count($items); $i++) {
                        $item_name = $items[$i];
                        $item_quantity = $quantities[$i];

                        if ($itemInsertQuery->execute()) {
                            // Handle success or continue processing
                        } else {
                            // Handle item insertion failure
                            echo 'Error inserting item information: ' . $connection->error;
                            exit();
                        }
                    }

                    // Close the prepared statement for items
                    $itemInsertQuery->close();

                    // Insert tiffin price into the tiffin_prices table
                    $priceInsertQuery = $connection->prepare("INSERT INTO tiffin_prices (tiffin_id, price) VALUES (?, ?)");
                    $priceInsertQuery->bind_param("id", $tiffin_id, $tiffin_price);

                    if ($priceInsertQuery->execute()) {
                        // Handle success or continue processing

                        // Close the prepared statement for prices
                        $priceInsertQuery->close();

                        // Close the prepared statement for tiffins
                        $tiffinInsertQuery->close();

                        // Close the database connection
                        $connection->close();

                        // Display success message and redirect
                        echo '<script>';
                        echo 'alert("Tiffin added successfully!");';
                        echo 'window.location.href = "index.php";';
                        echo '</script>';
                        exit();
                    } else {
                        // Handle price insertion failure
                        echo 'Error inserting price information: ' . $connection->error;
                        exit();
                    }
                } else {
                    // Handle missing items or quantities
                    echo 'Items or quantities missing.';
                }
            } else {
                // Handle tiffin insertion failure
                echo 'Error inserting tiffin information: ' . $connection->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
            // You might want to redirect to an error page or display an error message
        }
    }
} else {
    // Handle invalid request method
    // You might want to redirect to an error page or display an error message
    echo 'Invalid request method.';
}
?>

