<?php
    include_once '../config/dbaccess.php';
   @session_start();

    // receive all input values from the form
    $email      = mysqli_real_escape_string($db, $_POST['email']);
    $password   = mysqli_real_escape_string($db, $_POST['password']);

    $type      = mysqli_real_escape_string($db, $_POST['type']);
    $username  = mysqli_real_escape_string($db, $_POST['username']); 
    $f_name    = mysqli_real_escape_string($db, $_POST['f_name']);
    $l_name    = mysqli_real_escape_string($db, $_POST['l_name']);
    $address   = mysqli_real_escape_string($db, $_POST['address']);
    $zip_code  = mysqli_real_escape_string($db, $_POST['zip_code']);
    $town   = mysqli_real_escape_string($db, $_POST['town']);
    $email     = mysqli_real_escape_string($db, $_POST['email']); 

    $confirm_password = mysqli_real_escape_string($db, $_POST['confirm_password']);
    $errors = [];
    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($type)) { $errors['status']       =  "Type is required"; }
    if (empty($username)) { $errors['username']    = "Username is required"; }
    if (empty($f_name)) { $errors['status']      = "First Name is required"; }
    if (empty($l_name)) { $errors['status']      = "Last Name is required"; }
    if (empty($address)) { $errors['status']      = "Address is required"; }
    if (empty($zip_code)) { $errors['status']      = "Zip Code is required"; }
    if (empty($town)) { $errors['status']      = "Town is required"; }
    if (empty($email)) { $errors['status']      = "Email is required"; }
    if (empty($password)) { $errors['status']   = "Password is required"; }
    if ($password != $confirm_password) {
        $errors['status'] = "The two passwords do not match";
    }

    // first check the database to make sure 
    // a user does not already exist with the same name and/or email
    $user_check_query = "SELECT * FROM user WHERE email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
      
    if ($user) { // if user exists
        if ($user['username'] == $username) {
            $errors['status'] = "username already exists";
        }

        if ($user['email'] == $email) {
            $errors['status'] = "email already exists";
        }
    }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $password = md5($password); //encrypt the password before saving in the database

    $query = "INSERT INTO user (type, username, name, l_name, address, zip_code, town, email, password) 
              VALUES('$type', '$username', '$f_name', '$l_name', '$address', '$zip_code', '$town', '$email', '$password')";
    $result = mysqli_query($db, $query);

    if ($result) {
        $_SESSION['name'] = $username;
        $_SESSION['user_id'] = mysqli_insert_id($db);
      
        $_SESSION['success'] = "You are now logged in";
        $return['status'] = "Yes";

        echo json_encode($return);
    }else{
        $errors['status'] = 'Something went wrong. please try again';
        echo json_encode($errors);
    }
       
  }else{
    echo json_encode($errors);
  }
?>