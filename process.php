<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'assets/PHPMailer/src/Exception.php';
require 'assets/PHPMailer/src/PHPMailer.php';
require 'assets/PHPMailer/src/SMTP.php';



// VARIABLES DECLARATION

$name = $lastname = $gender = $email = $country = $success = "";
$name_error = $lastname_error = $gender_error = $email_error = $country_error = "";
$counter = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {  // ONCE FORM HAS BEEN SUBMITED THEN DO ALL THE VALIDATIONS =>


    // VALIDATION OF NAME FIELD

    if (empty($_POST["name"])) {
        $name_error = "Name is required";
        $counter++;
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z]*$/", $name)) {
            $name_error = "Only letters and white space allowed";
            $counter++;
        }
    }

    // VALIDATION OF LASTNAME FIELD

    if (empty($_POST["lastname"])) {
        $lastname_error = "Lastname is required";
        $counter++;
    } else {
        $lastname = test_input($_POST["lastname"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z]*$/", $name)) {
            $lastname_error = "Only letters and white space allowed";
            $counter++;
        }
    }

    // VALIDATION OF GENDER FIELD

    if (empty($_POST["gender"])) {
        $gender_error = "Gender is required";
        $counter++;
    } else {
        $gender = $_POST["gender"];
    }

    // VALIDATION OF EMAIL FIELD

    if (empty($_POST["email"])) {
        $email_error = "Email is required";
        $counter++;
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Invalid email format";
            $counter++;
        }
    }


    // VALIDATION OF COUNTRY FIELD

    if (empty($_POST["country"])) {
        $country_error = "Country is required";
        $counter++;
    } else {
        $country = $_POST["country"];
    }



    // VALIDATION OF SUBJECT FIELD

    if (empty($_POST["subject"])) {
        $subject_error = "Subject is required";
        $counter++;
    } else {
        $subject = $_POST["subject"];
    }


    // VALIDATION OF MESSAGE FIELD

    if (empty($_POST["message"])) {
        $message = "";
    } else {
        $message = test_input($_POST["message"]);
    }


    // WHEN SUBMIT IF ALL FIELDS ARE OK

    if ($counter == 0) {
        $message_body =
            'Firstname :' . $name . '<br>' .
            'Lastname : ' . $lastname . '<br>' .
            'Email : ' . $email . '<br>' .
            'Gender : ' . $gender . '<br>' .
            'Country : ' . $country . '<br>' .
            'Message : ' . $message;
        sendmail($subject, $message_body);
        sendmailclt($email);
    }
}






function test_input($data)
{ // allow to sort display datas from user before posting
    $data = trim($data); // remove the useless characters
    $data = stripslashes($data); // remove the \
    $data = htmlspecialchars($data); // convert special characters in html characters
    return $data;
};






// HONEYPOT

$honeypot = FALSE;
if (!empty($_REQUEST['contact_me_baby']) && (bool) $_REQUEST['contact_me_baby'] == TRUE) {
    $honeypot = TRUE;
    log_spambot($_REQUEST);
} else {
    # process as normal
}







// USE PHPMailer 




function sendmail($s, $mb)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = 2;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'gustruite@gmail.com';                     // SMTP username
        $mail->Password   = 'GusTruite.1920';                               // SMTP password
        $mail->SMTPSecure = "tls";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587;                                  // TCP port to connect to

        //Recipients
        $mail->setFrom('dont-reply@mail.com', 'Administrator Hackers Poulette');
        $mail->addAddress('gustruite@gmail.com');     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo('gustruite@gmail.com');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        // Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "Customers problem about :" . $s;
        $mail->Body    = $mb;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}



function sendmailclt($mailclt)
{

    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = 2;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'gustruite@gmail.com';                     // SMTP username
        $mail->Password   = 'GusTruite.1920';                               // SMTP password
        $mail->SMTPSecure = "tls";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587;                                  // TCP port to connect to

        //Recipients
        $mail->setFrom('dont-reply@mail.com', 'Administrator Hackers Poulette');
        $mail->addAddress($mailclt);     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo('gustruite@gmail.com');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        // Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "Automocatic reply";
        $mail->Body    = "We have received your email and ll response in a few time";
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
