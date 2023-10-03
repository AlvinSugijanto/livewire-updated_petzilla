-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2023-10-02 20:16:51.426

-- tables
-- Table: admin
CREATE TABLE admin (
    id varchar(255)  NOT NULL,
    email varchar(255)  NOT NULL,
    password int  NOT NULL,
    CONSTRAINT admin_pk PRIMARY KEY (id)
);

-- Table: animal_photo
CREATE TABLE animal_photo (
    id_animal_photo int  NOT NULL AUTO_INCREMENT,
    photo varchar(255)  NOT NULL,
    list_animal_id_animal varchar(255)  NOT NULL,
    CONSTRAINT animal_photo_pk PRIMARY KEY (id_animal_photo)
);

-- Table: bukti_pembayaran
CREATE TABLE bukti_pembayaran (
    id int  NOT NULL AUTO_INCREMENT,
    tipe_rekening varchar(255)  NOT NULL,
    jenis_rekening varchar(255)  NOT NULL,
    nama_rekening varchar(255)  NOT NULL,
    nomor_rekening varchar(255)  NOT NULL,
    bukti_pembayaran varchar(255)  NOT NULL,
    transaction_id_transaction varchar(255)  NOT NULL,
    created_at timestamp  NULL,
    updated_at timestamp  NULL,
    CONSTRAINT bukti_pembayaran_pk PRIMARY KEY (id)
);

-- Table: cart
CREATE TABLE cart (
    id_cart int  NOT NULL AUTO_INCREMENT,
    total int  NOT NULL DEFAULT 0,
    users_id_user varchar(255)  NOT NULL,
    store_id_store varchar(255)  NOT NULL,
    CONSTRAINT cart_pk PRIMARY KEY (id_cart)
);

-- Table: cart_detail
CREATE TABLE cart_detail (
    id_cart_detail int  NOT NULL AUTO_INCREMENT,
    cart_id int  NOT NULL,
    qty int  NOT NULL,
    list_animal_id_animal varchar(255)  NOT NULL,
    CONSTRAINT cart_detail_pk PRIMARY KEY (id_cart_detail)
);

-- Table: chat
CREATE TABLE chat (
    id int  NOT NULL AUTO_INCREMENT,
    message varchar(255)  NOT NULL,
    created_at timestamp  NOT NULL,
    updated_at timestamp  NOT NULL,
    users_id_user varchar(255)  NOT NULL,
    store_id_store varchar(255)  NOT NULL,
    sender_type varchar(255)  NOT NULL,
    CONSTRAINT chat_pk PRIMARY KEY (id)
);

-- Table: complain
CREATE TABLE complain (
    id int  NOT NULL AUTO_INCREMENT,
    komentar varchar(255)  NOT NULL,
    status varchar(255)  NOT NULL,
    created_at timestamp  NULL,
    updated_at timestamp  NULL,
    transaction_id_transaction varchar(255)  NOT NULL,
    CONSTRAINT complain_pk PRIMARY KEY (id)
);

-- Table: complain_photo
CREATE TABLE complain_photo (
    id int  NOT NULL AUTO_INCREMENT,
    photo varchar(255)  NOT NULL,
    complain_id int  NOT NULL,
    CONSTRAINT complain_photo_pk PRIMARY KEY (id)
);

-- Table: informasi_pengiriman
CREATE TABLE informasi_pengiriman (
    id int  NOT NULL AUTO_INCREMENT,
    jasa_pengiriman varchar(255)  NOT NULL,
    biaya_pengiriman varchar(255)  NOT NULL,
    bukti_pengiriman varchar(255)  NULL,
    transaction_id_transaction varchar(255)  NOT NULL,
    CONSTRAINT informasi_pengiriman_pk PRIMARY KEY (id)
);

-- Table: list_animal
CREATE TABLE list_animal (
    id_animal varchar(255)  NOT NULL,
    jenis_hewan varchar(255)  NOT NULL,
    judul_post varchar(255)  NOT NULL,
    deskripsi varchar(255)  NOT NULL,
    harga int  NOT NULL,
    stok int  NOT NULL,
    surat_keterangan_sehat varchar(255)  NULL,
    sertifikat_pedigree varchar(255)  NULL,
    thumbnail varchar(255)  NULL,
    warna varchar(255)  NULL,
    umur varchar(255)  NULL,
    satuan_umur varchar(255)  NULL,
    status varchar(255)  NOT NULL,
    store_id_store varchar(255)  NOT NULL,
    created_at timestamp  NULL,
    updated_at timestamp  NULL,
    CONSTRAINT list_animal_pk PRIMARY KEY (id_animal)
);

-- Table: rating_and_review
CREATE TABLE rating_and_review (
    id int  NOT NULL AUTO_INCREMENT,
    rating int  NOT NULL,
    review varchar(255)  NULL,
    created_at timestamp  NULL,
    updated_at timestamp  NULL,
    transaction_id_transaction varchar(255)  NOT NULL,
    CONSTRAINT rating_and_review_pk PRIMARY KEY (id)
);

-- Table: store
CREATE TABLE store (
    id_store varchar(255)  NOT NULL,
    nama_toko varchar(255)  NOT NULL,
    description varchar(255)  NOT NULL,
    alamat_lengkap varchar(255)  NOT NULL,
    no_hp varchar(255)  NOT NULL,
    provinsi varchar(255)  NOT NULL,
    kabupaten varchar(255)  NOT NULL,
    kecamatan varchar(255)  NOT NULL,
    latitude decimal(11,7)  NOT NULL,
    saldo int  NOT NULL DEFAULT 0,
    longitude decimal(11,7)  NOT NULL,
    user_id_user varchar(255)  NOT NULL,
    CONSTRAINT store_pk PRIMARY KEY (id_store)
);

-- Table: store_bank_information
CREATE TABLE store_bank_information (
    id int  NOT NULL AUTO_INCREMENT,
    tipe_rekening varchar(255)  NOT NULL,
    jenis_rekening varchar(255)  NOT NULL,
    nama_rekening varchar(255)  NOT NULL,
    nomor_rekening varchar(255)  NOT NULL,
    store_id_store varchar(255)  NOT NULL,
    CONSTRAINT store_bank_information_pk PRIMARY KEY (id)
);

-- Table: transaction
CREATE TABLE transaction (
    id_transaction varchar(255)  NOT NULL,
    fee int  NULL,
    grand_total int  NULL,
    status varchar(255)  NOT NULL,
    created_at timestamp  NULL,
    updated_at timestamp  NULL,
    completed_at timestamp  NULL,
    users_id_user varchar(255)  NOT NULL,
    store_id_store varchar(255)  NOT NULL,
    CONSTRAINT transaction_pk PRIMARY KEY (id_transaction)
);

-- Table: transaction_detail
CREATE TABLE transaction_detail (
    id_transaction_detail int  NOT NULL AUTO_INCREMENT,
    subtotal int  NOT NULL,
    qty int  NOT NULL,
    transaction_id_transaction varchar(255)  NOT NULL,
    list_animal_id_animal varchar(255)  NOT NULL,
    CONSTRAINT transaction_detail_pk PRIMARY KEY (id_transaction_detail)
);

-- Table: users
CREATE TABLE users (
    id_user varchar(255)  NOT NULL,
    email varchar(255)  NOT NULL,
    password varchar(255)  NOT NULL,
    name varchar(255)  NOT NULL,
    alamat_lengkap varchar(255)  NOT NULL,
    phone_number varchar(255)  NOT NULL,
    email_verified_at datetime  NULL,
    provinsi varchar(255)  NOT NULL,
    kabupaten varchar(255)  NOT NULL,
    kecamatan varchar(255)  NOT NULL,
    latitude decimal(11,7)  NOT NULL,
    longitude decimal(11,7)  NOT NULL,
    created_at timestamp  NULL,
    updated_at timestamp  NULL,
    CONSTRAINT user_pk PRIMARY KEY (id_user)
);

-- Table: verify_user
CREATE TABLE verify_user (
    id int  NOT NULL AUTO_INCREMENT,
    token varchar(255)  NOT NULL,
    created_at timestamp  NULL,
    updated_at timestamp  NULL,
    user_id_user varchar(255)  NOT NULL,
    CONSTRAINT verify_user_pk PRIMARY KEY (id)
);

-- Table: wishlist
CREATE TABLE wishlist (
    id int  NOT NULL AUTO_INCREMENT,
    users_id_user varchar(255)  NOT NULL,
    list_animal_id_animal varchar(255)  NOT NULL,
    created_at timestamp  NULL,
    updated_at timestamp  NULL,
    CONSTRAINT wishlist_pk PRIMARY KEY (id)
);

-- foreign keys
-- Reference: animal_photo_list_animal (table: animal_photo)
ALTER TABLE animal_photo ADD CONSTRAINT animal_photo_list_animal FOREIGN KEY animal_photo_list_animal (list_animal_id_animal)
    REFERENCES list_animal (id_animal);

-- Reference: bukti_pembayaran_transaction (table: bukti_pembayaran)
ALTER TABLE bukti_pembayaran ADD CONSTRAINT bukti_pembayaran_transaction FOREIGN KEY bukti_pembayaran_transaction (transaction_id_transaction)
    REFERENCES transaction (id_transaction);

-- Reference: cart_detail_cart (table: cart_detail)
ALTER TABLE cart_detail ADD CONSTRAINT cart_detail_cart FOREIGN KEY cart_detail_cart (cart_id)
    REFERENCES cart (id_cart);

-- Reference: cart_detail_list_animal (table: cart_detail)
ALTER TABLE cart_detail ADD CONSTRAINT cart_detail_list_animal FOREIGN KEY cart_detail_list_animal (list_animal_id_animal)
    REFERENCES list_animal (id_animal);

-- Reference: cart_store (table: cart)
ALTER TABLE cart ADD CONSTRAINT cart_store FOREIGN KEY cart_store (store_id_store)
    REFERENCES store (id_store);

-- Reference: cart_users (table: cart)
ALTER TABLE cart ADD CONSTRAINT cart_users FOREIGN KEY cart_users (users_id_user)
    REFERENCES users (id_user);

-- Reference: chat_store (table: chat)
ALTER TABLE chat ADD CONSTRAINT chat_store FOREIGN KEY chat_store (store_id_store)
    REFERENCES store (id_store);

-- Reference: complain_photo_complain (table: complain_photo)
ALTER TABLE complain_photo ADD CONSTRAINT complain_photo_complain FOREIGN KEY complain_photo_complain (complain_id)
    REFERENCES complain (id);

-- Reference: complain_transaction (table: complain)
ALTER TABLE complain ADD CONSTRAINT complain_transaction FOREIGN KEY complain_transaction (transaction_id_transaction)
    REFERENCES transaction (id_transaction);

-- Reference: informasi_pengiriman_transaction (table: informasi_pengiriman)
ALTER TABLE informasi_pengiriman ADD CONSTRAINT informasi_pengiriman_transaction FOREIGN KEY informasi_pengiriman_transaction (transaction_id_transaction)
    REFERENCES transaction (id_transaction);

-- Reference: list_animal_store (table: list_animal)
ALTER TABLE list_animal ADD CONSTRAINT list_animal_store FOREIGN KEY list_animal_store (store_id_store)
    REFERENCES store (id_store);

-- Reference: rating_and_review_transaction (table: rating_and_review)
ALTER TABLE rating_and_review ADD CONSTRAINT rating_and_review_transaction FOREIGN KEY rating_and_review_transaction (transaction_id_transaction)
    REFERENCES transaction (id_transaction);

-- Reference: shop_user (table: store)
ALTER TABLE store ADD CONSTRAINT shop_user FOREIGN KEY shop_user (user_id_user)
    REFERENCES users (id_user);

-- Reference: store_bank_information_store (table: store_bank_information)
ALTER TABLE store_bank_information ADD CONSTRAINT store_bank_information_store FOREIGN KEY store_bank_information_store (store_id_store)
    REFERENCES store (id_store);

-- Reference: to_id_user (table: chat)
ALTER TABLE chat ADD CONSTRAINT to_id_user FOREIGN KEY to_id_user (users_id_user)
    REFERENCES users (id_user);

-- Reference: transaction_detail_list_animal (table: transaction_detail)
ALTER TABLE transaction_detail ADD CONSTRAINT transaction_detail_list_animal FOREIGN KEY transaction_detail_list_animal (list_animal_id_animal)
    REFERENCES list_animal (id_animal);

-- Reference: transaction_detail_transaction (table: transaction_detail)
ALTER TABLE transaction_detail ADD CONSTRAINT transaction_detail_transaction FOREIGN KEY transaction_detail_transaction (transaction_id_transaction)
    REFERENCES transaction (id_transaction);

-- Reference: transaction_store (table: transaction)
ALTER TABLE transaction ADD CONSTRAINT transaction_store FOREIGN KEY transaction_store (store_id_store)
    REFERENCES store (id_store);

-- Reference: transaction_users (table: transaction)
ALTER TABLE transaction ADD CONSTRAINT transaction_users FOREIGN KEY transaction_users (users_id_user)
    REFERENCES users (id_user);

-- Reference: verify_user_user (table: verify_user)
ALTER TABLE verify_user ADD CONSTRAINT verify_user_user FOREIGN KEY verify_user_user (user_id_user)
    REFERENCES users (id_user);

-- Reference: wishlist_list_animal (table: wishlist)
ALTER TABLE wishlist ADD CONSTRAINT wishlist_list_animal FOREIGN KEY wishlist_list_animal (list_animal_id_animal)
    REFERENCES list_animal (id_animal);

-- Reference: wishlist_users (table: wishlist)
ALTER TABLE wishlist ADD CONSTRAINT wishlist_users FOREIGN KEY wishlist_users (users_id_user)
    REFERENCES users (id_user);

-- End of file.

