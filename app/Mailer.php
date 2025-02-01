<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__.'/../vendor/autoload.php';
class MailSender{
    private $mail;

    public function __construct(){
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host = 'mail.domain.com';
        $this->mail->Port = 465;
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'mail@domain.com';
        $this->mail->Password = 'mailpassword';
        $this->mail->SMTPSecure = 'ssl';
       
        $this->mail->setFrom('rahul@rahulwadaskar.in', 'Rahul Wadaskar TEST');
    }

    public function getMailer(){
        return $this->mail;
    }
}


?>