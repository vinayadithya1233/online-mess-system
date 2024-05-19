<?php
require 'config/constants.php';
//get back form dat if there was a registration error
$firstname = $_SESSION['signup-data']['firstname'] ?? null;
$lastname = $_SESSION['signup-data']['lastname'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$createpassword = $_SESSION['signup-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;

// delete the signup session
unset($_SESSION['signup-data']);
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
        if(isset($_SESSION['signup'])): ?>
            
<div class="alert__message error">
<p>
    <?= $_SESSION['signup'];
    unset($_SESSION['signup']);
?>
</p>
</div>
<?php endif ?>
        <form action="<?= ROOT_URL?>signup-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="firstname" value="<?= $firstname ?>" placeholder="first name">
            <input type="text" name="lastname" value="<?= $lastname ?>" placeholder="last name">
            <input type="text" name="username" value="<?= $username ?>" placeholder="username">

            <input type="email" name="email" value="<?= $email ?>" placeholder="Emails">
            <input type="password" name="createpassword" value="<?= $createpassword ?>" placeholder="create password">
            <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="conform password">
            <div class="form__control">
                <label for="avatar" >Profile picture</label>
                <input type="file" name="avatar" id="avatar">
            </div>
            <button type="submit" name="submit" class="btn">Sign up</button>
                <small>Already have an account? <a href="signin.php">Sign In</a></small>
        </form>
    </div>
</section>
</body>
</html>