<?php
    class BookModel{
        private $db;
        public function __construct()
        {
            $this->db = new Database;
        }
        public function getReaderBorrows($readerId){
           
            $query='SELECT "Wypozyczenia".id_wypozyczenia, "Czytelnicy".email AS "czyt_email", "Ksiazki".tytul, "Wypozyczenia".id_egzemplarza, 
            to_char("Wypozyczenia".data_wypozyczenia, \'DD.MM.YYYY\') AS data_wypozyczenia, to_char("Wypozyczenia".data_oddania, \'DD.MM.YYYY\') AS data_oddania, 
            "Wypozyczenia".prolongowane, "Pracownicy".email AS "prac_email", to_char(data_wypozyczenia + INTERVAL \'14 day\',\'DD.MM.YYYY\') AS termin_ost_nieprol, to_char(data_wypozyczenia + INTERVAL \'28 day\',\'DD.MM.YYYY\') AS termin_ost_prol 
            FROM "Wypozyczenia" 
            INNER JOIN "Uzytkownicy" AS "Czytelnicy" 
            ON "Wypozyczenia".id_czytelnika = "Czytelnicy".id_uzytkownika
            INNER JOIN "Egzemplarze" 
            ON "Wypozyczenia".id_egzemplarza = "Egzemplarze".id_egzemplarza
            INNER JOIN "Ksiazki" 
            ON "Egzemplarze".id_ksiazki = "Ksiazki".id_ksiazki
            LEFT JOIN "Uzytkownicy" AS "Pracownicy" 
            ON "Wypozyczenia".id_pracownika_odbior = "Pracownicy".id_uzytkownika WHERE id_czytelnika=:id_czytelnika ORDER BY id_wypozyczenia DESC;';
            $this->db->query($query);
            $this->db->bind(':id_czytelnika',$readerId);
            $result=$this->db->resultSet();
            return $result;
        }

        public function returnBook($borrowId)
        {
            $query='UPDATE "Wypozyczenia" SET data_oddania = :data_oddania,id_pracownika_odbior = :id_pracownika_odbior WHERE id_wypozyczenia=:id_wypozyczenia;';
            $this->db->query($query);
            $this->db->bind(':data_oddania',date("Y-m-d"));
            $this->db->bind(':id_pracownika_odbior',$_SESSION['userData']->id_uzytkownika);
            $this->db->bind(':id_wypozyczenia',$borrowId);
            $this->db->execute();
        }

        public function getCategories()
        {
            $query='SELECT * FROM "Kategorie";';
            $this->db->query($query);
            $result=$this->db->resultSet();
            return $result;
        }

        public function addCategory($nazwa)
        {
            $query='INSERT INTO "Kategorie" VALUES(DEFAULT,:nazwa)';
            $this->db->query($query);
            $this->db->bind(':nazwa',$nazwa);
            $this->db->execute();
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

        public function getCategoryByName($nazwa)
        {
            $query='SELECT nazwa FROM "Kategorie" WHERE nazwa =:nazwa;';
            $this->db->query($query);
            $this->db->bind(':nazwa',$nazwa);
            $result=$this->db->single();
            return $result;
        }

        public function editCategory($nowaNazwa, $staraNazwa)
        {
            $query='UPDATE "Kategorie" SET nazwa=:nowaNazwa WHERE nazwa =:staraNazwa';
            $this->db->query($query);
            $this->db->bind(':staraNazwa',$staraNazwa);
            $this->db->bind(':nowaNazwa',$nowaNazwa);
            $this->db->execute();
        }

        public function getBookByCategoryId($id_kategorii)
        {
            $query='SELECT * FROM "Ksiazki" WHERE id_kategorii =:id_kategorii;';
            $this->db->query($query);
            $this->db->bind(':id_kategorii',$id_kategorii);
            $result=$this->db->single();
            return $result;
        }

        public function deleteCategory($id_kategorii)
        {
            $query='DELETE FROM "Kategorie" WHERE id_kategorii =:id_kategorii;';
            $this->db->query($query);
            $this->db->bind(':id_kategorii',$id_kategorii);
            $this->db->execute();
        }

    }
?>