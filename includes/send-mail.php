<?php

require "PHPMailer-master/src/PHPMailer.php";
require "PHPMailer-master/src/SMTP.php";
require "PHPMailer-master/src/Exception.php";

function sendEmail($to, $subject, $body, $from = 'vndnetwork@gmail.com', $fromName = 'FRUITS SHOP')
{
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        $mail->SMTPDebug = 0;  // 0,1,2: chế độ debug
        $mail->isSMTP();
        $mail->CharSet = "utf-8";
        $mail->Host = 'smtp.gmail.com'; // Địa chỉ server
        $mail->SMTPAuth = true;
        $mail->Username = 'vndnetwork@gmail.com';
        $mail->Password = 'lvql xaah ofwb ueoo'; // mật khẩu ứng dụng
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // Thiết lập thông tin người gửi
        $mail->setFrom($from, $fromName);

        // Thiết lập thông tin người nhận
        $mail->addAddress($to);

        // Nội dung email
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = nl2br($body);

        // Thiết lập bảo mật SSL
        $mail->smtpConnect(
            array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            )
        );

        // Gửi email
        $mail->send();
        return 'Đã gửi mail xong';
    } catch (Exception $e) {
        return 'Mail không gửi được. Lỗi: ' . $mail->ErrorInfo;
    }
}


?>