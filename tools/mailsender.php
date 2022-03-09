<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

function mailsendEcode($accescode, $email, $mailsubject, $name) {
            
    $maila = new PHPMailer();
    $maila->IsSMTP();									
    $maila->Host = $_SERVER['SMTP_HOST']; 
    $maila->SMTPAuth = true;
    $maila->SMTPSecure = "ssl";
    $maila->Port = $_SERVER['SMTP_PORT'];										
    $maila->Username = $_SERVER['SMTP_USERNAME'];			
    $maila->Password = $_SERVER['SMTP_PASSWORD'];
    $maila->From = $_SERVER['SMTP_SENDER_EMAIL'];						
    $maila->FromName = $_SERVER['SMTP_SENDER_NAME'];						
    $maila->AddAddress($email);		
    $maila->WordWrap = 50;	
    $maila->IsHTML(true);	
    $maila->CharSet = 'UTF-8';    
    $maila->Subject = $mailsubject;							
    $maila->Body    = "Tisztelt ".$name."! <br><br> 
                    A belépéshez szükséges kód a következő: <br><br>
                    ".$accescode." <br><br> 
                    
                    Üdvözlettel: Adminisztrátor";
                    
    if(!$maila->Send())
    {
        echo '<div class="errorMessage">
             <p>Kód küldése sikertelen!</p><br>
             </div>';
        echo '<div class="linkMessage">
             <p><a href="/">Próbálja újra ide kattintva</a></p>
             </div>';
    } 
}


function mailsendPassw($password, $email, $mailsubject, $name) {
            
     $maila = new PHPMailer();
     $maila->IsSMTP();									
     $maila->Host = $_SERVER['SMTP_HOST']; 
     $maila->SMTPAuth = true;
     $maila->SMTPSecure = "ssl";
     $maila->Port = $_SERVER['SMTP_PORT'];										
     $maila->Username = $_SERVER['SMTP_USERNAME'];			
     $maila->Password = $_SERVER['SMTP_PASSWORD'];
     $maila->From = $_SERVER['SMTP_SENDER_EMAIL'];						
     $maila->FromName = $_SERVER['SMTP_SENDER_NAME'];						
     $maila->AddAddress($email);		
     $maila->WordWrap = 50;	
     $maila->IsHTML(true);	
     $maila->CharSet = 'UTF-8';    
     $maila->Subject = $mailsubject;							
     $maila->Body    = "Tisztelt ".$name."! <br><br> 
                     A belépéshez szükséges jelszó a következő: <br><br>
                     ".$password." <br><br> 
                     
                     Üdvözlettel: Adminisztrátor";
                     
     if(!$maila->Send())
     {
         echo '<div class="errorMessage">
              <p>Jelszó küldése sikertelen!</p><br>
              </div>';
         echo '<div class="linkMessage">
              <p><a href="forgottpassword">Próbálja újra ide kattintva</a></p>
              </div>';
     } 
 
 }

?>