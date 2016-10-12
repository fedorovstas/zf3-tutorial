-- Дамп структуры для таблица cybertone_test_stas_fedorov.consumer
DROP TABLE IF EXISTS `consumer`;
CREATE TABLE IF NOT EXISTS `consumer` (
  `consumerId` int(11) NOT NULL AUTO_INCREMENT,
  `groupId` int(11) NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `expirationDateTime` timestamp NULL DEFAULT NULL,
  `imageExtention` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`consumerId`),
  KEY `groupId` (`groupId`),
  CONSTRAINT `FK_consumer_group` FOREIGN KEY (`groupId`) REFERENCES `group` (`groupId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы cybertone_test_stas_fedorov.consumer: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `consumer` DISABLE KEYS */;
INSERT INTO `consumer` (`consumerId`, `groupId`, `login`, `password`, `email`, `expirationDateTime`, `imageExtention`) VALUES
	(47, 7, 'customer1', 'ffbc4675f864e0e9aab8bdf7a0437010', 'customer1@example.com', '2016-11-05 16:26:36', 'png'),
	(48, 7, 'customer2', '5ce4d191fd14ac85a1469fb8c29b7a7b', 'customer2@example.com', '2016-11-05 16:27:46', 'png'),
	(49, 8, 'customer3', '033f7f6121501ae98285ad77f216d5e7', 'customer3@example.com', '2016-11-05 16:28:51', 'png'),
	(50, 8, 'customer4', '55feb130be438e686ad6a80d12dd8f44', 'customer4@example.com', '2016-11-05 16:29:12', 'png'),
	(51, 9, 'customer5', '9e8486cdd435beda9a60806dd334d964', 'customer5@example.com', '2016-11-05 16:29:28', 'png'),
	(52, 9, 'customer6', 'dbaa8bd25e06cc641f5406027c026e8b', 'customer6@example.com', '2016-11-05 16:29:43', 'png'),
	(53, 10, 'customer7', '81162e1ef3d93f96b36d3712ca52bca5', 'customer7@example.com', '2016-11-05 16:30:02', 'png'),
	(54, 10, 'customer8', '3079e3991f94d1b3b21b894f329d369d', 'customer8@example.com', '2016-11-05 16:30:14', 'png'),
	(55, 11, 'customer9', '2f72319caec5d639aead26fc77b5ef67', 'customer9@example.com', '2016-11-05 16:30:29', 'png'),
	(56, 11, 'customer10', 'a2b14389d02e3cd6e4e115d40742e55f', 'customer10@example.com', '2016-11-05 16:31:21', 'png'),
	(57, 12, 'customer11', '236fd0fa27a9769bf8d66713897f1fff', 'customer11@example.com', '2016-11-05 16:31:51', 'png'),
	(58, 12, 'customer12', 'a18135715c76076101fb25da8b1f8b24', 'customer12@example.com', '2016-11-05 16:32:02', 'png'),
	(59, 13, 'customer13', 'e90d3fa207c52d083dfb9e2f75ea2761', 'customer13@example.com', '2016-11-05 16:32:23', 'png'),
	(60, 13, 'customer14', '7fde19c6179474de22795723b87d45c9', 'customer14@example.com', '2016-11-05 16:32:35', 'png'),
	(61, 14, 'customer15', '4a56cc83699969ea43571d723b645048', 'customer15@example.com', '2016-11-05 16:32:46', 'png'),
	(62, 14, 'customer16', '537d4b76ba087f39cb33256c09571dab', 'customer16@example.com', '2016-11-05 16:33:55', 'png'),
	(63, 15, 'customer17', 'e0ad51706d03183112be576075e9ed23', 'customer17@example.com', '2016-11-05 16:34:07', 'png'),
	(64, 15, 'customer18', '44d20fcc8d9708be0482d1a3919cd256', 'customer18@example.com', '2016-11-05 16:34:25', 'png'),
	(65, 16, 'customer19', 'bc81ac265bbe4296cdc95dee57547dcb', 'customer19@example.com', '2016-11-05 16:35:06', 'png'),
	(66, 16, 'customer20', 'df331e2aa16d4a5e920a23113386f52f', 'customer20@example.com', '2016-11-05 16:35:20', 'png');
/*!40000 ALTER TABLE `consumer` ENABLE KEYS */;

-- Дамп структуры для таблица cybertone_test_stas_fedorov.group
DROP TABLE IF EXISTS `group`;
CREATE TABLE IF NOT EXISTS `group` (
  `groupId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`groupId`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы cybertone_test_stas_fedorov.group: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` (`groupId`, `name`) VALUES
	(7, 'group1'),
	(8, 'group2'),
	(9, 'group3'),
	(10, 'group4'),
	(11, 'group5'),
	(12, 'group6'),
	(13, 'group7'),
	(14, 'group8'),
	(15, 'group9'),
	(16, 'group10');
/*!40000 ALTER TABLE `group` ENABLE KEYS */;