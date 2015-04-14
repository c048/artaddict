<?php
    require_once ('phpmailer/class.phpmailer.php');
    require_once ('phpmailer/mail_template.php');

    $l_sMessage = nl2br(htmlspecialchars($_POST['msg']));

    $sTemplate = new Template($_POST['name'], $_POST['surname'], $_POST['company'], $_POST['address'], $_POST['zip'], $_POST['city'], $_POST['country'], $_POST['email'], $_POST['phone'], $l_sMessage);
    $mail = new PHPMailer;

    $mail->Host = 'smtp.telenet.be';
    $mail->Port = 587;
    $mail->Username = 'jorik.janssens@telenet.be';
    $mail->Password = 'jas156';
    $mail->SMTPAuth = true;
    $mail->SMTPDebug = 0;
    $mail->SMTPSecure = "tls";

    $mail->From = ($_POST['email']);
    $mail->FromName = ($_POST['name'] . ' ' . $_POST['surname']);
    $mail->addAddress('jorik.janssens@telenet.be', 'Jorik Janssens');
    $mail->addReplyTo($_POST['name'] . ' ' . $_POST['surname']);

    $mail->isHTML(true);

    $mail->Subject = 'Product request';
    $mail->Body = $sTemplate->emailTemplate();
    $mail->AltBody = $sTemplate->emailTemplate();

    if (!$mail->send()) {
        echo $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
?>