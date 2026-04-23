<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once("C:/xampp/htdocs/ISAUNNY/vendor/autoload.php");

function sendWelcomeEmail(string $toEmail, string $toName): bool
{
    $phpmailer = new PHPMailer(true);

    try {
       
        $phpmailer->isSMTP();
        $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = 'b39ff498d746f6';
        $phpmailer->Password = '2b9b51c36c4669';

        $phpmailer->setFrom('no-reply@isaunny.com', 'I.sAunny');
        $phpmailer->addAddress($toEmail, $toName);

        $phpmailer->isHTML(true);
        $phpmailer->Subject = 'Bienvenue sur I.sAunny';
        $phpmailer->Body    = "
            <h1>Bienvenue $toName !</h1>
            <p>Votre inscription sur <strong>I.sAunny</strong> a bien été prise en compte.</p>
            <p>Vous pouvez maintenant vous connecter et participer au blog.</p>
        ";

        $phpmailer->AltBody = "Bienvenue $toName ! Votre inscription sur I.sAunny a bien été prise en compte.";

        $phpmailer->send();
        return true;

    } catch (Exception $e) {
    echo "Erreur Mailtrap / PHPMailer : " . $phpmailer->ErrorInfo;
    return false;

    }
}

function sendContactEmail(string $nom, string $email, string $message): bool
{
    $phpmailer = new PHPMailer(true);

    try {
        $phpmailer->isSMTP();
        $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = 'b39ff498d746f6';
        $phpmailer->Password = '2b9b51c36c4669';

        $phpmailer->setFrom('no-reply@isaunny.com', 'I.sAunny');
        $phpmailer->addReplyTo($email, $nom);
        $phpmailer->addAddress('admin@isaunny.com');

        $phpmailer->isHTML(true);
        $phpmailer->Subject = 'Nouveau message de contact';

        $phpmailer->Body = "
            <h3>Nouveau message</h3>
            <p><strong>Nom :</strong> $nom</p>
            <p><strong>Email :</strong> $email</p>
            <p><strong>Message :</strong><br>$message</p>
        ";

        $phpmailer->AltBody = "Nom: $nom | Email: $email | Message: $message";

        $phpmailer->send();
        return true;

    } catch (Exception $e) {
        return false;
    }
}