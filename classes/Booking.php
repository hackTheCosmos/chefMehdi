<?php

class Booking {
    
    use Sanitize;
    
    private $id;
    private $number_of_persons;
    private $date;
    private $time_slot;
    private $menu;
    private $address;
    private $booking_details;
    private $status;
    private $id_customer;
    
    public function getId(): int {
        return $this->id;
    }
    public function setId(int $id) {
        $this->id = $id;
    }
     public function getNumberOfPersons(): int {
        return $this->number_of_persons;
    }
    public function setNumberOfPersons(int $number_of_persons) {
        $this->number_of_persons = $number_of_persons;
    }
    public function getDate(): string {
        return $this->date;
    }
    
    public function setDate(string $date) {
        $this->date = $date;
    }
     public function getTimeSlot(): string {
        return $this->time_slot;
    }
    public function setTimeSlot(string $time_slot) {
        $this->time_slot = $time_slot;
    }
    
    public function getMenu(): string {
        return $this->menu;
    }
    public function setMenu(string $menu) {
        $this->menu = $menu;
    }
    
    public function getAddress(): string {
        return $this->address;
    }
    public function setAddress(string $address) {
        $this->address = $address;
    }
    
    public function getBookingDetails(): string {
        return $this->booking_details;
    }
    public function setBookingDetails(string $booking_details){
        $this->booking_details = $booking_details;
    }
      public function getSatus(): int {
        return $this->status;
    }
    public function setStatus(int $status) {
        $this->status = $status;
    }
      public function getIdCustomer(): int {
        return $this->id_customer;
    }
    public function setIdCustomer(int $idCustomer) {
        $this->id_customer = $idCustomer;
    }
    
    
      // récupération des valeurs du formulaire de réservation
    public function loadFromPost(): void {
        $this->setNumberOfPersons($this->sanitize(intval($_POST['number_of_persons'])));
        $this->setDate($this->sanitize($_POST["date"]));
        $this->setTimeSlot($this->sanitize($_POST['time']));
        $this->setMenu($this->sanitize($_POST['menu']));
        $this->setAddress($this->sanitize($_POST['address']));
        $this->setBookingDetails($this->sanitize($_POST['bookingDetails']));
    }
    
      // enregistrement d'une réservation dans la base de données
    public function save() {
        $query = "INSERT INTO bookings (number_of_persons, date, time_slot, menu, address, booking_details, id_customer) VALUES (:number_of_persons, :date, :time_slot, :menu, :address, :booking_details, :id_customer)";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":number_of_persons" => $this->getNumberOfPersons(),
            ":date" => $this->getDate(),
            ":time_slot" => $this->getTimeSlot(),
            ":menu" => $this->getMenu(),
            ":address" => $this->getAddress(),
            ":booking_details" => $this->getBookingDetails(),
            ":id_customer" => $_SESSION["ID"]
        ]);
    }
    
    // affiche la vue "mes réservations"
    public function getMyBookings (){
        $query = "SELECT * FROM bookings WHERE id_customer=:id";
        $sth = Db::getDbh()->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Booking");
        $sth->execute([
            ":id" =>  $_SESSION['ID']
            ]);
        $myBooking = $sth->fetchAll();
        if($myBooking) {
            return $myBooking;
        } else {
            return null;
        }
    }
    
    // AFFICHE LA VUE "MES RESERVATIONS" POUR ADMIN (TOUTES LES RESERVATIONS STOCKEES DANS LA BASE DE DONNEES SONT AFFICHEES DE MANIERE A AFFICHER LA RESERVATION LA PLUS PROCHE EN PREMIER DANS LA LISTE)
    public function getMyAdminBookings () {
        $query = "SELECT * FROM bookings ORDER BY date ASC";
        $sth = Db::getDbh()->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Booking");
        $sth->execute();
        $myAdminBookings = $sth->fetchAll();
        if($myAdminBookings) {
            return $myAdminBookings;
        } else {
            return null;
        }
    }
    
    // supprime une réservation à partir de son Id
    public function deleteBookingById($id) {
        $query = "DELETE FROM bookings WHERE id=:id";
        $sth = Db::getDbh()->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Booking");
        $sth->execute([
            ":id" => $id
        ]);
    }
    
    //charge une réservation à partir de son Id
    public function getBookingFromId($id) {
        $query = "SELECT * FROM bookings WHERE id=:id";
        $sth = Db::getDbh()->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Booking");
        $sth->execute([
            ":id" => $id
        ]);
        $myBookingFromId = $sth->fetch();
        if($myBookingFromId) {
            return $myBookingFromId;
        } else {
            return null;
        }
    }
    
    //formate la date depuis année/mois/jour vers jour/mois/année
    public function formatTheDate (string $date): string {
        $timestamp = strtotime($date);
        return date("d/m/Y", $timestamp);
    }
    
    //récupère le nom du client à partir de l'id de la réservation
    public function getNameById ($id) {
        $query ="SELECT lastname FROM users WHERE id=:id";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":id" => $id
        ]); 
        $nameFromBookingId = $sth->fetch();
        if($nameFromBookingId) {
            return $nameFromBookingId;
        } else {
            return null;
        }
    }
    
}