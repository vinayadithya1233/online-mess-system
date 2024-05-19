<?php
require 'config/constants.php';
// Retrieve tiffin_id from the URL parameter
$tiffinId = isset($_GET['tiffin_id']) ? $_GET['tiffin_id'] : null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>responsive multipage Blog website</title>
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <!-- goole font montseerat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;1,300&display=swap" rel="stylesheet">
    
  
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelector('form').addEventListener('submit', function (event) {
                var startDateInput = document.getElementsByName('Start-date')[0];
                var endDateInput = document.getElementsByName('end-date')[0];

                // Convert the input values to Date objects
                var startDate = new Date(startDateInput.value);
                var endDate = new Date(endDateInput.value);
                var currentDate = new Date();

                // Check if start date is not less than the current date
                if (startDate < currentDate) {
                    alert('Starting date cannot be less than the current date.');
                    event.preventDefault(); // Prevent form submission
                }

                // Check if end date is greater than start date
                if (endDate <= startDate) {
                    alert('End date must be greater than the starting date.');
                    event.preventDefault(); // Prevent form submission
                }
            });
        });


        
    </script>
</head>
<body>
<section class="form__section">
    <div class="container form__section-container">
        <h2>Place your order</h2>
        <?php if (isset($_SESSION['order-success'])): ?>
                <div class="alert__message success">
                    <p><?= $_SESSION['order-success']; ?></p>
                    <?php unset($_SESSION['order-success']); ?>
                </div>
            <?php elseif (isset($_SESSION['order-error'])): ?>
                <div class="alert__message error">
                    <p><?= $_SESSION['order-error']; ?></p>
                    <?php unset($_SESSION['order-error']); ?>
                </div>
            <?php endif ?>
        <form action="order-logic.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" required>
        
            <label for="mobileno">Mobile Number:</label>
            <input type="tel" name="mobileno" required>
        
            <label for="time">Preferred Time:</label>
            <select name="time" required>
                <option value="morning">Morning</option>
                <option value="afternoon">Afternoon</option>
                <option value="night">Night</option>
            </select>
           
    
            <label for="Start-date"> Starting Date:</label>
            <input type="date" name="Start-date" required>
            <label for="end-date">End Date:</label>
            <input type="date" name="end-date" required>
        
            <label for="address">Address:</label>
            <textarea name="address" rows="4" required></textarea>
     
        
            <button type="submit" class="btn">place order</button>
            <!-- Add a hidden input field for tiffin_id -->
       <input type="hidden" name="tiffin" value="<?= $tiffinId; ?>">

        </form>
    </div>
</section>
</body>
</html>