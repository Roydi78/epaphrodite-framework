<?php

namespace bin\epaphrodite\email;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class send_mail 
{

    /* 
      Instantiation and passing `true` enables exceptions
    */
    function __construct()
    {
        $this->mail = new PHPMailer(true);
    }    

    public function settings()
    {
   
        try {

            $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
            $this->mail->isSMTP();                                            
            $this->mail->Host       = 'smtp-fr.securemail.pro';                    
            $this->mail->SMTPAuth   = true;                                   
            $this->mail->Username   = 'aimendri@men-dpes.org';                     
            $this->mail->Password   = '@im3ndr#hope';                               
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
            $this->mail->Port       = 587;                                   
            $this->mail->setFrom('infos@epaphrodite.com', 'ADMINISTRATEUR EPAPHRODITE');

            return true;

        } catch (Exception $e) {

            return false;

        }    

    }


    public function send()
    {

        if($this->settings()===true)
        {
            //Recipients
            $this->mail->addAddress('aimendri@men-dpes.org', 'Joe User');     // Add a recipient
            $this->mail->addAddress('aimendrikonan@gmail.com');               // Name is optional
            //$this->mail->addReplyTo('info@example.com', 'Information');
            //$this->mail->addCC('cc@example.com');
            //$this->mail->addBCC('bcc@example.com');

            // Attachments
            //$this->mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            $this->content();
            $this->mail->send();

            echo 'Message has been sent'; 
            
        }    

    }

    public function content()
    {
            // Content
            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = 'This is another test';
            $this->mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            //$this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    }

}
