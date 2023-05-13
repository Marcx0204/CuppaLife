<?php
    include_once '../config/dbaccess.php';

    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $errors = [];
    if (empty($email)) {
        array_push($errors, "Emai is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM user WHERE email='$email' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {

            $user = $results->fetch_assoc();

            $_SESSION['name'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['success'] = "You are now logged in";

            if($_POST['remember']==true)  {
               
                setcookie("userid",$user['id'],time() + (86400 * 30),'/');
            }
            if($_POST['remember']==false)  {
                setcookie("userid",$user['id'],0);
            }
            $return['status'] ="OK";
        }else {
            $return['status'] ="NO";
        }

        echo json_encode($return);
    }else{
        echo json_encode($errors);
    }
?>


