<?php

class Sweats extends Model
{


    public function __construct()
    {
        $this->bddConnexion();
        $this->table = "nbc";
    }

    public function create()
    {
        $name = $_POST["name"];
        $firstName = $_POST["firstName"];
        $email = htmlspecialchars($_POST["mail"]);
        $tel = $_POST["tel"];
        $size = $_POST["size"];
        $flocking = $_POST["flocking"];
        $colors = $_POST['colors'];
        $sql = "INSERT INTO request (name, firstName, mail, tel, flocking, size, colors ,received, took, payed) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $query = $this->bdd->prepare($sql);
        $res = $query->execute(array($name, $firstName, $email, $tel, $flocking, $size, $colors ,0, 0, 0));
        return $res;
    }

    public function read()
    {
        $sql = "SELECT * FROM request";
        $query = $this->bdd->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function getCurrentPayedRequest($id)
    {
        $sql = "SELECT mail, payed, name, firstName FROM request WHERE request.id = $id";
        $query = $this->bdd->prepare($sql);
        $res = $query->execute();
        return $query->fetch();
    }

    public function getCurrentReceivedRequest($id)
    {
        $sql = "SELECT received, mail, name, firstName, size, colors, flocking FROM request WHERE request.id = $id";
        $query = $this->bdd->prepare($sql);
        $res = $query->execute();
        return $query->fetch();
    }

    public function getCurrentTookRequest($id)
    {
        $sql = "SELECT took FROM request WHERE request.id = $id";
        $query = $this->bdd->prepare($sql);
        $res = $query->execute();
        return $query->fetch();
    }

    public function updatePayed($id, $params)
    {
        $sql = "UPDATE request SET payed = $params WHERE request.id = $id";
        $query = $this->bdd->prepare($sql);
        $res = $query->execute();
    }

    public function updateReceived($id, $params)
    {
        $sql = "UPDATE request SET received = $params WHERE request.id = $id";
        $query = $this->bdd->prepare($sql);
        $res = $query->execute();
    }
    public function updateReceivedWithMail($id, $params)
    {
        $sql = "UPDATE request SET received = $params[received] WHERE request.id = $id";
        $query = $this->bdd->prepare($sql);
        $res = $query->execute();
    }

    public function updateTook($id, $params)
    {
        $sql = "UPDATE request SET took = $params WHERE request.id = $id";
        $query = $this->bdd->prepare($sql);
        $res = $query->execute();
    }

    public function search($search)
    {
        $sql = "SELECT * FROM request WHERE name LIKE '%$search%' OR firstName LIKE '%$search%' OR tel LIKE '%$search%' OR mail LIKE '%$search%'";
        $query = $this->bdd->prepare($sql);
        $res = $query->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM request WHERE request.id = $id";
        $query = $this->bdd->prepare($sql);
        $res = $query->execute();
    }
}