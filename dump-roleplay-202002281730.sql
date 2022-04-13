--
-- Table structure for table `bestiary`
--
SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `bestiary`;
CREATE TABLE `bestiary` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `universe_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `hide` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_946DE9FF5CD9AF2` (`universe_id`),
  CONSTRAINT `FK_946DE9FF5CD9AF2` FOREIGN KEY (`universe_id`) REFERENCES `universe` (`id`)
);

--
-- Dumping data for table `bestiary`
--

LOCK TABLES `bestiary` WRITE;
INSERT INTO `bestiary` VALUES ('29b0db5f-e5fb-11e9-b542-8cec4b72a049','007b8b72-5245-11ea-be25-8cec4b72a049','monstre','uploads/images/578835ef1bc78e62ea0ea89972aaa4bc.jpeg',0),('cadc9fab-5884-11ea-baf0-8cec4b72a049','007b8b72-5245-11ea-be25-8cec4b72a049','test','uploads/images/d802c08588ce4bdb7c363482baafdbb7.jpeg',0),('d1fcec56-5884-11ea-baf0-8cec4b72a049','007b8b72-5245-11ea-be25-8cec4b72a049','test 2','uploads/images/d7fe6deb0d524cd5277ff3e1cf026737.jpeg',1);
UNLOCK TABLES;

--
-- Table structure for table `capacity_hs`
--

DROP TABLE IF EXISTS `capacity_hs`;
CREATE TABLE `capacity_hs` (
  `lvl` int(11) NOT NULL,
  `capacity` int(11) NOT NULL DEFAULT '0',
  `max_type_item_craft` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`lvl`)
);

--
-- Dumping data for table `capacity_hs`
--

LOCK TABLES `capacity_hs` WRITE;
INSERT INTO `capacity_hs` VALUES (1,100,100),(2,100,100);
UNLOCK TABLES;

--
-- Table structure for table `category_item`
--

DROP TABLE IF EXISTS `category_item`;
CREATE TABLE `category_item` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(255) NOT NULL,
  `shortname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `category_item`
--

LOCK TABLES `category_item` WRITE;
INSERT INTO `category_item` VALUES ('70d38f62-e5fa-11e9-b542-8cec4b72a049','tranchant','tranchant'),('7543f996-e5fa-11e9-b542-8cec4b72a049','contendant','contendant'),('84c5eb6c-e5fa-11e9-b542-8cec4b72a049','animaux','animaux');
UNLOCK TABLES;

--
-- Table structure for table `configuration_field`
--

DROP TABLE IF EXISTS `configuration_field`;
CREATE TABLE `configuration_field` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `universe_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C5F4838D5CD9AF2` (`universe_id`),
  CONSTRAINT `FK_C5F4838D5CD9AF2` FOREIGN KEY (`universe_id`) REFERENCES `universe` (`id`)
);

--
-- Dumping data for table `configuration_field`
--

LOCK TABLES `configuration_field` WRITE;
INSERT INTO `configuration_field` VALUES ('13c00c97-e5fb-11e9-b542-8cec4b72a049','02f45970-e5fb-11e9-b542-8cec4b72a049','mana','mana'),('17f3611f-e5fb-11e9-b542-8cec4b72a049','02f45970-e5fb-11e9-b542-8cec4b72a049','pv','pv');
UNLOCK TABLES;

--
-- Table structure for table `craft`
--

DROP TABLE IF EXISTS `craft`;
CREATE TABLE `craft` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `item_source_one_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `item_source_two_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `item_result_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `operation` enum('OR','AND') DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `craft_unique` (`item_source_one_id`,`item_source_two_id`,`operation`,`item_result_id`),
  KEY `IDX_F45C4A84A1C9432E` (`item_source_one_id`),
  KEY `IDX_F45C4A84CA95A4E1` (`item_source_two_id`),
  KEY `IDX_F45C4A84B7DA0B3` (`item_result_id`),
  CONSTRAINT `FK_F45C4A84A1C9432E` FOREIGN KEY (`item_source_one_id`) REFERENCES `item` (`id`),
  CONSTRAINT `FK_F45C4A84B7DA0B3` FOREIGN KEY (`item_result_id`) REFERENCES `item` (`id`),
  CONSTRAINT `FK_F45C4A84CA95A4E1` FOREIGN KEY (`item_source_two_id`) REFERENCES `item` (`id`)
);

--
-- Dumping data for table `craft`
--

LOCK TABLES `craft` WRITE;
INSERT INTO `craft` VALUES ('e0da2201-e5fa-11e9-b542-8cec4b72a049','96244dec-e5fa-11e9-b542-8cec4b72a049','a020f36a-e5fa-11e9-b542-8cec4b72a049','d41eebcd-e5fa-11e9-b542-8cec4b72a049','AND');
UNLOCK TABLES;

--
-- Table structure for table `field_bestiary`
--

DROP TABLE IF EXISTS `field_bestiary`;
CREATE TABLE `field_bestiary` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `configuration_field_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `bestiary_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `field_player_unique` (`configuration_field_id`,`bestiary_id`),
  KEY `IDX_42556E3225D2B0AB` (`configuration_field_id`),
  KEY `IDX_42556E326466A409` (`bestiary_id`),
  CONSTRAINT `FK_42556E3225D2B0AB` FOREIGN KEY (`configuration_field_id`) REFERENCES `configuration_field` (`id`),
  CONSTRAINT `FK_42556E326466A409` FOREIGN KEY (`bestiary_id`) REFERENCES `bestiary` (`id`)
);

--
-- Dumping data for table `field_bestiary`
--

LOCK TABLES `field_bestiary` WRITE;
INSERT INTO `field_bestiary` VALUES ('3c3ba927-e5fb-11e9-b542-8cec4b72a049','13c00c97-e5fb-11e9-b542-8cec4b72a049','29b0db5f-e5fb-11e9-b542-8cec4b72a049','10'),('4024d938-e5fb-11e9-b542-8cec4b72a049','17f3611f-e5fb-11e9-b542-8cec4b72a049','29b0db5f-e5fb-11e9-b542-8cec4b72a049','100'),('d86b4c77-5884-11ea-baf0-8cec4b72a049','13c00c97-e5fb-11e9-b542-8cec4b72a049','cadc9fab-5884-11ea-baf0-8cec4b72a049','10'),('dc4b1651-5884-11ea-baf0-8cec4b72a049','17f3611f-e5fb-11e9-b542-8cec4b72a049','cadc9fab-5884-11ea-baf0-8cec4b72a049','10'),('e09c9577-5884-11ea-baf0-8cec4b72a049','13c00c97-e5fb-11e9-b542-8cec4b72a049','d1fcec56-5884-11ea-baf0-8cec4b72a049','10'),('e45d44a7-5884-11ea-baf0-8cec4b72a049','17f3611f-e5fb-11e9-b542-8cec4b72a049','d1fcec56-5884-11ea-baf0-8cec4b72a049','10');
UNLOCK TABLES;

--
-- Table structure for table `field_player`
--

DROP TABLE IF EXISTS `field_player`;
CREATE TABLE `field_player` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `configuration_field_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `player_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `field_player_unique` (`configuration_field_id`,`player_id`),
  KEY `IDX_B25DF66725D2B0AB` (`configuration_field_id`),
  KEY `IDX_B25DF66799E6F5DF` (`player_id`),
  CONSTRAINT `FK_B25DF66725D2B0AB` FOREIGN KEY (`configuration_field_id`) REFERENCES `configuration_field` (`id`),
  CONSTRAINT `FK_B25DF66799E6F5DF` FOREIGN KEY (`player_id`) REFERENCES `player` (`id`)
);

--
-- Dumping data for table `field_player`
--

LOCK TABLES `field_player` WRITE;
INSERT INTO `field_player` VALUES ('3289b153-e5fb-11e9-b542-8cec4b72a049','17f3611f-e5fb-11e9-b542-8cec4b72a049','1d27d31a-e5fb-11e9-b542-8cec4b72a049','10'),('37aa16dc-e5fb-11e9-b542-8cec4b72a049','13c00c97-e5fb-11e9-b542-8cec4b72a049','1d27d31a-e5fb-11e9-b542-8cec4b72a049','10'),('b3fc7b66-5884-11ea-baf0-8cec4b72a049','13c00c97-e5fb-11e9-b542-8cec4b72a049','1bfa1f09-5245-11ea-be25-8cec4b72a049','10'),('b7fdaa16-5884-11ea-baf0-8cec4b72a049','17f3611f-e5fb-11e9-b542-8cec4b72a049','1bfa1f09-5245-11ea-be25-8cec4b72a049','10');
UNLOCK TABLES;

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE `inventory` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `character_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `item_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  PRIMARY KEY (`id`),
  KEY `IDX_B12D4A361136BE75` (`character_id`),
  KEY `IDX_B12D4A36126F525E` (`item_id`),
  CONSTRAINT `FK_B12D4A361136BE75` FOREIGN KEY (`character_id`) REFERENCES `user_character` (`id`),
  CONSTRAINT `FK_B12D4A36126F525E` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`)
);

--
-- Dumping data for table `inventory`
--

LOCK TABLES `inventory` WRITE;
INSERT INTO `inventory` VALUES ('a7ebffc8-e5fb-11e9-b542-8cec4b72a049','611230d5-e5fa-11e9-b542-8cec4b72a049','af016d03-e5fa-11e9-b542-8cec4b72a049'),('e75595ad-e5fb-11e9-b542-8cec4b72a049','611230d5-e5fa-11e9-b542-8cec4b72a049','d41eebcd-e5fa-11e9-b542-8cec4b72a049'),('efe46f30-e5fb-11e9-b542-8cec4b72a049','611230d5-e5fa-11e9-b542-8cec4b72a049','96244dec-e5fa-11e9-b542-8cec4b72a049'),('f14e98f8-e5fb-11e9-b542-8cec4b72a049','611230d5-e5fa-11e9-b542-8cec4b72a049','a020f36a-e5fa-11e9-b542-8cec4b72a049');
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `cost` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `isvisible` tinyint(1) NOT NULL DEFAULT '0',
  `isvalid` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);


--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
INSERT INTO `item` VALUES ('96244dec-e5fa-11e9-b542-8cec4b72a049','baton','baton',10,'uploads/images/3c8af986f78c2f07c1cc857aaaa1fca3.png',1,1),('a020f36a-e5fa-11e9-b542-8cec4b72a049','clous','clous',10,'uploads/images/4a865269f07673296fa7ce087ac215ed.png',1,1),('af016d03-e5fa-11e9-b542-8cec4b72a049','épée','épée',10,'uploads/images/e97cf27aee297da8ff316225efc85e02.png',1,1),('bdf615ef-e5fa-11e9-b542-8cec4b72a049','bad','bad',10,'uploads/images/454e4a1227777ae511cd8efb66cce8ce.jpeg',0,1),('d41eebcd-e5fa-11e9-b542-8cec4b72a049','bate clouté','bate clouté',100,'uploads/images/bf0e092ecf48c1534d9b360cb5c22ddf.png',0,1);
UNLOCK TABLES;

--
-- Table structure for table `items_type`
--

DROP TABLE IF EXISTS `items_type`;
CREATE TABLE `items_type` (
  `item_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `type_item_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  PRIMARY KEY (`item_id`,`type_item_id`),
  KEY `IDX_8B32F9AF126F525E` (`item_id`),
  KEY `IDX_8B32F9AF3A4E3DAB` (`type_item_id`),
  CONSTRAINT `FK_8B32F9AF126F525E` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`),
  CONSTRAINT `FK_8B32F9AF3A4E3DAB` FOREIGN KEY (`type_item_id`) REFERENCES `type_item` (`id`)
);


--
-- Dumping data for table `items_type`
--

LOCK TABLES `items_type` WRITE;
INSERT INTO `items_type` VALUES ('96244dec-e5fa-11e9-b542-8cec4b72a049','7f499762-e5fa-11e9-b542-8cec4b72a049'),('af016d03-e5fa-11e9-b542-8cec4b72a049','7a4b02fb-e5fa-11e9-b542-8cec4b72a049'),('bdf615ef-e5fa-11e9-b542-8cec4b72a049','8a135f71-e5fa-11e9-b542-8cec4b72a049'),('d41eebcd-e5fa-11e9-b542-8cec4b72a049','7f499762-e5fa-11e9-b542-8cec4b72a049');
UNLOCK TABLES;

--
-- Table structure for table `map`
--

DROP TABLE IF EXISTS `map`;
CREATE TABLE `map` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `universe_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `display` tinyint(1) NOT NULL,
  `vertical_axis` int(11) NOT NULL,
  `horizontal_axis` int(11) NOT NULL,
  `type_affichage` enum('mapper','cacher','visible') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_93ADAABB5CD9AF2` (`universe_id`),
  CONSTRAINT `FK_93ADAABB5CD9AF2` FOREIGN KEY (`universe_id`) REFERENCES `universe` (`id`)
);


--
-- Dumping data for table `map`
--

LOCK TABLES `map` WRITE;
INSERT INTO `map` VALUES ('0d4b1062-e5fb-11e9-b542-8cec4b72a049','02f45970-e5fb-11e9-b542-8cec4b72a049','elder','uploads/images/e50ecf3d74540a3045e1b89ce9ee05a4.jpeg',1,12,12,NULL),('4059914d-5959-11ea-baf0-8cec4b72a049','007b8b72-5245-11ea-be25-8cec4b72a049','test map','uploads/images/1a3199720b3f7f76464fe0af0ef384a0.jpeg',1,12,12,'mapper'),('af419f4f-597f-11ea-baf0-8cec4b72a049','007b8b72-5245-11ea-be25-8cec4b72a049','test 2','uploads/images/adedcfdbca3e6de9d647246dcff5cbf0.jpeg',1,12,12,'cacher'),('b8567673-597f-11ea-baf0-8cec4b72a049','007b8b72-5245-11ea-be25-8cec4b72a049','test 3','uploads/images/85d1d5d41e632e38ac426effff1817c9.jpeg',1,16,16,'visible');
UNLOCK TABLES;

--
-- Table structure for table `mapping_map`
--

DROP TABLE IF EXISTS `mapping_map`;
CREATE TABLE `mapping_map` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `map_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `vertical_axis` int(11) NOT NULL,
  `horizontal_axis` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6A51F7C453C55F64` (`map_id`),
  CONSTRAINT `FK_6A51F7C453C55F64` FOREIGN KEY (`map_id`) REFERENCES `map` (`id`)
);


--
-- Dumping data for table `mapping_map`
--

LOCK TABLES `mapping_map` WRITE;
INSERT INTO `mapping_map` VALUES ('da6aafed-597f-11ea-baf0-8cec4b72a049','4059914d-5959-11ea-baf0-8cec4b72a049',4,4),('e0125de4-597f-11ea-baf0-8cec4b72a049','4059914d-5959-11ea-baf0-8cec4b72a049',5,5),('e3e37e65-597f-11ea-baf0-8cec4b72a049','4059914d-5959-11ea-baf0-8cec4b72a049',6,6);
UNLOCK TABLES;

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE `migration_versions` (
  `version` varchar(14) NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
);


--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
INSERT INTO `migration_versions` VALUES ('20190917093616','2019-09-17 09:36:24'),('20190925121628','2019-09-25 12:16:43'),('20190925124659','2019-09-25 12:47:11'),('20191003132550','2019-10-03 13:26:19'),('20200227170502','2020-02-27 17:05:12');
UNLOCK TABLES;

--
-- Table structure for table `player`
--

DROP TABLE IF EXISTS `player`;
CREATE TABLE `player` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `universe_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `user_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_98197A655CD9AF2` (`universe_id`),
  KEY `IDX_98197A65A76ED395` (`user_id`),
  CONSTRAINT `FK_98197A655CD9AF2` FOREIGN KEY (`universe_id`) REFERENCES `universe` (`id`),
  CONSTRAINT `FK_98197A65A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
);


--
-- Dumping data for table `player`
--

LOCK TABLES `player` WRITE;
INSERT INTO `player` VALUES ('1bfa1f09-5245-11ea-be25-8cec4b72a049','007b8b72-5245-11ea-be25-8cec4b72a049','c0319a2b-e5f9-11e9-b542-8cec4b72a049','player test dragon age'),('1d27d31a-e5fb-11e9-b542-8cec4b72a049','02f45970-e5fb-11e9-b542-8cec4b72a049','c0319a2b-e5f9-11e9-b542-8cec4b72a049','Player test elder'),('47a63c0d-e5fb-11e9-b542-8cec4b72a049','007b8b72-5245-11ea-be25-8cec4b72a049','79781925-e5e1-11e9-b542-8cec4b72a049','Player admin'),('aeecfea3-5879-11ea-baf0-8cec4b72a049','007b8b72-5245-11ea-be25-8cec4b72a049','97f30862-5879-11ea-baf0-8cec4b72a049','player test1 dragon age'),('b6e0aed8-5879-11ea-baf0-8cec4b72a049','007b8b72-5245-11ea-be25-8cec4b72a049','a1090ec9-5879-11ea-baf0-8cec4b72a049','player test2 dragon age');
UNLOCK TABLES;

--
-- Table structure for table `skill`
--

DROP TABLE IF EXISTS `skill`;
CREATE TABLE `skill` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `weapon_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `skill_parent_id` char(36) DEFAULT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `cost` int(11) NOT NULL,
  `enable` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5E3DE47795B82273` (`weapon_id`),
  KEY `IDX_5E3DE477218BF12D` (`skill_parent_id`),
  CONSTRAINT `FK_5E3DE477218BF12D` FOREIGN KEY (`skill_parent_id`) REFERENCES `skill` (`id`),
  CONSTRAINT `FK_5E3DE47795B82273` FOREIGN KEY (`weapon_id`) REFERENCES `weapon` (`id`)
);


--
-- Dumping data for table `skill`
--

LOCK TABLES `skill` WRITE;
INSERT INTO `skill` VALUES ('286cdecb-e5fa-11e9-b542-8cec4b72a049','1a32a53a-e5fa-11e9-b542-8cec4b72a049',NULL,'Skill 1',NULL,NULL,10,0),('31e09627-e5fa-11e9-b542-8cec4b72a049','1a32a53a-e5fa-11e9-b542-8cec4b72a049',NULL,'Skill 2',NULL,NULL,20,1),('37e82f5f-e5fa-11e9-b542-8cec4b72a049','1a32a53a-e5fa-11e9-b542-8cec4b72a049',NULL,'Skill 3',NULL,NULL,30,1),('3f42996d-e5fa-11e9-b542-8cec4b72a049','1a32a53a-e5fa-11e9-b542-8cec4b72a049','31e09627-e5fa-11e9-b542-8cec4b72a049','Skill 2.1',NULL,NULL,20,0),('4866b365-e5fa-11e9-b542-8cec4b72a049','1a32a53a-e5fa-11e9-b542-8cec4b72a049','31e09627-e5fa-11e9-b542-8cec4b72a049','Skill 2.2',NULL,NULL,20,1),('4ead143d-e5fa-11e9-b542-8cec4b72a049','1a32a53a-e5fa-11e9-b542-8cec4b72a049','3f42996d-e5fa-11e9-b542-8cec4b72a049','Skill 2.3',NULL,NULL,20,1);
UNLOCK TABLES;

--
-- Table structure for table `type_item`
--

DROP TABLE IF EXISTS `type_item`;
CREATE TABLE `type_item` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `category_item_id` char(36) DEFAULT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(255) NOT NULL,
  `shortname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C814E016D5B71220` (`category_item_id`),
  CONSTRAINT `FK_C814E016D5B71220` FOREIGN KEY (`category_item_id`) REFERENCES `category_item` (`id`)
);


--
-- Dumping data for table `type_item`
--

LOCK TABLES `type_item` WRITE;
INSERT INTO `type_item` VALUES ('7a4b02fb-e5fa-11e9-b542-8cec4b72a049','70d38f62-e5fa-11e9-b542-8cec4b72a049','épée','_ep_ee'),('7f499762-e5fa-11e9-b542-8cec4b72a049','7543f996-e5fa-11e9-b542-8cec4b72a049','baton','baton'),('8a135f71-e5fa-11e9-b542-8cec4b72a049','84c5eb6c-e5fa-11e9-b542-8cec4b72a049','volant','volant');
UNLOCK TABLES;

--
-- Table structure for table `universe`
--

DROP TABLE IF EXISTS `universe`;
CREATE TABLE `universe` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(255) NOT NULL,
  `display` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
);


--
-- Dumping data for table `universe`
--

LOCK TABLES `universe` WRITE;
INSERT INTO `universe` VALUES ('007b8b72-5245-11ea-be25-8cec4b72a049','Dragon Age',1),('02f45970-e5fb-11e9-b542-8cec4b72a049','elder',1),('0cd0c796-5245-11ea-be25-8cec4b72a049','Morrowind',1);
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `weapon_id` char(36) DEFAULT NULL COMMENT '(DC2Type:guid)',
  `character_id` char(36) DEFAULT NULL COMMENT '(DC2Type:guid)',
  `email` varchar(180) NOT NULL,
  `name` varchar(152) NOT NULL,
  `roles` text NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  UNIQUE KEY `UNIQ_8D93D6495E237E06` (`name`),
  UNIQUE KEY `UNIQ_8D93D64995B82273` (`weapon_id`),
  UNIQUE KEY `UNIQ_8D93D6491136BE75` (`character_id`),
  CONSTRAINT `FK_8D93D6491136BE75` FOREIGN KEY (`character_id`) REFERENCES `user_character` (`id`),
  CONSTRAINT `FK_8D93D64995B82273` FOREIGN KEY (`weapon_id`) REFERENCES `weapon` (`id`)
);


--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
INSERT INTO `user` VALUES ('79781925-e5e1-11e9-b542-8cec4b72a049',NULL,NULL,'jean.philippe.debos@gmail.com','admin','[\"ROLE_ADMIN\", \"ROLE_USER\"]','$argon2i$v=19$m=1024,t=2,p=2$UmlSQnlKMnZxZ2FSNzJOQg$HKXbsQH6b8WMy/3MqUwH35Mjv4zadu3fR6xu23wxHHI'),('97f30862-5879-11ea-baf0-8cec4b72a049',NULL,NULL,'test1@test.fr','test1','[\"ROLE_USER\"]','$argon2i$v=19$m=1024,t=2,p=2$N2hBbW84UnZnbXJuRUF0Rw$CGFHRMekF+/fms5646x6Mh1gBruKUmVUfcL0wuW3sSA'),('a1090ec9-5879-11ea-baf0-8cec4b72a049',NULL,NULL,'test2@test.fr','test2','[\"ROLE_USER\"]','$argon2i$v=19$m=1024,t=2,p=2$dTYzSDl1NXBWSVF6R0VlOQ$Bv6GuPTSj5X8I0EgUJ5A2JezOgBL+I48XgCsr5Gh9g4'),('c0319a2b-e5f9-11e9-b542-8cec4b72a049','1a32a53a-e5fa-11e9-b542-8cec4b72a049','611230d5-e5fa-11e9-b542-8cec4b72a049','test@test.fr','test','[\"ROLE_USER\"]','$argon2i$v=19$m=1024,t=2,p=2$c3RvWnA5UFBBTU1CbnVuWg$DZ/ENER4Rh6xw8ZgURSfFmgTvtX3/mDB6ye9/nzH3ug');
UNLOCK TABLES;

--
-- Table structure for table `user_character`
--

DROP TABLE IF EXISTS `user_character`;
CREATE TABLE `user_character` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `player_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `username` varchar(150) NOT NULL,
  `lvl` int(11) NOT NULL DEFAULT '1',
  `resource` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_939A3DD0F85E0677` (`username`),
  UNIQUE KEY `UNIQ_939A3DD099E6F5DF` (`player_id`),
  CONSTRAINT `FK_939A3DD099E6F5DF` FOREIGN KEY (`player_id`) REFERENCES `user` (`id`)
);


--
-- Dumping data for table `user_character`
--

LOCK TABLES `user_character` WRITE;
INSERT INTO `user_character` VALUES ('611230d5-e5fa-11e9-b542-8cec4b72a049','c0319a2b-e5f9-11e9-b542-8cec4b72a049','user test',1,999930);
UNLOCK TABLES;

--
-- Table structure for table `visibility_craft_item`
--

DROP TABLE IF EXISTS `visibility_craft_item`;
CREATE TABLE `visibility_craft_item` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `character_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `craft_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `isvalid` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `visibility_craft_item_unique` (`character_id`,`craft_id`),
  KEY `IDX_C65A6C3D1136BE75` (`character_id`),
  KEY `IDX_C65A6C3DE836CCC8` (`craft_id`),
  CONSTRAINT `FK_C65A6C3D1136BE75` FOREIGN KEY (`character_id`) REFERENCES `user_character` (`id`),
  CONSTRAINT `FK_C65A6C3DE836CCC8` FOREIGN KEY (`craft_id`) REFERENCES `craft` (`id`)
);


--
-- Dumping data for table `visibility_craft_item`
--

LOCK TABLES `visibility_craft_item` WRITE;
INSERT INTO `visibility_craft_item` VALUES ('e79a7bc8-e5fb-11e9-b542-8cec4b72a049','611230d5-e5fa-11e9-b542-8cec4b72a049','e0da2201-e5fa-11e9-b542-8cec4b72a049',1);
UNLOCK TABLES;

--
-- Table structure for table `weapon`
--

DROP TABLE IF EXISTS `weapon`;
CREATE TABLE `weapon` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `player_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_6933A7E699E6F5DF` (`player_id`),
  CONSTRAINT `FK_6933A7E699E6F5DF` FOREIGN KEY (`player_id`) REFERENCES `user` (`id`)
);


--
-- Dumping data for table `weapon`
--

LOCK TABLES `weapon` WRITE;
INSERT INTO `weapon` VALUES ('1a32a53a-e5fa-11e9-b542-8cec4b72a049','c0319a2b-e5f9-11e9-b542-8cec4b72a049','shield','the shield','uploads/images/9bd93e603cc72abc47cc42881f02b5c1.jpeg');
UNLOCK TABLES;

--
-- Table structure for table `whisper`
--

DROP TABLE IF EXISTS `whisper`;
CREATE TABLE `whisper` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `for_player_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `to_player_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `whisp` varchar(255) NOT NULL,
  `isread` tinyint(1) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4FDC41006A1A67FE` (`for_player_id`),
  KEY `IDX_4FDC4100A84522AE` (`to_player_id`),
  CONSTRAINT `FK_4FDC41006A1A67FE` FOREIGN KEY (`for_player_id`) REFERENCES `player` (`id`),
  CONSTRAINT `FK_4FDC4100A84522AE` FOREIGN KEY (`to_player_id`) REFERENCES `player` (`id`)
);


--
-- Dumping data for table `whisper`
--

LOCK TABLES `whisper` WRITE;
INSERT INTO `whisper` VALUES ('025b72e3-589f-11ea-baf0-8cec4b72a049','aeecfea3-5879-11ea-baf0-8cec4b72a049','1bfa1f09-5245-11ea-be25-8cec4b72a049','test 11',1,'2020-02-26 14:50:00'),('08a345ef-57f1-11ea-baf0-8cec4b72a049','1bfa1f09-5245-11ea-be25-8cec4b72a049','47a63c0d-e5fb-11e9-b542-8cec4b72a049','test6',1,'2020-02-25 18:05:13'),('0b5cf5eb-5407-11ea-8a1d-8cec4b72a049','47a63c0d-e5fb-11e9-b542-8cec4b72a049','1bfa1f09-5245-11ea-be25-8cec4b72a049','test message',1,'2015-01-01 00:00:00'),('0d4bb3d3-587f-11ea-baf0-8cec4b72a049','aeecfea3-5879-11ea-baf0-8cec4b72a049','1bfa1f09-5245-11ea-be25-8cec4b72a049','test 5',1,'2020-02-26 11:01:00'),('17dbd423-5407-11ea-8a1d-8cec4b72a049','1bfa1f09-5245-11ea-be25-8cec4b72a049','47a63c0d-e5fb-11e9-b542-8cec4b72a049','test 2',1,'2015-01-01 00:00:00'),('24a5ce8e-58a6-11ea-baf0-8cec4b72a049','47a63c0d-e5fb-11e9-b542-8cec4b72a049','1bfa1f09-5245-11ea-be25-8cec4b72a049','test fnal',1,'2020-02-26 15:41:00'),('24c95c58-5407-11ea-8a1d-8cec4b72a049','1bfa1f09-5245-11ea-be25-8cec4b72a049','47a63c0d-e5fb-11e9-b542-8cec4b72a049','test 3',1,'2015-01-01 00:00:00'),('3d7124d7-58a6-11ea-baf0-8cec4b72a049','aeecfea3-5879-11ea-baf0-8cec4b72a049','1bfa1f09-5245-11ea-be25-8cec4b72a049','test final 3',1,'2020-02-26 15:41:00'),('540ca8e1-e5fb-11e9-b542-8cec4b72a049','47a63c0d-e5fb-11e9-b542-8cec4b72a049','1d27d31a-e5fb-11e9-b542-8cec4b72a049','test Whisp',1,'2014-01-01 00:00:00'),('64379537-5882-11ea-baf0-8cec4b72a049','1bfa1f09-5245-11ea-be25-8cec4b72a049','aeecfea3-5879-11ea-baf0-8cec4b72a049','test 7',0,'2020-02-26 11:25:36'),('6917c5d4-57eb-11ea-baf0-8cec4b72a049','1bfa1f09-5245-11ea-be25-8cec4b72a049','47a63c0d-e5fb-11e9-b542-8cec4b72a049','test4',1,'2020-02-25 17:24:57'),('6bbd0667-587f-11ea-baf0-8cec4b72a049','aeecfea3-5879-11ea-baf0-8cec4b72a049','1bfa1f09-5245-11ea-be25-8cec4b72a049','test 6',1,'2020-02-26 11:04:00'),('86ee5a49-5958-11ea-baf0-8cec4b72a049','1bfa1f09-5245-11ea-be25-8cec4b72a049','aeecfea3-5879-11ea-baf0-8cec4b72a049','test',0,'2020-02-27 12:58:39'),('92c4bf2d-5884-11ea-baf0-8cec4b72a049','aeecfea3-5879-11ea-baf0-8cec4b72a049','1bfa1f09-5245-11ea-be25-8cec4b72a049','test 9',1,'2020-02-26 11:41:00'),('a6df0d40-57eb-11ea-baf0-8cec4b72a049','1bfa1f09-5245-11ea-be25-8cec4b72a049','47a63c0d-e5fb-11e9-b542-8cec4b72a049','test 5',1,'2020-02-25 17:26:41'),('b7d7f77b-587a-11ea-baf0-8cec4b72a049','aeecfea3-5879-11ea-baf0-8cec4b72a049','1bfa1f09-5245-11ea-be25-8cec4b72a049','test 3',1,'2020-02-26 10:30:00'),('d663cb3c-5879-11ea-baf0-8cec4b72a049','aeecfea3-5879-11ea-baf0-8cec4b72a049','1bfa1f09-5245-11ea-be25-8cec4b72a049','test 1',1,'2020-02-26 10:23:00'),('de76bdc4-5879-11ea-baf0-8cec4b72a049','aeecfea3-5879-11ea-baf0-8cec4b72a049','1bfa1f09-5245-11ea-be25-8cec4b72a049','test 2',1,'2020-02-26 10:24:00'),('e352c6fc-5880-11ea-baf0-8cec4b72a049','1bfa1f09-5245-11ea-be25-8cec4b72a049','aeecfea3-5879-11ea-baf0-8cec4b72a049','test',0,'2020-02-26 11:14:50'),('e388757a-587c-11ea-baf0-8cec4b72a049','aeecfea3-5879-11ea-baf0-8cec4b72a049','1bfa1f09-5245-11ea-be25-8cec4b72a049','test 4',1,'2020-02-26 10:45:00'),('e755de7c-57ea-11ea-baf0-8cec4b72a049','1bfa1f09-5245-11ea-be25-8cec4b72a049','47a63c0d-e5fb-11e9-b542-8cec4b72a049','test',1,'2020-02-25 17:21:20'),('f42ba203-5882-11ea-baf0-8cec4b72a049','aeecfea3-5879-11ea-baf0-8cec4b72a049','1bfa1f09-5245-11ea-be25-8cec4b72a049','test 8',1,'2020-02-26 11:29:00'),('f616dca4-589e-11ea-baf0-8cec4b72a049','1bfa1f09-5245-11ea-be25-8cec4b72a049','aeecfea3-5879-11ea-baf0-8cec4b72a049','test 10',0,'2020-02-26 14:50:07');
UNLOCK TABLES;

--
-- Table structure for table `pathfinder_bestiars_type`
--

DROP TABLE IF EXISTS `pathfinder_bestiars_type`;
CREATE TABLE `pathfinder_bestiars_type` (
  `pathfinder_bestiary_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `type_bestiary_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  PRIMARY KEY (`pathfinder_bestiary_id`,`type_bestiary_id`),
  KEY `IDX_5E3B5FC7E5439273` (`pathfinder_bestiary_id`),
  KEY `IDX_5E3B5FC72F7F7398` (`type_bestiary_id`),
  CONSTRAINT `FK_5E3B5FC72F7F7398` FOREIGN KEY (`type_bestiary_id`) REFERENCES `type_bestiary` (`id`),
  CONSTRAINT `FK_5E3B5FC7E5439273` FOREIGN KEY (`pathfinder_bestiary_id`) REFERENCES `pathfinder_bestiary` (`id`)
);

--
-- Dumping data for table `pathfinder_bestiars_type`
--

LOCK TABLES `pathfinder_bestiars_type` WRITE;
INSERT INTO `pathfinder_bestiars_type` VALUES ('94f385e6-8e79-11ec-b36b-080027f5075b','8bc0ad6b-9969-11ec-8a79-080027f5075b'),('94f385e6-8e79-11ec-b36b-080027f5075b','abd0a607-9969-11ec-8a79-080027f5075b'),('aabcb6ad-8e79-11ec-b36b-080027f5075b','abd0a607-9969-11ec-8a79-080027f5075b'),('aabcb6ad-8e79-11ec-b36b-080027f5075b','ef2201cb-9969-11ec-8a79-080027f5075b'),('ceb8c37b-8e79-11ec-b36b-080027f5075b','9a0d1282-9969-11ec-8a79-080027f5075b'),('ceb8c37b-8e79-11ec-b36b-080027f5075b','abd0a607-9969-11ec-8a79-080027f5075b'),('ceb8c37b-8e79-11ec-b36b-080027f5075b','ef2201cb-9969-11ec-8a79-080027f5075b');
UNLOCK TABLES;

--
-- Table structure for table `category_bestiary`
--

DROP TABLE IF EXISTS `category_bestiary`;
CREATE TABLE `category_bestiary` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(255) NOT NULL,
  `shortname` varchar(255) NOT NULL,
  `text_color` varchar(255) NOT NULL,
  `background_color` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `category_bestiary`
--

LOCK TABLES `category_bestiary` WRITE;
INSERT INTO `category_bestiary` VALUES ('2d42ed39-9969-11ec-8a79-080027f5075b','Taille','Taille','#ffffff','#0007d6'),('5788b781-9969-11ec-8a79-080027f5075b','Alignement','Alignement','#ffffff','#0f8500'),('753d0d67-9969-11ec-8a79-080027f5075b','Localisation','Localisation','#ffffff','#ff0000');
UNLOCK TABLES;

--
-- Table structure for table `type_bestiary`
--

DROP TABLE IF EXISTS `type_bestiary`;
CREATE TABLE `type_bestiary` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `category_bestiary_id` char(36) DEFAULT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(255) NOT NULL,
  `shortname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5992CE03D3FDE662` (`category_bestiary_id`),
  CONSTRAINT `FK_5992CE03D3FDE662` FOREIGN KEY (`category_bestiary_id`) REFERENCES `category_bestiary` (`id`)
);

--
-- Dumping data for table `type_bestiary`
--

LOCK TABLES `type_bestiary` WRITE;
INSERT INTO `type_bestiary` VALUES ('8bc0ad6b-9969-11ec-8a79-080027f5075b','2d42ed39-9969-11ec-8a79-080027f5075b','Grand','Grand'),('9a0d1282-9969-11ec-8a79-080027f5075b','2d42ed39-9969-11ec-8a79-080027f5075b','Normal','Normal'),('abd0a607-9969-11ec-8a79-080027f5075b','5788b781-9969-11ec-8a79-080027f5075b','CN','CN'),('bba84cc9-9969-11ec-8a79-080027f5075b','753d0d67-9969-11ec-8a79-080027f5075b','Foret','Foret'),('ef2201cb-9969-11ec-8a79-080027f5075b','753d0d67-9969-11ec-8a79-080027f5075b','Plaine','Plaine');
UNLOCK TABLES;

SET FOREIGN_KEY_CHECKS=1;

--
-- Dumping routines for database 'roleplay'
--

-- Dump completed on 2020-02-28 17:30:46
