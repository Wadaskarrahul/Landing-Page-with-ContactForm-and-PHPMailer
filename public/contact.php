

<?php 

require_once '../app/function.php';
require_once '../app/mailer.php';

// initialize response variable
$response = [
    "status"=>"error",
    "message"=> ""
];
// Turn on output buffering to prevent any unwanted output before the JSON response
ob_start();


// chech form if submitted via post
if($_SERVER["REQUEST_METHOD"]=="POST"){

    // sanitize input to prevent security issues
    $name = $contactFormHandler->sanitizeInput($_POST["name"]);
    $email = $contactFormHandler->sanitizeInput($_POST["email"]);
    $message = $contactFormHandler->sanitizeInput($_POST["message"]);
    // var_dump($name);
        //  validate all fields are empty or not
    if(!empty($name) && !empty($email) && !empty($message)){
        // validate email format checking
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            
            // echo "Invalid email format";
            $response["message"] = "Invalid email format";
            exit;
        }

        if($contactFormHandler->saveContact($name, $email, $message)){  // save contact form data to database
            // create a Mailsender Instance and mailer object to send email
            // get the mailer object and set up the email content and sender details
            // send the email
            /**
             * send the data to the saleforce
             * saveSaleforce($name, $email, $message);
             */
            $mailSender = new MailSender();
            $mail = $mailSender->getMailer();
            try{
                $mail -> addAddress($email);    // Add a recipient
                $mail->isHTML(true);            // Set email format to HTML
                $mail -> Subject = "New Contact Message"; // Set email subject
                $mail -> Body =" Name: $name\nEmail: $email\nMessage: $message";    // Set email body content
                $mail->AltBody = 'Hello from Localhost! This is a test email sent using PHPMailer.'; // Set email body for non-HTML mail clients
                // attempt for success or failure message
                if ($mail->send()) {
                    
                    // echo 'Email has been sent successfully!';
                    $response["status"] ="success";
                    $response["message"] ="Email has been sent successfully!";

                } else {
                    
                    $response["message"] ="Email sending Failed!";
                    // echo 'Email sending failed!';

                }
    
            }
            catch(Exception $e){
                
                // echo "Mailer Error: {$mail->ErrorInfo}";
                $response["message"] = "Mailer Error:{$mail->ErrorInfo}";

            }
        }
        else{
            $response["message"] = "Failed to save contact";
            // echo "Failed to send message";
        }
    }
    else{
        $response["message"] = "All fields are required";
        // echo "All fields are required";
    }
}
// Ensure no HTML output before sending the response
ob_clean(); // Clear any output before sending JSON response

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
exit; // Make sure no further code is executed

?>