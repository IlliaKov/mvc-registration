<?php
session_start();

// initializing variables
$f_name = "";
$l_name = "";
$email   = "";
$phone = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', 'root', 'regDB');

// REGISTER USER
if (isset($_POST['reg_user'])) {
    $f_name = mysqli_real_escape_string($db, $_POST['f_name']);
    $l_name = mysqli_real_escape_string($db, $_POST['l_name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    // form validation

    if (empty($f_name)) { array_push($errors, "First name is required"); }
    if (empty($l_name)) { array_push($errors, "Last name is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($phone)) { array_push($errors, "Phone is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    // check the database
    $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['email'] === $email) {
            array_push($errors, "email already exists");
        }
    }

    // register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1);//encrypt the password

        $query = "INSERT INTO users (f_name, l_name, email, phone, password) 
  			  VALUES('$f_name', '$l_name', '$email', '$phone','$password')";
        mysqli_query($db, $query);
        $_SESSION['email'] = $email;
        $_SESSION['success'] = "You are now logged in";
        header('location: ../app/Views/home/index.php');
    }
}
// LOGIN USER
if (isset($_POST['login_user'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['email'] = $email;
            $_SESSION['success'] = "You are now logged in";
            header('location: ../app/Views/home/index.php');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}