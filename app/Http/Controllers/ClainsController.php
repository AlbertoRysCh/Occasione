<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ClainsController extends Controller
{

    

    //
    public function __invoke(){
        return view('clains-book');
    }
     
    public function send(){
        //Load Composer's autoloader 
        // require 'PHPMailer/vendor/autoload.php';

        // //Create an instance; passing `true` enables exceptions
        // $mail = new PHPMailer(true);

        // try {
        //     //Server settings
        //     $mail->SMTPDebug = true;                                       //Enable verbose debug output
        //     $mail->isSMTP();                                            //Send using SMTP
        //     $mail->Host       = env('MAIL_HOST');                       //Set the SMTP server to send through
        //     $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        //     $mail->Username   =  env('MAIL_USERNAME');                  //SMTP username
        //     $mail->Password   = env('MAIL_PASSWORD');                   //SMTP password
        //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        //     $mail->Port       = env('MAIL_PORT');                       //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //     //Recipients 
        //     $mail->setFrom( env('MAIL_FROM_ADDRESS_VTS'),  env('MAIL_EMPRICE')); 
        //     $mail->addAddress('jhed.salas.987@gmail.com','Edward'); //Cuenta de Supervisor
 
        //     //Content
        //     $mail->isHTML(true);                                  //Set email format to HTML
        //     $mail->Subject = 'Libro de Reclamaciones';
        //     $mail->Body    = 'This is the HTML message body <b>in bold!</b>'; 

        //     $mail->send();
        //     return redirect()->back();
        // } catch (Exception $e) {
        //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        // }
    }
}
