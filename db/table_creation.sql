CREATE TABLE `enquiry` (
  `enquiryId` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` tinytext,
  `subject` varchar(50) DEFAULT NULL,
  `query_text` text NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`enquiryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='this table contains all the enquiries from the website';
