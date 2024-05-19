<?php
require 'config/database.php';


if(isset($_POST['submit'])){
    //get form data
    $username_email = filter_var($_POST['username_email'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if(!$username_email){
        $_SESSION['signin'] = "Username or email not found";

    }elseif(!$password){
        $_SESSION['signin'] = "password required";

    }else{
        //fetch user from database
        $fetch_user_query = "SELECT * FROM users WHERE username='$username_email' OR email='$username_email'";
        $fetch_user_result = mysqli_query($connection, $fetch_user_query);

        if(mysqli_num_rows($fetch_user_result) == 1){
                    //conver the records into the asso array
                    $user_record = mysqli_fetch_assoc($fetch_user_result);
                    $db_password = $user_record['passworld'];
                    //compare the password in the database
                    if(password_verify($password, $db_password)){
                        // set the session for the access control
                        $_SESSION['user-id'] = $user_record['id'];
                        //set session if the user is admin
                        if($user_record['it_admin'] == 1){
                            $_SESSION['user_is_admin'] = true;
                            header('location:'.ROOT_URL.'admin/index.php');
                        }else{
                                 //log user in 
                            header('location:'.ROOT_URL.'/user_index.php');
                        }
                       
                    }else{
                        $_SESSION['signin'] = "please check your inputs";
                    }
                
        }else{
            $_SESSION['signin'] = "user is not found";
        }
    }
    //any problem is happened we bounce back to the singin pages
    if(isset($_SESSION['signin'])){
        $_SESSION['signin-data'] = $_POST;
        header('Location:' .ROOT_URL. 'signin.php');
        die();
    }

}else{

header('Location:' .ROOT_URL. 'signin.php');




}