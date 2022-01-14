<?php
    class UserModel{
        private $db;
        public function __construct()
        {
            $this->db = new Database;
        }
        public function getUserByEmail($email){
            $query='SELECT * FROM "Uzytkownicy" WHERE email = :email';
            $this->db->query($query);
            $this->db->bind(':email',$email);
            $result=$this->db->single();
            return $result;
        }

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
    }
?>