CREATE DATABASE IF NOT EXISTS not_takas;
USE not_takas;

CREATE TABLE kullanici (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ad VARCHAR(100),
    eposta VARCHAR(100) UNIQUE,
    sifre VARCHAR(255)
);

CREATE TABLE notlar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kullanici_id INT,
    ders_adi VARCHAR(100),
    baslik VARCHAR(255),
    aciklama TEXT,
    dosya_adi VARCHAR(255),
    tarih TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (kullanici_id) REFERENCES kullanici(id) ON DELETE CASCADE
);
