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
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;
        $mail->Username = 'nbc.contact.sweat@gmail.com';
        $mail->Password = '';
        $mail->setFrom('nbc.contact.sweat@gmail.com', 'First Last');
        $mail->addAddress($_POST["mail"], $name . " " . $firstName);
        $mail->Subject = 'Votre commande de Sweat';
        $mail->msgHTML("eze");
        if (!$mail->send()) {
            //header('location: /error');
            echo "Mail error: " . $mail->ErrorInfo;
        } else {
            header('location: ./success');
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
        $params[0] == 1 ? $params = 0 : $params = 1;
        $this->Sweats->updatePayed($id, $params);
        header('location:/sweat/read');
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
        $this->Sweats->updateReceived($id, $params);

        $mailReceived = new PHPMailer();
        $mailReceived->isSMTP();
        $mailReceived->SMTPDebug = SMTP::DEBUG_SERVER;
        $mailReceived->Host = 'smtp.gmail.com';
        $mailReceived->Port = 465;
        $mailReceived->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mailReceived->SMTPAuth = true;
        $mailReceived->Username = 'nbc.contact.sweat@gmail.com';
        $mailReceived->Password = '';
        $mailReceived->setFrom('nbc.contact.sweat@gmail.com', 'Confirmation de reception');
        $mailReceived->addAddress($params["mail"], $params["name"] . " " . $params["firstName"]);
        $mailReceived->Subject = 'Confirmation de reception';
        $mailReceived->msgHTML("Yes on l'a");
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
}