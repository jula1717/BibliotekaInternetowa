<?php
    class BookModel{
        private $db;
        public function __construct()
        {
            $this->db = new Database;
        }

        public function addBook($tytul,$id_kategorii,$id_wydawnictwa,$opis)
        {
            $query='INSERT INTO "Ksiazki" (tytul, id_kategorii,id_wydawnictwa,opis)
            VALUES (:tytul, :id_kategorii,:id_wydawnictwa,:opis);';
            $this->db->query($query);
            $this->db->bind(':tytul',$tytul);
            $this->db->bind(':id_kategorii',$id_kategorii);
            $this->db->bind(':id_wydawnictwa',$id_wydawnictwa);
            $this->db->bind(':opis',$opis);
            $this->db->execute();
        }

        public function editBook($id_ksiazki,$tytul,$id_kategorii,$id_wydawnictwa,$opis)
        {
            $query='UPDATE "Ksiazki" SET tytul=:tytul, id_kategorii=:id_kategorii,id_wydawnictwa=:id_wydawnictwa,opis=:opis
            WHERE id_ksiazki =:id_ksiazki ;';
            $this->db->query($query);
            $this->db->bind(':tytul',$tytul);
            $this->db->bind(':id_kategorii',$id_kategorii);
            $this->db->bind(':id_wydawnictwa',$id_wydawnictwa);
            $this->db->bind(':opis',$opis);
            $this->db->bind(':id_ksiazki',$id_ksiazki);
            $this->db->execute();
        }

        public function deleteAuthorBookRelation($id_ksiazki)
        {
            $query='DELETE FROM "Autorzy_ksiazek" WHERE id_ksiazki =:id_ksiazki;';
            $this->db->query($query);
            $this->db->bind(':id_ksiazki',$id_ksiazki);
            $this->db->execute();
        }

        public function createAuthorBookRelation($id_ksiazki,$id_autora)
        {
            {
                $query='INSERT INTO "Autorzy_ksiazek" (id_ksiazki, id_autora)
                VALUES (:id_ksiazki,:id_autora);';
                $this->db->query($query);
                $this->db->bind(':id_ksiazki',$id_ksiazki);
                $this->db->bind(':id_autora',$id_autora);
                $this->db->execute();
            }
        }

        public function getLastAddedBookId()
        {
            $query='SELECT id_ksiazki FROM public."Ksiazki"
            ORDER BY id_ksiazki DESC LIMIT 1;';
            $this->db->query($query);
            $result=$this->db->single();
            return $result->id_ksiazki;
        }

        public function borrowCreate($id_uzytkownika,$id_egzemplarza)
        {
            $query='INSERT INTO "Wypozyczenia" (id_czytelnika, id_egzemplarza,data_wypozyczenia)
            VALUES (:id_uzytkownika, :id_egzemplarza,NOW());';
            $this->db->query($query);
            $this->db->bind(':id_uzytkownika',$id_uzytkownika);
            $this->db->bind(':id_egzemplarza',$id_egzemplarza);
            $this->db->execute();
        }

        public function addCopy($id_ksiazki,$rok_wydania)
        {
            $query='INSERT INTO "Egzemplarze" (id_ksiazki, rok_wydania)
            VALUES (:id_ksiazki, :rok_wydania);';
            $this->db->query($query);
            $this->db->bind(':id_ksiazki',$id_ksiazki);
            $this->db->bind(':rok_wydania',$rok_wydania);
            $this->db->execute();
        }

        public function deleteBook($id_ksiazki)
        {
            $query='DELETE FROM "Ksiazki" WHERE id_ksiazki =:id_ksiazki;';
            $this->db->query($query);
            $this->db->bind(':id_ksiazki',$id_ksiazki);
            $this->db->execute();
        }

        public function deleteCopy($id_egzemplarza)
        {
            $query='DELETE FROM "Egzemplarze" WHERE id_egzemplarza =:id_egzemplarza;';
            $this->db->query($query);
            $this->db->bind(':id_egzemplarza',$id_egzemplarza);
            $this->db->execute();
        }

        public function borrowsOfCopy($id_egzemplarza)
        {
            $query='SELECT id_egzemplarza FROM "Wypozyczenia" WHERE id_egzemplarza=:id_egzemplarza;';
            $this->db->query($query);
            $this->db->bind(':id_egzemplarza',$id_egzemplarza);
            $result=$this->db->resultSet();
            return $result;
        }

        public function borrowsOfBook($id_ksiazki)
        {
            $query='SELECT "Ksiazki".id_ksiazki, "Ksiazki".tytul, "Egzemplarze".id_egzemplarza, "Wypozyczenia".id_wypozyczenia
            FROM "Egzemplarze" 
            INNER JOIN "Ksiazki" ON "Egzemplarze".id_ksiazki="Ksiazki".id_ksiazki
            INNER JOIN "Wypozyczenia" ON "Egzemplarze".id_egzemplarza="Wypozyczenia".id_egzemplarza
            WHERE "Ksiazki".id_ksiazki=:id_ksiazki';
            $this->db->query($query);
            $this->db->bind(':id_ksiazki',$id_ksiazki);
            $result=$this->db->resultSet();
            return $result;
        }

        public function getAllBooks()
        {
            $query='SELECT "Ksiazki".id_ksiazki, tytul, string_agg(CONCAT("Autorzy".imie,\' \',"Autorzy".nazwisko),\',</br>\') AS autor,"Kategorie".nazwa AS "kategoria", "Wydawnictwa".nazwa AS "wydawnictwo", "Ksiazki".opis AS "opis" FROM "Ksiazki"  
            INNER JOIN "Kategorie" ON "Ksiazki".id_kategorii="Kategorie".id_kategorii
            INNER JOIN "Wydawnictwa" ON "Ksiazki".id_wydawnictwa="Wydawnictwa".id_wydawnictwa
            INNER JOIN "Autorzy_ksiazek" on "Ksiazki".id_ksiazki="Autorzy_ksiazek".id_ksiazki
            INNER JOIN "Autorzy" on "Autorzy".id_autora="Autorzy_ksiazek".id_autora
            GROUP BY "Ksiazki".id_ksiazki,tytul,kategoria,wydawnictwo,opis;';
            $this->db->query($query);
            $result=$this->db->resultSet();
            return $result;
        }

        public function getBookById($id_ksiazki)
        {
            $query='SELECT "Ksiazki".id_ksiazki, tytul, string_agg(CONCAT("Autorzy".imie,\' \',"Autorzy".nazwisko),\',</br>\') AS autor,
            array_to_json(array_agg("Autorzy".id_autora)) AS autorids, "Kategorie".nazwa AS "kategoria", "Wydawnictwa".nazwa AS "wydawnictwo", "Ksiazki".opis AS "opis" FROM "Ksiazki"  
            INNER JOIN "Kategorie" ON "Ksiazki".id_kategorii="Kategorie".id_kategorii
            INNER JOIN "Wydawnictwa" ON "Ksiazki".id_wydawnictwa="Wydawnictwa".id_wydawnictwa
            INNER JOIN "Autorzy_ksiazek" on "Ksiazki".id_ksiazki="Autorzy_ksiazek".id_ksiazki
            INNER JOIN "Autorzy" on "Autorzy".id_autora="Autorzy_ksiazek".id_autora WHERE "Ksiazki".id_ksiazki=:id_ksiazki GROUP BY "Ksiazki".id_ksiazki,tytul,kategoria,wydawnictwo,opis;';
            $this->db->query($query);
            $this->db->bind(':id_ksiazki',$id_ksiazki);
            $result=$this->db->single();
            $result->autorids=json_decode($result->autorids);
            return $result;
        }

        

        public function getAllCopiesOfBook($id_ksiazki)
        {
            // $query='SELECT "Egzemplarze".id_egzemplarza,"Egzemplarze".dostepny,"Egzemplarze".rok_wydania , ("Wypozyczenia".data_wypozyczenia IS NOT NULL) AS wypozyczona
            // FROM public."Egzemplarze"
            // LEFT JOIN "Wypozyczenia" ON "Egzemplarze".id_egzemplarza="Wypozyczenia".id_egzemplarza
            // WHERE "Egzemplarze".id_ksiazki=:id_ksiazki AND "Wypozyczenia".data_oddania IS NULL;';
            $query='SELECT "Egzemplarze".id_egzemplarza,"Egzemplarze".dostepny,"Egzemplarze".rok_wydania ,
            (SELECT COUNT("Wypozyczenia".id_wypozyczenia)
            FROM "Wypozyczenia"
            WHERE "Wypozyczenia".id_egzemplarza = "Egzemplarze".id_egzemplarza AND "Wypozyczenia".data_oddania IS NULL) AS "wypozyczona"
            FROM public."Egzemplarze"
            WHERE "Egzemplarze".id_ksiazki=:id_ksiazki';
            $this->db->query($query);
            $this->db->bind(':id_ksiazki',$id_ksiazki);
            $result=$this->db->resultSet();
            return $result;
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

        public function prolongBook($borrowId)
        {
            $query='UPDATE "Wypozyczenia" SET prolongowane = :prolongowane WHERE id_wypozyczenia=:id_wypozyczenia;';
            $this->db->query($query);
            $this->db->bind(':id_wypozyczenia',$borrowId);
            $this->db->bind(':prolongowane',true);
            $this->db->execute();
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
            $query='SELECT * FROM "Kategorie" ORDER BY id_kategorii DESC;';
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