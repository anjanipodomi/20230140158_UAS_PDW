-- ========= FILE: database.sql =========
-- Users Table
CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('mahasiswa','asisten') NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Praktikum Table
CREATE TABLE `praktikum` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(100) NOT NULL,
  `deskripsi` TEXT,
  `created_by` INT,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Pendaftaran Praktikum Table
CREATE TABLE `pendaftaran_praktikum` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `praktikum_id` INT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`praktikum_id`) REFERENCES `praktikum`(`id`) ON DELETE CASCADE,
  UNIQUE KEY (`user_id`, `praktikum_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Modul Table
CREATE TABLE `modul` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `praktikum_id` INT NOT NULL,
  `judul` VARCHAR(100) NOT NULL,
  `deskripsi` TEXT,
  `file_materi` VARCHAR(255),
  `tanggal_upload` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`praktikum_id`) REFERENCES `praktikum`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Laporan Table
CREATE TABLE `laporan` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `modul_id` INT NOT NULL,
  `file_laporan` VARCHAR(255) NOT NULL,
  `tanggal_upload` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `nilai` INT DEFAULT NULL,
  `feedback` TEXT,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`modul_id`) REFERENCES `modul`(`id`) ON DELETE CASCADE,
  UNIQUE KEY (`user_id`, `modul_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
