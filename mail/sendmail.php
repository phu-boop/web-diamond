<?php
require 'PHPMailer/src/OAuthTokenProvider.php';
require 'PHPMailer/src/OAuth.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Mailer {
    public function dathangmail($tieude,$noidung,$maildathang){
        $mail = new PHPMailer(true);
        $mail->CharSet='UTF-8';                        
        try {
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'phunla2784@gmail.com';                 // SMTP username
            $mail->Password = 'tquwfzxtkzjuiklw';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
        
            //Recipients
            $mail->setFrom('phunla2784@gmail.com', 'Mailer');
            $mail->addAddress($maildathang, 'Anh phu');     // Add a recipient
            $mail->addCC('phunla2784@gmail.com');
        
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $tieude;
            $mail->Body    = $noidung;
        
            $mail->send();
            echo 'Chúng tôi đã gửi email xác nhận đơn hàng thành công!';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
}
?>