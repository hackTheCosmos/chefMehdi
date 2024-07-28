<?php


class Mailer {
    public static function sendMail(string $subject, string $address, string $message) {
        
        require_once "secure/config.php";
        
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer();
            
        //Server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP();                                            
        $mail->Host = 'smtp.hostinger.com';                     
        $mail->SMTPAuth = true;                                   
        $mail->Username = $myEmail;                     
        $mail->Password = $mailPass;                               
        $mail->SMTPSecure = "ssl";            
        $mail->Port = 465;                                  
    
        //Recipients
        $mail->setFrom($myEmail);
        $mail->addAddress($address);
        
        //encodage
        $mail->CharSet = "UTF-8";
    
        //Content
        $mail->isHTML();
        $mail->Subject = $subject;
        $mail->Body = $message;
    
        // send
        $mail->send();
    }
    
}

