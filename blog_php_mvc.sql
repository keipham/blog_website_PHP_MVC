CREATE DATABASE IF NOT EXISTS `blog_php_mvc`;
USE `blog_php_mvc`;


CREATE TABLE IF NOT EXISTS `user` (
  `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_group` varchar(255) DEFAULT NULL,
  `user_status` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TRIGGER IF EXISTS before_user_created;
DELIMITER $$
CREATE TRIGGER before_user_created
BEFORE INSERT ON `user`
FOR EACH ROW BEGIN
	INSERT INTO user (
		created_date, updated_date
	) VALUES(
		NOW(), NOW()
	);
END $$

DROP TRIGGER IF EXISTS before_user_updated;
DELIMITER $$
CREATE TRIGGER before_user_updated
BEFORE UPDATE ON `user`
FOR EACH ROW BEGIN
	UPDATE user 
  SET updated_date = NOW();
END $$

CREATE TABLE IF NOT EXISTS `article` (
  `article_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_title` varchar(255) DEFAULT NULL,
  `article_content` text DEFAULT NULL,
  `article_image` BLOB DEFAULT NULL,
  `category_id` INT UNSIGNED NOT NULL,
  `user_id` INT UNSIGNED NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` varchar(255) NOT NULL,

  PRIMARY KEY (`article_id`),
  CONSTRAINT `blog_user_article_FK` FOREIGN KEY (`user_id`) REFERENCES user(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `blog_category_article_FK` FOREIGN KEY (`category_id`) REFERENCES category(`category_id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TRIGGER IF EXISTS before_article_created;
DELIMITER $$
CREATE TRIGGER before_article_created
BEFORE INSERT ON `article`
FOR EACH ROW BEGIN
	INSERT INTO article (
		created_date, updated_date
	) VALUES(
		NOW(), NOW()
	);
END $$

DROP TRIGGER IF EXISTS before_article_updated;
DELIMITER $$
CREATE TRIGGER before_article_updated
BEFORE UPDATE ON `article`
FOR EACH ROW BEGIN
	UPDATE article 
  SET updated_date = NOW();
END $$

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  `category_desc` datetime NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` varchar(255) NOT NULL,

  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;