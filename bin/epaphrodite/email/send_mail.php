<?php

namespace bin\epaphrodite\email;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class send_mail 
{

    /* 
     * Instantiation and passing `true` enables exceptions
    */
    function __construct()
    {
        $this->mail = new PHPMailer(true);
    }    


    /**
     * Parametre des messages
     * @return void
    */
    private function settings()
    {
   
        try 
        {

            $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
            $this->mail->isSMTP();                                            
            $this->mail->Host       = 'smtp-fr.securemail.pro';                    
            $this->mail->SMTPAuth   = true;                                   
            $this->mail->Username   = 'aimendri@men-dpes.org';                     
            $this->mail->Password   = '@im3ndr#hope';                               
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
            $this->mail->Port       = 587;                                   
            $this->mail->setFrom('ne-pas-repondre@epaphrodite.com', 'ADMINISTRATEUR EPAPHRODITE');

            return true;

        }catch (Exception $e){

            return false;

        }    

    }

    /**
     * Send messages
     *
     * @param array $contacts
     * @param string $msg_header
     * @param string $msg_content
     * @return void
     */
    public function send( array $contacts , string $msg_header  , string $msg_content )
    {

        if($this->settings()===true)
        {
            //Recipients
            foreach ( $contacts as $k => $value) 
            {
                $this->mail->addAddress($contacts[$k]);
            }
            //$this->mail->addReplyTo('info@example.com', 'Information');
            //$this->mail->addCC('cc@example.com');
            //$this->mail->addBCC('bcc@example.com');

            // Attachments
            //$this->mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            $this->content( $msg_header , $msg_content );
            $msg = $this->mail->send();
            $msg='';
            return 'Message has been sent'; 
            
        }    

    }

    /**
     * Get content of message
     *
     * @param string $msg_header
     * @param string $msg_content
     * @return void
     */
    private function content( string $msg_header  , string $msg_content )
    {

        $this->mail->isHTML(true);
        $this->mail->Subject = $msg_header;
        $this->mail->Body    = $msg_content;
        //$this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    }

}
