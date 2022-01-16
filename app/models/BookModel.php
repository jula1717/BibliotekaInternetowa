<?php
    class BookModel{
        private $db;
        public function __construct()
        {
            $this->db = new Database;
        }

        public function createReader()
        {
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

        /* categories */

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

        /* publishers */
        
        public function getPublishers()
        {
            $query='SELECT * FROM "Wydawnictwa";';
            $this->db->query($query);
            $result=$this->db->resultSet();
            return $result;
        }

        public function addPublisher($nazwa)
        {
            $query='INSERT INTO "Wydawnictwa" VALUES(DEFAULT,:nazwa)';
            $this->db->query($query);
            $this->db->bind(':nazwa',$nazwa);
            $this->db->execute();
        }
        
        
        public function getPublisherByName($nazwa)
        {
            $query='SELECT nazwa FROM "Wydawnictwa" WHERE nazwa =:nazwa;';
            $this->db->query($query);
            $this->db->bind(':nazwa',$nazwa);
            $result=$this->db->single();
            return $result;
        }

        public function editPublisher($nowaNazwa, $staraNazwa)
        {
            $query='UPDATE "Wydawnictwa" SET nazwa=:nowaNazwa WHERE nazwa =:staraNazwa';
            $this->db->query($query);
            $this->db->bind(':staraNazwa',$staraNazwa);
            $this->db->bind(':nowaNazwa',$nowaNazwa);
            $this->db->execute();
        }
        
        public function getBookByPublisherId($id_wydawnictwa)
        {
            $query='SELECT * FROM "Ksiazki" WHERE id_wydawnictwa =:id_wydawnictwa;';
            $this->db->query($query);
            $this->db->bind(':id_wydawnictwa',$id_wydawnictwa);
            $result=$this->db->single();
            return $result;
        }

        public function deletePublisher($id_wydawnictwa)
        {
            $query='DELETE FROM "Wydawnictwa" WHERE id_wydawnictwa =:id_wydawnictwa;';
            $this->db->query($query);
            $this->db->bind(':id_wydawnictwa',$id_wydawnictwa);
            $this->db->execute();
        }

        /* authors */
        
        public function getAuthors()
        {
            $query='SELECT * FROM "Autorzy";';
            $this->db->query($query);
            $result=$this->db->resultSet();
            return $result;
        }

        public function addAuthor($imie,$nazwisko)
        {
            $query='INSERT INTO "Autorzy" VALUES(DEFAULT,:imie,:nazwisko)';
            $this->db->query($query);
            $this->db->bind(':imie',$imie);
            $this->db->bind(':nazwisko',$nazwisko);
            $this->db->execute();
        }
        
        public function editAuthor($noweImie,$noweNazwisko,$id_autora)
        {
            $query='UPDATE "Autorzy" SET imie=:noweImie, nazwisko=:noweNazwisko WHERE id_autora=:id_autora';
            $this->db->query($query);
            $this->db->bind(':noweImie',$noweImie);
            $this->db->bind(':noweNazwisko',$noweNazwisko);
            $this->db->bind(':id_autora',$id_autora);
            $this->db->execute();
        }
        
        public function getAuthorRelationByAuthorId($id_autora)
        {
            $query='SELECT * FROM "Autorzy_ksiazek" WHERE id_autora =:id_autora;';
            $this->db->query($query);
            $this->db->bind(':id_autora',$id_autora);
            $result=$this->db->single();
            return $result;
        }

        public function deleteAuthor($id_autora)
        {
            $query='DELETE FROM "Autorzy" WHERE id_autora =:id_autora;';
            $this->db->query($query);
            $this->db->bind(':id_autora',$id_autora);
            $this->db->execute();
        }
    }
?>