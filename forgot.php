<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require './vendor/autoload.php';

    $dotenv = new Dotenv\Dotenv('./');
    $dotenv->load();
    $dotenv->required(['DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD']);

    include './includes/db.php';
    include './admin/functions.php';

    session_start();

    checkIfUserIsLoggedInAndRedirect('./admin/index.php');

    if(ifItIsMethod('get') && !isset($_GET['forgot'])) {

        redirect('./index.php');

    } elseif(ifItIsMethod('post') && isset($_POST['recover-submit']) && isset($_POST['user_email'])) {

        $user_email = escape($_POST['user_email']);
        $length = 50;
        $token = bin2hex(openssl_random_pseudo_bytes($length));

        if(userEmailExists($user_email)) {

            $setUserTokenByEmail = mysqli_prepare($connection, "UPDATE users SET token='{$token}' WHERE user_email=?");
            if(confirmQuery($setUserTokenByEmail)) {

                mysqli_stmt_bind_param($setUserTokenByEmail, "s", $user_email);
                mysqli_stmt_execute($setUserTokenByEmail);
            }
            mysqli_stmt_close($setUserTokenByEmail);

            $findUserNameByEmail = mysqli_prepare($connection, "SELECT user_firstname FROM users WHERE user_email=?");
            if(confirmQuery($findUserNameByEmail)) {

                mysqli_stmt_bind_param($findUserNameByEmail, "s", $user_email);
                mysqli_stmt_execute($findUserNameByEmail);
                mysqli_stmt_bind_result($findUserNameByEmail, $user_firstname);
            }
            mysqli_stmt_fetch($findUserNameByEmail);
            mysqli_stmt_close($findUserNameByEmail);

            $actionURL = "http://localhost:8000/reset.php?email={$user_email}&token={$token}";

            $messageBody  = "<p>Hi {$user_firstname},</p>"; 
            $messageBody .= "<p>You recently requested to reset your password for your Blog-CMS-PHP account. ";
            $messageBody .= "Use the button below to reset it. ";
            $messageBody .= "This password reset is only valid for the next 24 hours.</p>";
            $messageBody .= "<div><a href='{$actionURL}'><button> Reset your password </button></a></div>";
            $messageBody .= "<p>If you did not request a password reset, please ignore this email or contact support if you have questions.</p>";
            $messageBody .= "<p>Thanks, <br>The Blog-CMS-PHP Team</p>";
            $messageBody .= "<p>If you’re having trouble with the button above, copy and paste the URL below into your web browser.</p>";
            $messageBody .= "<a href='{$actionURL}'>{$actionURL}</a>";

            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host = Config::SMTP_HOST;
                $mail->SMTPAuth = true;
                $mail->Username = Config::SMTP_USER;
                $mail->Password = Config::SMTP_PASSWORD;
                $mail->SMTPSecure = 'tls';
                $mail->Port = Config::SMTP_PORT;
            
                //Recipients
                $mail->setFrom('superCoderDOM@gmail.com', 'Dominic Lacroix');
                $mail->addAddress($user_email);
            
                //Content
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'Reset password link';
                $mail->Body    = $messageBody;
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
                $mail->send();
                $reset_message = "<div class='form-group bg-success lead'>Check your email for your password reset link</div>";

            } catch (Exception $e) {

                $reset_message = "<div class='form-group bg-danger lead'>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</div>";
            }

        } else {

            $email_error = "This email does not exist in our database";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="description" content="Sign in form">
    <meta name="author" content="Dominic Lacroix">

    <title>Blog - Login</title>

    <?php include "./includes/header_meta_link.php"?>

</head>

<body>

    <!-- Page Content -->
    <div class="container">

        <?php include './includes/forgot.php'; ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>