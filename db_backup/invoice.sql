PGDMP     5    /            
    y            invoice    9.4.0    12.3     ?           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            ?           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            ?           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            ?           1262    1170510    invoice    DATABASE     ?   CREATE DATABASE invoice WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'English_India.1252' LC_CTYPE = 'English_India.1252';
    DROP DATABASE invoice;
                postgres    false                        2615    1170511    product    SCHEMA        CREATE SCHEMA product;
    DROP SCHEMA product;
                postgres    false            ?           0    0    SCHEMA public    ACL     ?   REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;
                   postgres    false    6            ?            1259    1170538    item    TABLE     ?   CREATE TABLE product.item (
    id integer NOT NULL,
    name character varying(50),
    quantity numeric,
    unit_price numeric,
    tax integer,
    discount_price numeric
);
    DROP TABLE product.item;
       product            postgres    false    8            ?            1259    1170536    item_id_seq    SEQUENCE     u   CREATE SEQUENCE product.item_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE product.item_id_seq;
       product          postgres    false    8    177            ?           0    0    item_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE product.item_id_seq OWNED BY product.item.id;
          product          postgres    false    176            ?            1259    1170525    tax    TABLE     I   CREATE TABLE product.tax (
    id integer NOT NULL,
    value integer
);
    DROP TABLE product.tax;
       product            postgres    false    8            ?            1259    1170523 
   tax_id_seq    SEQUENCE     t   CREATE SEQUENCE product.tax_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE product.tax_id_seq;
       product          postgres    false    175    8            ?           0    0 
   tax_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE product.tax_id_seq OWNED BY product.tax.id;
          product          postgres    false    174            b           2604    1170541    item id    DEFAULT     d   ALTER TABLE ONLY product.item ALTER COLUMN id SET DEFAULT nextval('product.item_id_seq'::regclass);
 7   ALTER TABLE product.item ALTER COLUMN id DROP DEFAULT;
       product          postgres    false    176    177    177            a           2604    1170528    tax id    DEFAULT     b   ALTER TABLE ONLY product.tax ALTER COLUMN id SET DEFAULT nextval('product.tax_id_seq'::regclass);
 6   ALTER TABLE product.tax ALTER COLUMN id DROP DEFAULT;
       product          postgres    false    175    174    175            ?          0    1170538    item 
   TABLE DATA           T   COPY product.item (id, name, quantity, unit_price, tax, discount_price) FROM stdin;
    product          postgres    false    177   _       ?          0    1170525    tax 
   TABLE DATA           )   COPY product.tax (id, value) FROM stdin;
    product          postgres    false    175   |       ?           0    0    item_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('product.item_id_seq', 23, true);
          product          postgres    false    176            ?           0    0 
   tax_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('product.tax_id_seq', 1, false);
          product          postgres    false    174            f           2606    1170546    item item_pkey 
   CONSTRAINT     M   ALTER TABLE ONLY product.item
    ADD CONSTRAINT item_pkey PRIMARY KEY (id);
 9   ALTER TABLE ONLY product.item DROP CONSTRAINT item_pkey;
       product            postgres    false    177            d           2606    1170530    tax tax_pkey 
   CONSTRAINT     K   ALTER TABLE ONLY product.tax
    ADD CONSTRAINT tax_pkey PRIMARY KEY (id);
 7   ALTER TABLE ONLY product.tax DROP CONSTRAINT tax_pkey;
       product            postgres    false    175            g           2606    1170547    item tax_id    FK CONSTRAINT     p   ALTER TABLE ONLY product.item
    ADD CONSTRAINT tax_id FOREIGN KEY (tax) REFERENCES product.tax(id) NOT VALID;
 6   ALTER TABLE ONLY product.item DROP CONSTRAINT tax_id;
       product          postgres    false    1892    175    177            ?      x?????? ? ?      ?      x?3?4?2?4?2?4?2?44?????? ??     