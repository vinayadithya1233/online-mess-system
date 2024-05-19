<?php

require 'config/constants.php';

$username_email = $_SESSION['singin-data']['username_email'] ?? null;
$password = $_SESSION['singin-data']['password'] ?? null;
unset($_SESSION['signin-data']);
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

</head>
<body>
<section class="form__section">
    <div class="container form__section-container">
        <h2>sign up</h2>
        <?php
        if(isset($_SESSION['signup-success'])): ?>
            
<div class="alert__message sucess">
<p>
    <?= $_SESSION['signup-success'];
    unset($_SESSION['signup-success']);
?>
</p>
</div>
<?php elseif(isset($_SESSION['signin'])): ?>
            
<div class="alert__message error">
<p>
    <?= $_SESSION['signin'];
    unset($_SESSION['signin']);
?>
</p>
</div>
<?php endif ?>
        
       
        <form action="<?= ROOT_URL ?>signin-logic.php" method="POST" enctype="multipart/form-data">
         
            <input type="text" name="username_email" value="<?= $username_email ?>" placeholder="username or email">
            
            <input type="password" name="password" value="<?= $password ?>" placeholder="password">
            <button type="submit" name="submit" class="btn">Sign in</button>
                <small>Don't have an account? <a href="signup.php">Sign Up</a></small>
        </form>
    </div>
</section>
</body>
</html>