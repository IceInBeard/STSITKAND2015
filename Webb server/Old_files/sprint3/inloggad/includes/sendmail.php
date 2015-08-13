<?php
/**
 * This example shows sending a message using a local sendmail binary.
 */

/*

require 'PHPMailer/PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;
// Set PHPMailer to use the sendmail transport
$mail->isSendmail();
//Set who the message is to be sent from
$mail->setFrom('Adam@test.se', 'First Last');
//Set an alternative reply-to address
$mail->addReplyTo('Adam@test.se', 'First Last');
//Set who the message is to be sent to
$mail->addAddress('jakob.wahleman@gmail.com', 'John Doe');
//Set the subject line
$mail->Subject = 'PHPMailer sendmail test';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
$mail->msgHTML('<p>Hej hej</p>');
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
// $mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
*/



            $to= "Jakob.wahleman@gmail.com";
            $subject = "Mail från STSITKAND";
            $message = "Trudelutt detta kom visst fram!";
            $header = "From: stsitkand@it.uu.se ";

            $retval = mail($to, $subject, $message, $header);
 
            if ($retval == true)
            {
                echo "message sent succesfully!";

            }
            else
            {
                echo "FAIL!";
            }


?>

