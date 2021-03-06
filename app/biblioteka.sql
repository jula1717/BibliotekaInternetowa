PGDMP     %                     z         
   biblioteka    14.1    14.1 -    3           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            4           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            5           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            6           1262    16394 
   biblioteka    DATABASE     f   CREATE DATABASE biblioteka WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Polish_Poland.1250';
    DROP DATABASE biblioteka;
                postgres    false            E           1247    16431 	   typ_konta    TYPE     `   CREATE TYPE public.typ_konta AS ENUM (
    'administrator',
    'pracownik',
    'czytelnik'
);
    DROP TYPE public.typ_konta;
       public          postgres    false            ?            1259    16465    Autorzy    TABLE     ?   CREATE TABLE public."Autorzy" (
    id_autora integer NOT NULL,
    imie character varying(255) NOT NULL,
    nazwisko character varying(255) NOT NULL
);
    DROP TABLE public."Autorzy";
       public         heap    postgres    false            ?            1259    16499    Autorzy_id_autora_seq    SEQUENCE     ?   ALTER TABLE public."Autorzy" ALTER COLUMN id_autora ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Autorzy_id_autora_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    212            ?            1259    16479    Autorzy_ksiazek    TABLE     ?   CREATE TABLE public."Autorzy_ksiazek" (
    id_powiazania integer NOT NULL,
    id_ksiazki integer NOT NULL,
    id_autora integer NOT NULL
);
 %   DROP TABLE public."Autorzy_ksiazek";
       public         heap    postgres    false            ?            1259    16498 !   Autorzy_ksiazek_id_powiazania_seq    SEQUENCE     ?   ALTER TABLE public."Autorzy_ksiazek" ALTER COLUMN id_powiazania ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Autorzy_ksiazek_id_powiazania_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    214            ?            1259    16491    Egzemplarze    TABLE     ?   CREATE TABLE public."Egzemplarze" (
    id_egzemplarza integer NOT NULL,
    id_ksiazki integer NOT NULL,
    dostepny boolean DEFAULT true NOT NULL,
    rok_wydania integer
);
 !   DROP TABLE public."Egzemplarze";
       public         heap    postgres    false            ?            1259    16501    Egzemplarze_id_egzemplarza_seq    SEQUENCE     ?   ALTER TABLE public."Egzemplarze" ALTER COLUMN id_egzemplarza ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Egzemplarze_id_egzemplarza_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    216            ?            1259    16460 	   Kategorie    TABLE     r   CREATE TABLE public."Kategorie" (
    id_kategorii integer NOT NULL,
    nazwa character varying(255) NOT NULL
);
    DROP TABLE public."Kategorie";
       public         heap    postgres    false            ?            1259    16502    Kategorie_id_kategorii_seq    SEQUENCE     ?   ALTER TABLE public."Kategorie" ALTER COLUMN id_kategorii ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Kategorie_id_kategorii_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    211            ?            1259    16484    Ksiazki    TABLE     ?   CREATE TABLE public."Ksiazki" (
    id_ksiazki integer NOT NULL,
    id_kategorii integer NOT NULL,
    tytul character varying(255) NOT NULL,
    opis text,
    id_wydawnictwa integer NOT NULL
);
    DROP TABLE public."Ksiazki";
       public         heap    postgres    false            ?            1259    16503    Ksiazki_id_ksiazki_seq    SEQUENCE     ?   ALTER TABLE public."Ksiazki" ALTER COLUMN id_ksiazki ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Ksiazki_id_ksiazki_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    215            ?            1259    16438    Uzytkownicy    TABLE     ;  CREATE TABLE public."Uzytkownicy" (
    id_uzytkownika integer NOT NULL,
    email character varying(255) NOT NULL,
    haslo character varying(255) NOT NULL,
    typ_konta public.typ_konta DEFAULT 'pracownik'::public.typ_konta NOT NULL,
    telefon character varying(9),
    "limit" smallint DEFAULT 4 NOT NULL
);
 !   DROP TABLE public."Uzytkownicy";
       public         heap    postgres    false    837    837            ?            1259    16504    Pracownicy_id_pracownika_seq    SEQUENCE     ?   ALTER TABLE public."Uzytkownicy" ALTER COLUMN id_uzytkownika ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Pracownicy_id_pracownika_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    209            ?            1259    16472    Wydawnictwa    TABLE     q   CREATE TABLE public."Wydawnictwa" (
    id_wydawnictwa integer NOT NULL,
    nazwa character varying NOT NULL
);
 !   DROP TABLE public."Wydawnictwa";
       public         heap    postgres    false            ?            1259    16505    Wydawnictwa_id_wydawnictwa_seq    SEQUENCE     ?   ALTER TABLE public."Wydawnictwa" ALTER COLUMN id_wydawnictwa ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Wydawnictwa_id_wydawnictwa_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    213            ?            1259    16454    Wypozyczenia    TABLE     %  CREATE TABLE public."Wypozyczenia" (
    id_wypozyczenia integer NOT NULL,
    id_czytelnika integer NOT NULL,
    id_egzemplarza integer NOT NULL,
    data_wypozyczenia date NOT NULL,
    data_oddania date,
    prolongowane boolean DEFAULT false NOT NULL,
    id_pracownika_odbior integer
);
 "   DROP TABLE public."Wypozyczenia";
       public         heap    postgres    false            ?            1259    16507     Wypozyczenia_id_wypozyczenia_seq    SEQUENCE     ?   ALTER TABLE public."Wypozyczenia" ALTER COLUMN id_wypozyczenia ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Wypozyczenia_id_wypozyczenia_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    210            $          0    16465    Autorzy 
   TABLE DATA           >   COPY public."Autorzy" (id_autora, imie, nazwisko) FROM stdin;
    public          postgres    false    212   ?4       &          0    16479    Autorzy_ksiazek 
   TABLE DATA           Q   COPY public."Autorzy_ksiazek" (id_powiazania, id_ksiazki, id_autora) FROM stdin;
    public          postgres    false    214   ?4       (          0    16491    Egzemplarze 
   TABLE DATA           Z   COPY public."Egzemplarze" (id_egzemplarza, id_ksiazki, dostepny, rok_wydania) FROM stdin;
    public          postgres    false    216   5       #          0    16460 	   Kategorie 
   TABLE DATA           :   COPY public."Kategorie" (id_kategorii, nazwa) FROM stdin;
    public          postgres    false    211   <5       '          0    16484    Ksiazki 
   TABLE DATA           Z   COPY public."Ksiazki" (id_ksiazki, id_kategorii, tytul, opis, id_wydawnictwa) FROM stdin;
    public          postgres    false    215   v5       !          0    16438    Uzytkownicy 
   TABLE DATA           b   COPY public."Uzytkownicy" (id_uzytkownika, email, haslo, typ_konta, telefon, "limit") FROM stdin;
    public          postgres    false    209   ?5       %          0    16472    Wydawnictwa 
   TABLE DATA           >   COPY public."Wydawnictwa" (id_wydawnictwa, nazwa) FROM stdin;
    public          postgres    false    213   ?6       "          0    16454    Wypozyczenia 
   TABLE DATA           ?   COPY public."Wypozyczenia" (id_wypozyczenia, id_czytelnika, id_egzemplarza, data_wypozyczenia, data_oddania, prolongowane, id_pracownika_odbior) FROM stdin;
    public          postgres    false    210   ?6       7           0    0    Autorzy_id_autora_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public."Autorzy_id_autora_seq"', 2, true);
          public          postgres    false    218            8           0    0 !   Autorzy_ksiazek_id_powiazania_seq    SEQUENCE SET     Q   SELECT pg_catalog.setval('public."Autorzy_ksiazek_id_powiazania_seq"', 4, true);
          public          postgres    false    217            9           0    0    Egzemplarze_id_egzemplarza_seq    SEQUENCE SET     N   SELECT pg_catalog.setval('public."Egzemplarze_id_egzemplarza_seq"', 2, true);
          public          postgres    false    219            :           0    0    Kategorie_id_kategorii_seq    SEQUENCE SET     J   SELECT pg_catalog.setval('public."Kategorie_id_kategorii_seq"', 3, true);
          public          postgres    false    220            ;           0    0    Ksiazki_id_ksiazki_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public."Ksiazki_id_ksiazki_seq"', 1, false);
          public          postgres    false    221            <           0    0    Pracownicy_id_pracownika_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public."Pracownicy_id_pracownika_seq"', 5, true);
          public          postgres    false    222            =           0    0    Wydawnictwa_id_wydawnictwa_seq    SEQUENCE SET     N   SELECT pg_catalog.setval('public."Wydawnictwa_id_wydawnictwa_seq"', 1, true);
          public          postgres    false    223            >           0    0     Wypozyczenia_id_wypozyczenia_seq    SEQUENCE SET     P   SELECT pg_catalog.setval('public."Wypozyczenia_id_wypozyczenia_seq"', 2, true);
          public          postgres    false    224            ?           2606    16483 $   Autorzy_ksiazek Autorzy_ksiazek_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public."Autorzy_ksiazek"
    ADD CONSTRAINT "Autorzy_ksiazek_pkey" PRIMARY KEY (id_powiazania);
 R   ALTER TABLE ONLY public."Autorzy_ksiazek" DROP CONSTRAINT "Autorzy_ksiazek_pkey";
       public            postgres    false    214            ?           2606    16471    Autorzy Autorzy_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public."Autorzy"
    ADD CONSTRAINT "Autorzy_pkey" PRIMARY KEY (id_autora);
 B   ALTER TABLE ONLY public."Autorzy" DROP CONSTRAINT "Autorzy_pkey";
       public            postgres    false    212            ?           2606    16496    Egzemplarze Egzemplarze_pkey 
   CONSTRAINT     j   ALTER TABLE ONLY public."Egzemplarze"
    ADD CONSTRAINT "Egzemplarze_pkey" PRIMARY KEY (id_egzemplarza);
 J   ALTER TABLE ONLY public."Egzemplarze" DROP CONSTRAINT "Egzemplarze_pkey";
       public            postgres    false    216            ?           2606    16464    Kategorie Kategorie_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public."Kategorie"
    ADD CONSTRAINT "Kategorie_pkey" PRIMARY KEY (id_kategorii);
 F   ALTER TABLE ONLY public."Kategorie" DROP CONSTRAINT "Kategorie_pkey";
       public            postgres    false    211            ?           2606    16490    Ksiazki Ksiazki_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public."Ksiazki"
    ADD CONSTRAINT "Ksiazki_pkey" PRIMARY KEY (id_ksiazki);
 B   ALTER TABLE ONLY public."Ksiazki" DROP CONSTRAINT "Ksiazki_pkey";
       public            postgres    false    215            ?           2606    16445    Uzytkownicy Pracownicy_pkey 
   CONSTRAINT     i   ALTER TABLE ONLY public."Uzytkownicy"
    ADD CONSTRAINT "Pracownicy_pkey" PRIMARY KEY (id_uzytkownika);
 I   ALTER TABLE ONLY public."Uzytkownicy" DROP CONSTRAINT "Pracownicy_pkey";
       public            postgres    false    209            ?           2606    16478    Wydawnictwa Wydawnictwa_pkey 
   CONSTRAINT     j   ALTER TABLE ONLY public."Wydawnictwa"
    ADD CONSTRAINT "Wydawnictwa_pkey" PRIMARY KEY (id_wydawnictwa);
 J   ALTER TABLE ONLY public."Wydawnictwa" DROP CONSTRAINT "Wydawnictwa_pkey";
       public            postgres    false    213            ?           2606    16459    Wypozyczenia Wypozyczenia_pkey 
   CONSTRAINT     m   ALTER TABLE ONLY public."Wypozyczenia"
    ADD CONSTRAINT "Wypozyczenia_pkey" PRIMARY KEY (id_wypozyczenia);
 L   ALTER TABLE ONLY public."Wypozyczenia" DROP CONSTRAINT "Wypozyczenia_pkey";
       public            postgres    false    210            $      x?3?tLI????L??L-?L??????? R?x      &      x?3?4?4?2?4?1z\\\ 	      (      x?3?4?,?4????2?4?0M?b???? ?T      #   *   x?3?L)J?M,?2?L-?/H?J?2????MM?L?????? ?(	?      '   .   x?3?4?t??LL?????4?2?4?H?SILI--????qqq ?3
      !   ?   x?]?Mo?0 ??s???(?6E???0??.????PXW~?4???=??????IufW??3h?H?yL??9?9i??b{?/k_ZY6G?>?h?#?Ǿr?
6?(?ǈˡ?C??l?ŞO?c??P?/??2?<??GQ@??7^?0???O??sW6?z񆰏\&=???}???w??N????c???Z"I͚?W????????_?*$?,?????<??} ??^Zu??aױ?	??a?edY?      %      x?3?t/JM?????? xr      "   2   x?3?4B##C]C#]#s?H???8K8??@???1~?i@?=... 3?	?     