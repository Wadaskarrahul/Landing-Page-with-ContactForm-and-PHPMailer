<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__.'/../vendor/autoload.php';
class MailSender{
    private $mail;

    public function __construct(){
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host = 'mail.rahulwadaskar.in';
        $this->mail->Port = 465;
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'rahul@rahulwadaskar.in';
        $this->mail->Password = 'nidhu2001/*';
        $this->mail->SMTPSecure = 'ssl';
       
        $this->mail->setFrom('rahul@rahulwadaskar.in', 'Rahul Wadaskar TEST');
    }

    public function getMailer(){
        return $this->mail;
    }
}


?>