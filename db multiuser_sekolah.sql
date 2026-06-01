-- Membuat Database
CREATE DATABASE multiuser_sekolah;
USE multiuser_sekolah;

-- =========================
-- TABEL USER
-- =========================
CREATE TABLE user (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    level ENUM('admin','guru','siswa') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- TABEL GURU
-- =========================
CREATE TABLE guru (
    id_guru INT AUTO_INCREMENT PRIMARY KEY,
    nip VARCHAR(30) NOT NULL UNIQUE,
    nama_guru VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('L','P'),
    alamat TEXT,
    no_hp VARCHAR(20),
    email VARCHAR(100)
);

-- =========================
-- TABEL SISWA
-- =========================
CREATE TABLE siswa (
    id_siswa INT AUTO_INCREMENT PRIMARY KEY,
    nis VARCHAR(30) NOT NULL UNIQUE,
    nama_siswa VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('L','P'),
    tempat_lahir VARCHAR(100),
    tanggal_lahir DATE,
    alamat TEXT,
    no_hp VARCHAR(20),
    kelas VARCHAR(20)
);

-- =========================
-- TABEL PELAJARAN
-- =========================
CREATE TABLE pelajaran (
    id_pelajaran INT AUTO_INCREMENT PRIMARY KEY,
    nama_pelajaran VARCHAR(100) NOT NULL,
    id_guru INT,
    FOREIGN KEY (id_guru)
    REFERENCES guru(id_guru)
    ON DELETE SET NULL
);

-- =========================
-- TABEL NILAI
-- =========================
CREATE TABLE nilai (
    id_nilai INT AUTO_INCREMENT PRIMARY KEY,
    id_siswa INT,
    id_pelajaran INT,
    nilai_tugas INT,
    nilai_uts INT,
    nilai_uas INT,
    rata_rata DECIMAL(5,2),
    FOREIGN KEY (id_siswa)
    REFERENCES siswa(id_siswa)
    ON DELETE CASCADE,
    FOREIGN KEY (id_pelajaran)
    REFERENCES pelajaran(id_pelajaran)
    ON DELETE CASCADE
);

-- =========================
-- TABEL ABSENSI
-- =========================
CREATE TABLE absensi (
    id_absensi INT AUTO_INCREMENT PRIMARY KEY,
    id_siswa INT,
    tanggal DATE,
    status ENUM('Hadir','Izin','Sakit','Alpa') NOT NULL,
    keterangan TEXT,
    FOREIGN KEY (id_siswa)
    REFERENCES siswa(id_siswa)
    ON DELETE CASCADE
);

-- =========================
-- TABEL TUGAS
-- =========================
CREATE TABLE tugas (
    id_tugas INT AUTO_INCREMENT PRIMARY KEY,
    id_pelajaran INT,
    judul_tugas VARCHAR(200) NOT NULL,
    deskripsi TEXT,
    tanggal_buat DATE,
    deadline DATE,
    FOREIGN KEY (id_pelajaran)
    REFERENCES pelajaran(id_pelajaran)
    ON DELETE CASCADE
);

-- =========================
-- DATA ADMIN DEFAULT
-- =========================
INSERT INTO user (
    username,
    password,
    level
) VALUES (
    'admin',
    MD5('admin123'),
    'admin'
);

-- =========================
-- DATA CONTOH GURU
-- =========================
INSERT INTO guru (
    nip,
    nama_guru,
    jenis_kelamin,
    alamat,
    no_hp,
    email
) VALUES (
    '1987654321',
    'Budi Santoso',
    'L',
    'Padang',
    '081234567890',
    'budi@gmail.com'
);

-- =========================
-- DATA CONTOH SISWA
-- =========================
INSERT INTO siswa (
    nis,
    nama_siswa,
    jenis_kelamin,
    tempat_lahir,
    tanggal_lahir,
    alamat,
    no_hp,
    kelas
) VALUES (
    '2026001',
    'Ahmad Fauzan',
    'L',
    'Padang',
    '2010-05-15',
    'Padang Barat',
    '081298765432',
    'X IPA 1'
);

-- =========================
-- DATA CONTOH PELAJARAN
-- =========================
INSERT INTO pelajaran (
    nama_pelajaran,
    id_guru
) VALUES (
    'Matematika',
    1
);

-- =========================
-- DATA CONTOH NILAI
-- =========================
INSERT INTO nilai (
    id_siswa,
    id_pelajaran,
    nilai_tugas,
    nilai_uts,
    nilai_uas,
    rata_rata
) VALUES (
    1,
    1,
    85,
    80,
    90,
    85.00
);

-- =========================
-- DATA CONTOH ABSENSI
-- =========================
INSERT INTO absensi (
    id_siswa,
    tanggal,
    status,
    keterangan
) VALUES (
    1,
    CURDATE(),
    'Hadir',
    '-'
);

-- =========================
-- DATA CONTOH TUGAS
-- =========================
INSERT INTO tugas (
    id_pelajaran,
    judul_tugas,
    deskripsi,
    tanggal_buat,
    deadline
) VALUES (
    1,
    'Latihan Aljabar',
    'Kerjakan soal halaman 25',
    CURDATE(),
    DATE_ADD(CURDATE(), INTERVAL 7 DAY)
);