<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

class Sweat extends Controller
{
    /*
     * @return void
     */


    public function index()
    {
        $this->loadModel("Sweats");
        $this->render('index');
    }

    public function success()
    {
        $this->render('success');
    }

    public function error()
    {
        $this->render('error');
    }

    public function create()
    {
        $this->loadModel("Sweats");
        $this->Sweats->create();
        $name = $_POST['name'];
        $firstName = $_POST['firstName'];
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->CharSet = "utf-8";
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;
        $mail->Username = 'nbc.contact.sweat@gmail.com';
        $mail->Password = '';
        $mail->setFrom('nbc.contact.sweat@gmail.com', 'Confirmation de commande Sweat NBC');
        $mail->addAddress($_POST["mail"], $name . " " . $firstName);
        $mail->Subject = 'Votre commande de Sweat';
        $mail->msgHTML("<p>Madame, Monsieur</p><p>Nous vous confirmons la bonne prise en compte de votre commande et vous en remercions.</p><p>Voici les détails de votre commande à imprimer/joindre dans l'enveloppe de votre réglement et à donner à votre coach.</p><table><tr style='border: 1px solid black; padding: 5px 10px'><th style='border: 1px solid black; padding: 5px 10px'>Nom</th><th style='border: 1px solid black; padding: 5px 10px'>Prénom</th><th style='border: 1px solid black; padding: 5px 10px'>Taille</th><th style='border: 1px solid black; padding: 5px 10px'>Couleur</th><th style='border: 1px solid black; padding: 5px 10px'>Flockage</th></tr><tr style='border: 1px solid black; padding: 5px 10px'><td style='border: 1px solid black; padding: 5px 10px'>$_POST[name]</td><td style='border: 1px solid black; padding: 5px 10px'>$firstName</td><td style='border: 1px solid black; padding: 5px 10px; text-align: center'>$_POST[size]</td><td style='border: 1px solid black; padding: 5px 10px'>$_POST[colors]</td><td style='border: 1px solid black; padding: 5px 10px'>$_POST[flocking]</td></tr></table><p>Sans paiement reçu (10 décembre maximum), votre commande ne sera pas prise en compte.</p><p>Cordialement,<br>Le bureau NBC</p>");
        if (!$mail->send()) {
            header('location: /error');
            //echo "Mail error: " . $mail->ErrorInfo;
        } else {
            header('location: /sweat/success');
        }
    }

    public function read()
    {
        $this->loadModel("Sweats");

        if (!isset($_POST['search'])) {
            $data = $this->Sweats->read();
        } else {
            $data = $this->Sweats->search($_POST['search']);
        }
        foreach ($data as $x => $dat) {
            $dat['received'] == 0 ? $data[$x]['received'] = '' : $data[$x]['received'] = 'checked';
            $dat['took'] == 0 ? $data[$x]['took'] = '' : $data[$x]['took'] = 'checked';
            $dat['payed'] == 0 ? $data[$x]['payed'] = '' : $data[$x]['payed'] = 'checked';
        }
        $this->render('read', compact('data'));
    }

    public function updatePayed($id)
    {
        $this->loadModel("Sweats");
        $params = $this->Sweats->getCurrentPayedRequest($id);
        $params["payed"] == 1 ? $params["payed"] = 0 : $params["payed"] = 1;
        $this->Sweats->updatePayed($id, $params["payed"]);
        if ($params["payed"] == 1){
            $mailPayed = new PHPMailer();
            $mailPayed->isSMTP();
            $mailPayed->CharSet = "utf-8";
            //$mailPayed->SMTPDebug = SMTP::DEBUG_SERVER;
            $mailPayed->Host = 'smtp.gmail.com';
            $mailPayed->Port = 465;
            $mailPayed->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mailPayed->SMTPAuth = true;
            $mailPayed->Username = 'nbc.contact.sweat@gmail.com';
            $mailPayed->Password = '';
            $mailPayed->setFrom('nbc.contact.sweat@gmail.com', 'Confirmation de la réception du paiement');
            $mailPayed->addAddress($params["mail"], $params["name"] . " " . $params["firstName"]);
            $mailPayed->Subject = 'Confirmation de la réception du paiement';
            $mailPayed->msgHTML("<p>Madame, Monsieur</p><p>Nous vous confirmons la bonne réception  de votre paiement pour le Neubourg Basket Club (commande de sweat).</p><p>Cordialement,<br>Le bureau NBC</p>");
            if (!$mailPayed->send()) {
                //header('location: /error');
                echo "Mail error: " . $mailPayed->ErrorInfo;
            } else {
                header('location:/sweat/read');
            }
        }
        else {
            header('location:/sweat/read');
        }
    }

    public function updateReceived($id)
    {
        $this->loadModel("Sweats");
        $params = $this->Sweats->getCurrentReceivedRequest($id);
        $params[0] == 1 ? $params = 0 : $params = 1;
        $this->Sweats->updateReceived($id, $params);
        header('location:/sweat/read');
    }

    public function updateReceivedWithMail($id)
    {
        $this->loadModel("Sweats");
        $params = $this->Sweats->getCurrentReceivedRequest($id);
        $params["received"] == 1 ? $params["received"] = 0 : $params["received"] = 1;
        $this->Sweats->updateReceivedWithMail($id, $params);
        $mailReceived = new PHPMailer();
        $mailReceived->isSMTP();
        $mailReceived->CharSet = "utf-8";
        //$mailReceived->SMTPDebug = SMTP::DEBUG_SERVER;
        $mailReceived->Host = 'smtp.gmail.com';
        $mailReceived->Port = 465;
        $mailReceived->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mailReceived->SMTPAuth = true;
        $mailReceived->Username = 'nbc.contact.sweat@gmail.com';
        $mailReceived->Password = '';
        $mailReceived->setFrom('nbc.contact.sweat@gmail.com', 'Confirmation de réception');
        $mailReceived->addAddress($params["mail"], $params["name"] . " " . $params["firstName"]);
        $mailReceived->Subject = 'Confirmation de reception';
        $mailReceived->msgHTML("<p>Madame, Monsieur</p><p>Votre commande de sweat suivante est arrivé</p><table><tr style='border: 1px solid black; padding: 5px 10px'><th style='border: 1px solid black; padding: 5px 10px'>Nom</th><th style='border: 1px solid black; padding: 5px 10px'>Prénom</th><th style='border: 1px solid black; padding: 5px 10px'>Taille</th><th style='border: 1px solid black; padding: 5px 10px'>Couleur</th><th style='border: 1px solid black; padding: 5px 10px'>Flockage</th></tr><tr style='border: 1px solid black; padding: 5px 10px'><td style='border: 1px solid black; padding: 5px 10px'>$params[name]</td><td style='border: 1px solid black; padding: 5px 10px'>$params[firstName]</td><td style='border: 1px solid black; padding: 5px 10px; text-align: center'>$params[size]</td><td style='border: 1px solid black; padding: 5px 10px'>$params[colors]</td><td style='border: 1px solid black; padding: 5px 10px'>$params[flocking]</td></tr></table><p>Vous pouvez dés à présent venir la retirer en montrant ce mail.</p><p>Cordialement,<br>Le bureau NBC</p>");
        if (!$mailReceived->send()) {
            header('location: /error');
            //echo "Mail error: " . $mailReceived->ErrorInfo;
        } else {
            header('location:/sweat/read');
        }
    }

    public function updateTook($id)
    {
        $this->loadModel("Sweats");
        $params = $this->Sweats->getCurrentTookRequest($id);
        $params[0] == 1 ? $params = 0 : $params = 1;
        $this->Sweats->updateTook($id, $params);
        header('location:/sweat/read');
    }

    public function delete($id){
        if ( $_SESSION['loged'] == true ) {
            $this->loadModel("Sweats");
            $this->Sweats->delete($id);
            header('location:/sweat/read');
        } else {
            header('location:/login');
        }
    }
}