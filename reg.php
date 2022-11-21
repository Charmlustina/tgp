<?php


include "config.php";
    //Server settings
    header("Content-Type: application/json");
header("Acess-Control-Allow-Origin: *");
header("Acess-Control-Allow-Methods: POST");
header("Acess-Control-Allow-Headers: Acess-Control-Alllow-Headers, Content-Type, Acess-Control-Allow-Methods, Authorization");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$data = json_decode(file_get_contents("php://input"), true);

    $SixDigitRandomNumber = rand(100000,999999);
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $address = $_POST['default_delivery_address'];

    $mail->SMTPDebug = 2;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'frtgpstr@gmail.com';                      //SMTP username
    $mail->Password   = 'frtgpstr123';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('frtgpstr@gmail.com');
    $mail->addAddress($email);     //Add a recipient             //Name is optional
    $mail->addReplyTo('frtgpstr@gmail.com');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'TGP Email Verification';
    $mail->Body    =  ' 
    <html> 
    <head> 

    </head> 
    <body> 
        <h2>Verify your email address to complete your registration</h2> 
        <h4>To finish setting up your TGP account, we just need to make sure that this email address is yours.</h4>
        <h4>To verify your email address use this security code: <b>'.$SixDigitRandomNumber.'</b></h4>
        <br>
        <h4>Thankyou</h4>
    </body> 
    </html>';
    
              
    $mail->send();
    echo 'Message has been sent';

if (isset($_POST['registration'])){


$qry = "INSERT INTO clients (firstname, lastname, gender, contact, email, password, default_delivery_address, verinum) VALUES ('".$fname."', '".$lname."', '".$gender."', '".$contact."', '".$email."', '".$password."', '".$address."', '".$SixDigitRandomNumber."')";
$insert = mysqli_query($conn,$qry);
if(!$insert){
    header("refresh:0;url=registration.php");
}
else
{
    header("refresh:0;url=verify.php");
}
}

?>