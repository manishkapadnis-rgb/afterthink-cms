-- Remove CREATE DATABASE if you import into an existing Hostinger database.
USE `u663620806_afterthink`;

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(100) NOT NULL UNIQUE,
  `password_hash` VARCHAR(255) NOT NULL,
  `full_name` VARCHAR(150) DEFAULT NULL,
  `email` VARCHAR(150) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE `site_settings` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `site_name` VARCHAR(255) DEFAULT 'Afterthink Studio',
  `logo` VARCHAR(255) DEFAULT NULL,
  `favicon` VARCHAR(255) DEFAULT NULL,
  `footer_text` TEXT DEFAULT 'Luxury architecture and interior design brought to life with craftsmanship and clarity.',
  `about_title` VARCHAR(255) DEFAULT 'Our Philosophy',
  `about_text` TEXT DEFAULT 'We craft architecture and interiors inspired by light, material, and place.',
  `about_details` TEXT DEFAULT NULL,
  `about_image` VARCHAR(255) DEFAULT NULL,
  `address` VARCHAR(255) DEFAULT '123 Premium Ave, Design City',
  `phone` VARCHAR(50) DEFAULT '+1 555 854 3210',
  `contact_email` VARCHAR(150) DEFAULT 'info@afterthinkstudio.com',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `seo_settings`;
CREATE TABLE `seo_settings` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `meta_title` VARCHAR(255) DEFAULT 'Afterthink Studio | Architecture & Interior Design',
  `meta_description` TEXT DEFAULT 'Afterthink Studio delivers luxury architecture and interior design with thoughtful craft and refined detail.',
  `meta_keywords` VARCHAR(255) DEFAULT 'architecture, interior design, luxury homes, design studio, portfolio',
  `og_title` VARCHAR(255) DEFAULT 'Afterthink Studio',
  `og_description` TEXT DEFAULT 'A premium architecture and interior design firm crafting modern, timeless spaces.',
  `og_image` VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `social_links`;
CREATE TABLE `social_links` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `platform` VARCHAR(100) NOT NULL,
  `url` VARCHAR(255) NOT NULL,
  `sort_order` INT DEFAULT 0,
  `active` TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `hero_sliders`;
CREATE TABLE `hero_sliders` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `label` VARCHAR(150) DEFAULT NULL,
  `title` VARCHAR(255) DEFAULT NULL,
  `description` TEXT DEFAULT NULL,
  `button_text` VARCHAR(100) DEFAULT NULL,
  `button_url` VARCHAR(255) DEFAULT NULL,
  `image` VARCHAR(255) DEFAULT NULL,
  `sort_order` INT DEFAULT 0,
  `active` TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `image` VARCHAR(255) DEFAULT NULL,
  `sort_order` INT DEFAULT 0,
  `active` TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `portfolio_categories`;
CREATE TABLE `portfolio_categories` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `sort_order` INT DEFAULT 0,
  `active` TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `portfolios`;
CREATE TABLE `portfolios` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `category_id` INT UNSIGNED DEFAULT NULL,
  `location` VARCHAR(255) DEFAULT NULL,
  `area` VARCHAR(100) DEFAULT NULL,
  `description` TEXT DEFAULT NULL,
  `cover_image` VARCHAR(255) DEFAULT NULL,
  `project_video` VARCHAR(255) DEFAULT NULL,
  `completion_date` DATE DEFAULT NULL,
  `sort_order` INT DEFAULT 0,
  `active` TINYINT(1) DEFAULT 1,
  FOREIGN KEY (`category_id`) REFERENCES `portfolio_categories`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `portfolio_images`;
CREATE TABLE `portfolio_images` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `portfolio_id` INT UNSIGNED NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  FOREIGN KEY (`portfolio_id`) REFERENCES `portfolios`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `gallery_categories`;
CREATE TABLE `gallery_categories` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `sort_order` INT DEFAULT 0,
  `active` TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `gallery_items`;
CREATE TABLE `gallery_items` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) DEFAULT NULL,
  `category_id` INT UNSIGNED DEFAULT NULL,
  `type` ENUM('image','video') DEFAULT 'image',
  `file` VARCHAR(255) DEFAULT NULL,
  `sort_order` INT DEFAULT 0,
  `active` TINYINT(1) DEFAULT 1,
  FOREIGN KEY (`category_id`) REFERENCES `gallery_categories`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE `testimonials` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `position` VARCHAR(255) DEFAULT NULL,
  `review` TEXT NOT NULL,
  `image` VARCHAR(255) DEFAULT NULL,
  `sort_order` INT DEFAULT 0,
  `active` TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `team_members`;
CREATE TABLE `team_members` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `role` VARCHAR(255) DEFAULT NULL,
  `bio` TEXT DEFAULT NULL,
  `image` VARCHAR(255) DEFAULT NULL,
  `linkedin` VARCHAR(255) DEFAULT NULL,
  `instagram` VARCHAR(255) DEFAULT NULL,
  `facebook` VARCHAR(255) DEFAULT NULL,
  `sort_order` INT DEFAULT 0,
  `active` TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE `blogs` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `excerpt` TEXT DEFAULT NULL,
  `content` TEXT DEFAULT NULL,
  `image` VARCHAR(255) DEFAULT NULL,
  `seo_title` VARCHAR(255) DEFAULT NULL,
  `seo_description` TEXT DEFAULT NULL,
  `seo_keywords` VARCHAR(255) DEFAULT NULL,
  `published_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `active` TINYINT(1) DEFAULT 1,
  `sort_order` INT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `faqs`;
CREATE TABLE `faqs` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `question` VARCHAR(255) NOT NULL,
  `answer` TEXT NOT NULL,
  `sort_order` INT DEFAULT 0,
  `active` TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `inquiries`;
CREATE TABLE `inquiries` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(100) DEFAULT NULL,
  `subject` VARCHAR(255) DEFAULT NULL,
  `message` TEXT NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `status` VARCHAR(50) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `admin_users` (`username`, `password_hash`, `full_name`, `email`) VALUES
('admin', '$2y$12$DR5mgg6.MUxaKMyxOuKaUeiQuNRb7ynd8Z5eUb2pbLTa4TEXuV4Xm', 'Administrator', 'admin@afterthinkstudio.com');

INSERT INTO `site_settings` (`site_name`, `footer_text`, `about_title`, `about_text`, `about_details`, `address`, `phone`, `contact_email`) VALUES
('Afterthink Studio', 'Luxury architecture and interior design brought to life with craftsmanship and clarity.', 'Our Philosophy', 'We craft architecture and interiors inspired by light, material, and place.', 'Afterthink Studio is a full-service design practice focused on delivering elegant, modern living environments for residential and commercial clients.', '123 Premium Ave, Design City', '+1 555 854 3210', 'info@afterthinkstudio.com');

INSERT INTO `seo_settings` (`meta_title`, `meta_description`, `meta_keywords`, `og_title`, `og_description`) VALUES
('Afterthink Studio | Architecture & Interior Design', 'Afterthink Studio delivers luxury architecture and interior design with thoughtful craft and refined detail.', 'architecture, interior design, luxury homes, design studio, portfolio', 'Afterthink Studio', 'A premium architecture and interior design firm crafting modern, timeless spaces.');
