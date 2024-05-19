<?php

require 'config/database.php';

//get singup data from the signup page if submit is clicked
if (isset($_POST['submit'])) {
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar = $_FILES['avatar'];

    //validate the inputs from the form
    if (!$firstname) {
        $_SESSION['signup'] = "Please enter a valid first name";
    } elseif (!$lastname) {
        $_SESSION['signup'] = "Please enter a valid last name";
    } elseif (!$username) {
        $_SESSION['signup'] = "Please enter a valid username";
    } elseif (!$email) {
        $_SESSION['signup'] = "Please enter a valid email";
    } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['signup'] = "Password should be 8+ characters";
    } elseif (!$avatar['name']) {
        $_SESSION['signup'] = "Please select an image";
    } else {
        //check password is matching or not
        if ($createpassword !== $confirmpassword) {
            $_SESSION['signup'] = "Password is not matching";
        } else {
            //if matched, generate hashed password
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

            //check if username or email already exists in the database
            $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
            $user_check_result = mysqli_query($connection, $user_check_query);

            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['signup'] = "Username or email is already exist";
            } else {
                //generate unique avatar name using timestamp
                $time = time();
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = 'images/' . $avatar_name;

                //validate file type and size
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $file_extension = pathinfo($avatar_name, PATHINFO_EXTENSION);

                if (in_array($file_extension, $allowed_files) && $avatar['size'] < 100000000000) {
                    //upload the avatar
                    move_uploaded_file($avatar_tmp_name, $avatar_destination_path);

                    //define the insert user query
                    $insert_user_query = "INSERT INTO users (firstname, lastname, username, email, passworld, avatar, it_admin) VALUES ('$firstname', '$lastname', '$username', '$email', '$hashed_password', '$avatar_name', 0)";

                    //execute the insert query
                    $insert_user_result = mysqli_query($connection, $insert_user_query);

                    if ($insert_user_result) {
                        $_SESSION['signup-success'] = "Registration successful";
                        header('location:' . ROOT_URL . 'signin.php');
                        die();
                    } else {
                        $_SESSION['signup'] = "Error: " . mysqli_error($connection);
                    }
                } else {
                    $_SESSION['signup'] = "File should be png, jpg, or jpeg and size should be less than 1MB";
                }
            }
        }
    }

    //redirect back to the signup page
    if (isset($_SESSION['signup'])) {
        //pass form data back to signup page
        $_SESSION['signup-data'] = $_POST;
        header('location:' . ROOT_URL . 'signup.php');
        die();
    }
} else {
    //if button wasn't clicked, go to the main page
    header('location:' . ROOT_URL . 'signup.php');
    die();
}
?>
