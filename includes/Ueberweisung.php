<?php
require_once 'Db.php';

class Ueberweisung
{
    private $uibansender;
    private $ubicsender;
    private $uibanempfaenger;
    private $ubicempfaenger;
    private $uzahlungsreferenz;
    private $uverwendungszweck;
    private $ubetrag;
    private $udatum;
    private $kid;


    /**
     * Ueberweisung constructor.
     */
    public function __construct()
    {
        $this->udatum = date("Y-m-d H:i:s");
        $this->getSenderBicIban();
    }

    public function createUeberweisung()
    {
        $pdo = Db::connect();
        $sql = "INSERT INTO ueberweisung (uibansender, ubicsender, uibanempfaenger, ubicempfaenger, uzahlungsreferenz, uverwendungszweck, ubetrag, udatum, kid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->uibansender, $this->ubicsender, $this->uibanempfaenger, $this->ubicempfaenger, $this->uzahlungsreferenz, $this->uverwendungszweck, $this->ubetrag, $this->udatum, $this->kid]);
    }

    public function getSenderBicIban()
    {
        $pdo = Db::connect();
        $sql = "SELECT koiban, kobic FROM konto WHERE kid='" .$_SESSION['userid'] ."';";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->setUibansender($result['koiban']);
        $this->setUbicsender($result['kobic']);
    }

    public function getAll($kundeiban)
    {
        $pdo = Db::connect();
        $sql = "SELECT uibansender, ubicsender, uibanempfaenger, ubicempfaenger, uzahlungsreferenz, uverwendungszweck, ubetrag, udatum FROM ueberweisung WHERE uibansender = ? OR uibanempfaenger = ?;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($kundeiban, $kundeiban));
        $result = $stmt->fetchAll();
        return $result;
    }

    public function einzahlungSchalter($iban, $betrag)
    {
        $pdo = Db::connect();
        $sql = "UPDATE konto SET kokontostand = (kokontostand + ?) WHERE koiban = ?;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($betrag, $iban));
    }

    public function auszahlungSchalter($iban, $betrag)
    {
        $pdo = Db::connect();
        $sql = "UPDATE konto SET kokontostand = (kokontostand - ?) WHERE koiban = ?;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($betrag, $iban));
    }

    public function getAllDatum($kundeiban, $datum)
    {
        $pdo = Db::connect();
        $sql = "SELECT uibansender, ubicsender, uibanempfaenger, ubicempfaenger, uzahlungsreferenz, uverwendungszweck, ubetrag, udatum FROM ueberweisung WHERE CONVERT(udatum, CHAR) LIKE CONCAT( '%',?,'%') AND (uibansender = ? OR uibanempfaenger = ?);" ;
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($datum, $kundeiban, $kundeiban));
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getAllDatumVonBis($kundeiban, $datumvon, $datumbis)
    {
        $pdo = Db::connect();
        $sql = "SELECT uibansender, ubicsender, uibanempfaenger, ubicempfaenger, uzahlungsreferenz, uverwendungszweck, ubetrag, udatum FROM ueberweisung WHERE (uibansender = ? OR uibanempfaenger = ?) AND udatum BETWEEN ? AND ?;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($kundeiban, $kundeiban, $datumvon, $datumbis));
        $result = $stmt->fetchAll();
        return $result;
    }

    /**
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param mixed $uid
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
    }

    /**
     * @return mixed
     */
    public function getUibansender()
    {
        return $this->uibansender;
    }

    /**
     * @param mixed $uibansender
     */
    public function setUibansender($uibansender)
    {
        $this->uibansender = $uibansender;
    }

    /**
     * @return mixed
     */
    public function getUbicsender()
    {
        return $this->ubicsender;
    }

    /**
     * @param mixed $ubicsender
     */
    public function setUbicsender($ubicsender)
    {
        $this->ubicsender = $ubicsender;
    }

    /**
     * @return mixed
     */
    public function getUibanempfaenger()
    {
        return $this->uibanempfaenger;
    }

    /**
     * @param mixed $uibanempfaenger
     */
    public function setUibanempfaenger($uibanempfaenger)
    {
        $this->uibanempfaenger = $uibanempfaenger;
    }

    /**
     * @return mixed
     */
    public function getUbicempfaenger()
    {
        return $this->ubicempfaenger;
    }

    /**
     * @param mixed $ubicempfaenger
     */
    public function setUbicempfaenger($ubicempfaenger)
    {
        $this->ubicempfaenger = $ubicempfaenger;
    }

    /**
     * @return mixed
     */
    public function getUzahlungsreferenz()
    {
        return $this->uzahlungsreferenz;
    }

    /**
     * @param mixed $uzahlungsreferenz
     */
    public function setUzahlungsreferenz($uzahlungsreferenz)
    {
        $this->uzahlungsreferenz = $uzahlungsreferenz;
    }

    /**
     * @return mixed
     */
    public function getUverwendungszweck()
    {
        return $this->uverwendungszweck;
    }

    /**
     * @param mixed $uverwendungszweck
     */
    public function setUverwendungszweck($uverwendungszweck)
    {
        $this->uverwendungszweck = $uverwendungszweck;
    }

    /**
     * @return mixed
     */
    public function getUbetrag()
    {
        return $this->ubetrag;
    }

    /**
     * @param mixed $ubetrag
     */
    public function setUbetrag($ubetrag)
    {
        $this->ubetrag = $ubetrag;
    }

    /**
     * @return mixed
     */
    public function getUdatum()
    {
        return $this->udatum;
    }

    /**
     * @param mixed $udatum
     */
    public function setUdatum($udatum)
    {
        $this->udatum = $udatum;
    }

    /**
     * @return mixed
     */
    public function getKid()
    {
        return $this->kid;
    }

    /**
     * @param mixed $kid
     */
    public function setKid($kid)
    {
        $this->kid = $kid;
    }

}