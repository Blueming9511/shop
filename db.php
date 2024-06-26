<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
function create_connection()
{
    $conn = mysqli_connect('localhost', 'root', '', 'acubi');
    if ($conn->connect_error) {
        die('Cannot connect to the server' . $conn->connect_error);
    }
    return $conn;
}

function login($username, $password)
{
    $conn = create_connection();
    $sql = 'select * from tbl_user where username=?';

    $stm = $conn->prepare($sql);
    $stm->bind_param("s", $username);
    if (!$stm->execute()) {
        return null;
    }



    $result  = $stm->get_result();
    $data = $result->fetch_assoc();


    // Check if a user record was found
    if (!$data) {
        return null; // Return null if username not found
    }
    $hashed_pwd =  $data['password'];

    if (!password_verify($password, $hashed_pwd)) {
        return null;
    }
    return $data;
}

function getData($username)
{
    $conn = create_connection();
    $sql = 'SELECT * FROM tbl_user WHERE username=?';
    $stm = $conn->prepare($sql);
    $stm->bind_param("s", $username);
    if (!$stm->execute()) {
        return null;
    }

    $result  = $stm->get_result();
    $data = $result->fetch_assoc();


    // Check if a user record was found
    if (!$data) {
        return null; // Return null if username not found
    }
    return $data;
}


// ==== SIGN Up ====  //


// Check whether  user email is already in use or not.
function is_email_exist($email)
{
    $conn = create_connection();
    $sql = 'SELECT COUNT(*) as count FROM tbl_user WHERE email = ?';

    // handle sql injection
    $stm = $conn->prepare($sql);
    $stm->bind_param('s', $email);
    if (!$stm->execute()) {
        die('Query error: ' . $stm->error);
    }

    $result = $stm->get_result();
    $data = $result->fetch_assoc();
    if ($data['count'] > 0) {
        return true;
    } else {
        return false;
    }
}


// Check whether  user username is already in use or not.
function is_user_exist($user)
{
    $sql = 'SELECT COUNT(*) as count FROM tbl_user WHERE username = ?';
    $conn = create_connection();

    // handle sql injection
    $stm = $conn->prepare($sql);
    $stm->bind_param('s', $user);
    if (!$stm->execute()) {
        die('Query error: ' . $stm->error);
    }
    $result = $stm->get_result();
    $data = $result->fetch_assoc();
    if ($data['count'] > 0) {
        return true;
    } else {
        return false;
    }
}

function register($user, $email, $pass, $firstname, $lastname, $phonenumber, $address)
{

    // check if email is exist
    if (is_email_exist($email)) {
        return array('code' => 1, 'error' => 'Email exists!');
    }

    // encoding the password
    $hash = password_hash($pass, PASSWORD_DEFAULT);

    // activate token = user + random(0, 100)
    $rand = random_int(0, 1000);
    $token = md5($user . '+' . $rand);
    $sql = 'insert into tbl_user(username, email, password, firstname, lastname, phonenumber, address, activate_token) values(?,?,?,?,?,?,?,?)';
    $conn = create_connection();
    $stm = $conn->prepare($sql);
    $stm->bind_param('ssssssss', $user, $email, $hash, $firstname, $lastname, $phonenumber, $address, $token);


    if (!$stm->execute()) {
        return array('code' => 2, 'error' => 'cannot execute command');
    }

    // send vertification email
    sendActivateEmail($email, $token);
    return array('code' => 0, 'error' => 'Create account successful');
}


function sendActivateEmail($email, $token)
{
    // Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        // Server settings
        // Enable verbose debug output only during development (comment out in production)
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                           // Set the SMTP server
        $mail->SMTPAuth   = true;                                      // Enable SMTP authentication
        $mail->Username   = 'nguyennguyen8343@gmail.com';                // Replace with your actual email
        $mail->Password   = 'mqiyzomyyyzxgnis';                     // Replace with your actual password (consider using app passwords)
        $mail->SMTPSecure = 'ssl';                                     // Enable implicit TLS encryption
        $mail->Port       = 465;                                       // TCP port to connect to

        // Recipients
        $mail->setFrom('nguyennguyen8343@gmail.com', 'ACUBI admin');  // Set sender email and name
        $mail->addAddress($email, 'Recipient');                        // Add recipient email and name (optional)

        // Content
        $mail->isHTML(true);                                           // Set email format to HTML
        $mail->Subject = 'ACUBI: Verify your account';
        $mail->Body    = "Click <a href='http://localhost/shop/activate.php?email=$email&token=$token'>here</a> to verify your account"; 
                        //change the href link corresponse with your local address
        $mail->send();
        return true;
    } catch (Exception $e) {
        // Log the exception for debugging (optional)
        return false;
    }
}
function sendThankYouEmail($email, $username)
{
    // Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        // Server settings
        // Enable verbose debug output only during development (comment out in production)
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                           // Set the SMTP server
        $mail->SMTPAuth   = true;                                      // Enable SMTP authentication
        $mail->Username   = 'nguyennguyen8343@gmail.com';                // Replace with your actual email
        $mail->Password   = 'mqiyzomyyyzxgnis';                     // Replace with your actual password (consider using app passwords)
        $mail->SMTPSecure = 'ssl';                                     // Enable implicit TLS encryption
        $mail->Port       = 465;                                       // TCP port to connect to

        // Recipients
        $mail->setFrom('nguyennguyen8343@gmail.com', 'ACUBI team');  // Set sender email and name
        $mail->addAddress($email, 'Recipient');                        // Add recipient email and name (optional)

        // Content
        $mail->isHTML(true);                                           // Set email format to HTML
        $mail->Subject = 'THANK YOU FOR SHOPPING AT ACUBI';
        $mail->Body = "Dear $username,<br><br>

        We would like to express our sincerest gratitude for choosing Acubi for your shopping needs. Your support is what motivates us to strive for excellence and to continually improve our services.<br><br>
        
        We hope you had a pleasant shopping experience and that you're satisfied with your purchases. At Acubi, we take pride in offering high-quality products and exceptional customer service.<br><br>
        
        Remember, our team is always here to assist you with any inquiries or concerns you may have. Feel free to reach out to us at any time.<br><br>
        
        Once again, thank you for shopping at Acubi. We look forward to serving you again soon!<br><br>
        
        Best Regards,<br>
        The Acubi Team";
        $mail->send();
        
        return true;
    } catch (Exception $e) {
        // Log the exception for debugging (optional)
        return false;
    }
}


function activeAccount($email, $token)
{
    $sql = "select username from tbl_user where email = ? and activate_token = ? and activated = 0";
    $conn = create_connection();

    $stm  = $conn->prepare($sql);
    $stm->bind_param("ss", $email, $token);
    if (!$stm->execute()) {
        return array("code" => 1, "error" => "Cannot execute command");
    }

    $result = $stm->get_result();
    if ($result->num_rows == 0) {
        return array("code" => 2, "error" => "Email address or token not found");
    }
    // found
    $sql = "update tbl_user set activated = 1, activate_token = '' where email = ?";
    $stm = $conn->prepare($sql);
    $stm->bind_param("s", $email);
    if (!$stm->execute()) {
        return array("code" => 1, "error" => "Cannot execute command");
    }

    return array('code' => 0, 'message' => 'Successfully verified! Please login now.');
}
