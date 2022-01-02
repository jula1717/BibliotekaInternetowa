<?php
    class FirstModel{
        private $db;
        public function __construct()
        {
            $this->db = new Database;
        }

        public function getAutorzy(){
            $query='SELECT * FROM "Ksiazki"';
            $this->db->query($query);
            $result=$this->db->resultSet();
            return $result;
        }
    }
?>