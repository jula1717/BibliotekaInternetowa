<?php
    class UserModel{
        private $db;
        public function __construct()
        {
            $this->db = new Database;
        }
        public function getUserByEmail($email){
            $query='SELECT * FROM "Czytelnicy" WHERE email = :email';
            $this->db->query($query);
            $this->db->bind(':email',$email);
            $result=$this->db->single();
            return $result;
        }
        public function createUser(){
            $query='INSERT INTO "Czytelnicy" (email, haslo, telefon)
            VALUES (:email, :password, :phone);';
            $this->db->query($query);
            $this->db->bind(':email',$_POST['email']);
            $hashedPassword=password_hash($_POST['password'],PASSWORD_DEFAULT);
            $this->db->bind(':password',$hashedPassword);
            $this->db->bind(':phone',$_POST['phone']);
            $this->db->execute();
        }
    }
?>