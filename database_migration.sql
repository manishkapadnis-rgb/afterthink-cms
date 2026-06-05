-- Migration for installations created before sort ordering, login rate
-- limiting, and default contact details were added.
--
-- Safe to run on ANY existing database: every statement is idempotent, so it
-- will not error if a column/table/row is already present. (If you imported a
-- fresh `database.sql`, you do NOT need this file — it already includes these.)

-- --------------------------------------------------------------------------
-- services.sort_order (add only if missing)
-- --------------------------------------------------------------------------
SET @add_services_sort := (
  SELECT COUNT(*) FROM information_schema.COLUMNS
  WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'services' AND COLUMN_NAME = 'sort_order'
);
SET @sql := IF(@add_services_sort = 0,
  'ALTER TABLE `services` ADD COLUMN `sort_order` INT NOT NULL DEFAULT 0 AFTER `icon`',
  'DO 0');
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

-- --------------------------------------------------------------------------
-- projects.sort_order (add only if missing)
-- --------------------------------------------------------------------------
SET @add_projects_sort := (
  SELECT COUNT(*) FROM information_schema.COLUMNS
  WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'projects' AND COLUMN_NAME = 'sort_order'
);
SET @sql := IF(@add_projects_sort = 0,
  'ALTER TABLE `projects` ADD COLUMN `sort_order` INT NOT NULL DEFAULT 0 AFTER `gallery_preview`',
  'DO 0');
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

-- --------------------------------------------------------------------------
-- Login rate limiting (5 failed attempts per 15 minutes)
-- --------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` VARCHAR(45) NOT NULL,
  `email` VARCHAR(150) DEFAULT NULL,
  `attempted_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_login_attempts_ip_time` (`ip_address`, `attempted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------------------------
-- Default contact details row (insert only if the table is empty)
-- --------------------------------------------------------------------------
INSERT INTO `contact_settings` (`phone`, `email`, `address`)
SELECT '+1 212 555 0184', 'hello@afterthink.studio', 'Afterthink Studio, Architecture and Interiors'
WHERE NOT EXISTS (SELECT 1 FROM `contact_settings`);
