CREATE TABLE IF NOT EXISTS `cmw_simplecookies_settings`
(
    `banner_title` VARCHAR(255)                          NOT NULL,
    `banner_text`  TEXT                                  NOT NULL,
    `page_content` MEDIUMTEXT                            NOT NULL,
    `date_updated` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB
  CHARACTER SET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

INSERT INTO `cmw_simplecookies_settings` (`banner_title`, `banner_text`, `page_content`)
VALUES ('Cookie Banner', 'This website uses cookies to ensure you get the best experience.',
        'This website uses cookies to ensure you get the best experience on our website.');