<?php
    class UserModel{
        private $db;
        public function __construct()
        {
            $this->db = new Database;
        }

        /*users - readers & workers*/

        public function changeUser($nowyEmail,$nowyTelefon,$userId)
        {
            $query='UPDATE "Uzytkownicy" SET email = :email, telefon=:telefon WHERE id_uzytkownika=:id_uzytkownika;';
            $this->db->query($query);
            $this->db->bind(':email',$nowyEmail);
            $this->db->bind(':telefon',$nowyTelefon);
            $this->db->bind(':id_uzytkownika',$userId);
            $this->db->execute();
        }
        
        public function getUserByEmail($email){
            $query='SELECT * FROM "Uzytkownicy" WHERE email = :email';
            $this->db->query($query);
            $this->db->bind(':email',$email);
            $result=$this->db->single();
            return $result;
        }

        public function getUserById($id_uzytkownika){
            $query='SELECT * FROM "Uzytkownicy" WHERE id_uzytkownika = :id_uzytkownika';
            $this->db->query($query);
            $this->db->bind(':id_uzytkownika',$id_uzytkownika);
            $result=$this->db->single();
            return $result;
        }

        /*readers*/

        public function getAllReaders(){
            $query='SELECT * FROM "Uzytkownicy" WHERE typ_konta=\'czytelnik\'';
            $this->db->query($query);
            $result=$this->db->resultSet();
            return $result;
        }

        public function createReader(){
            $query='INSERT INTO "Uzytkownicy" (email, haslo, telefon,typ_konta)
            VALUES (:email, :password, :phone, :typ_konta);';
            $this->db->query($query);
            $this->db->bind(':email',$_POST['email']);
            $hashedPassword=password_hash($_POST['password'],PASSWORD_DEFAULT);
            $this->db->bind(':password',$hashedPassword);
            $this->db->bind(':phone',$_POST['phone']);
            $this->db->bind(':typ_konta','czytelnik');
            $this->db->execute();
        }

        /*workers*/

        public function getAllWorkers(){
            $query='SELECT * FROM "Uzytkownicy" WHERE typ_konta=\'pracownik\' OR typ_konta=\'administrator\'';
            $this->db->query($query);
            $result=$this->db->resultSet();
            return $result;
        }

        public function createWorker(){
            $query='INSERT INTO "Uzytkownicy" (email, haslo, telefon,typ_konta,limit_ksiazek)
            VALUES (:email, :password, :phone, :typ_konta, :limit_ksiazek);';
            $this->db->query($query);
            $this->db->bind(':email',$_POST['email']);
            $hashedPassword=password_hash($_POST['password'],PASSWORD_DEFAULT);
            $this->db->bind(':password',$hashedPassword);
            $this->db->bind(':phone',$_POST['phone']);
            $this->db->bind(':typ_konta','pracownik');
            $this->db->bind(':limit_ksiazek',0);
            $this->db->execute();
        }

        public function changeToAvailable($workerId)
        {
            $query='UPDATE "Uzytkownicy" SET status = :status WHERE id_uzytkownika=:id_uzytkownika;';
            $this->db->query($query);
            $this->db->bind(':status','dostepny');
            $this->db->bind(':id_uzytkownika',$workerId);
            $this->db->execute();
        }

        public function changeToLocked($workerId)
        {
            $query='UPDATE "Uzytkownicy" SET status = :status WHERE id_uzytkownika=:id_uzytkownika;';
            $this->db->query($query);
            $this->db->bind(':status','zablokowany');
            $this->db->bind(':id_uzytkownika',$workerId);
            $this->db->execute();
        }
    }
?>