-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 13, 2018 at 07:31 AM
-- Server version: 5.5.59-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fit4site2`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_applied_jobs`
--

CREATE TABLE IF NOT EXISTS `tbl_applied_jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `read_unread` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tbl_applied_jobs`
--

INSERT INTO `tbl_applied_jobs` (`id`, `user_id`, `company_id`, `job_id`, `read_unread`) VALUES
(5, 3, 5, 7, 0),
(6, 3, 4, 6, 1),
(7, 1, 4, 5, 1),
(8, 7, 6, 9, 0),
(9, 8, 6, 9, 0),
(10, 7, 4, 5, 1),
(11, 2, 4, 6, 1),
(12, 11, 5, 7, 1),
(13, 11, 5, 10, 1),
(14, 11, 4, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `total_cart` int(11) NOT NULL DEFAULT '0',
  `is_shipped` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `userid`, `created_date`, `total_cart`, `is_shipped`) VALUES
(27, 3, '2017-12-05', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart_product`
--

CREATE TABLE IF NOT EXISTS `tbl_cart_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` double NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tbl_cart_product`
--

INSERT INTO `tbl_cart_product` (`id`, `product_cart_id`, `product_id`, `product_price`, `quantity`, `created_by`, `ip`) VALUES
(16, 27, 16, 4, 1, 4, '122.177.83.48'),
(17, 27, 17, 45, 1, 4, '122.177.83.48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `category_name`, `created_by`, `modified_by`, `modified_date`, `created_date`, `status`) VALUES
(8, 'Machine', 1, 4, '2018-01-22 11:29:56', '2017-11-20 16:05:44', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chat`
--

CREATE TABLE IF NOT EXISTS `tbl_chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `msg_from` varchar(255) NOT NULL DEFAULT '',
  `msg_to` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recd` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `to` (`msg_to`),
  KEY `from` (`msg_from`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_chat`
--

INSERT INTO `tbl_chat` (`id`, `msg_from`, `msg_to`, `message`, `sent`, `recd`) VALUES
(2, 'Administrator', 'Individual', 'sdfgsdfg', '2017-11-16 17:47:46', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_checkout`
--

CREATE TABLE IF NOT EXISTS `tbl_checkout` (
  `checkout_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `country` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `province` varchar(20) NOT NULL,
  `postcode` varchar(5) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_option` varchar(20) NOT NULL,
  `order_date` datetime NOT NULL,
  `sale_id` int(11) NOT NULL,
  PRIMARY KEY (`checkout_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `tbl_checkout`
--

INSERT INTO `tbl_checkout` (`checkout_id`, `firstname`, `lastname`, `address1`, `address2`, `phone`, `email`, `country`, `city`, `province`, `postcode`, `customer_id`, `payment_option`, `order_date`, `sale_id`) VALUES
(26, 'Abhishek', 'Kumar', 'Noida', 'Noida', '1234567890', '', 'India', 'Noida', 'Noida', '20130', 3, 'bank_transfer', '2017-12-05 08:47:22', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_companies`
--

CREATE TABLE IF NOT EXISTS `tbl_companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(250) DEFAULT NULL,
  `company_address` text,
  `company_website` varchar(255) DEFAULT NULL,
  `company_description` text NOT NULL,
  `company_image` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `company_contact` varchar(200) DEFAULT NULL,
  `posted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_companies`
--

INSERT INTO `tbl_companies` (`id`, `company_name`, `company_address`, `company_website`, `company_description`, `company_image`, `twitter_url`, `facebook_url`, `company_contact`, `posted_by`, `created_at`, `updated_at`) VALUES
(4, 'Dell India', 'bangloore', 'dell.co.in', '<p>Manufacturere</p>\n', '5d6fcfa67a67a8a795d71f7ff8f3.png', 'asfdasd', 'asdfasdf', '4456456', 1, '2017-11-02 09:05:35', '2017-11-02 09:05:35'),
(5, 'IBM India', 'Bangloru', 'ibm.co.in', '<p>Manufacturere</p>\n', 'f6ab176d1f5a5d922bfc85e72092.png', 'asfdasd', 'asdfasdf', '4456456', 6, '2017-11-02 09:05:35', '2017-11-02 09:05:35'),
(6, 'TheAppSense.com', 'E14-B Sector 8 Noida', 'theappsense.com', '<p>Test description.</p>\n', '2f4f70815cb055765ab7ab51c33e.png', '', '', '9718843015', 6, '2017-11-23 06:24:05', '2017-11-23 06:24:17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_groups`
--

CREATE TABLE IF NOT EXISTS `tbl_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `group_visibility` varchar(255) DEFAULT NULL COMMENT '"public for all members","private for only admin and member who request for group and are accepted","hidden only users who are invited not listed in directory search"',
  `description` text,
  `group_inivitation` int(11) DEFAULT '1' COMMENT '"1 for all group member","2 for group admin and mods only","3 for group admin only"',
  `enable_review` tinyint(1) NOT NULL DEFAULT '0',
  `enable_gallery` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tbl_groups`
--

INSERT INTO `tbl_groups` (`id`, `title`, `slug`, `cover_image`, `group_visibility`, `description`, `group_inivitation`, `enable_review`, `enable_gallery`, `created_by`, `modified_by`, `created_at`, `modified_at`, `status`) VALUES
(13, 'Test Group', 'test-group', 'a003965dd7f8b52b26ffa166cf05.jpg', 'public', 'test description here', 1, 1, 0, 2, 0, '2018-01-03 18:08:59', NULL, 0),
(14, 'Technical Group', 'technical-group', '876505beccf95e005921482ba2ac.jpg', 'public', 'Technical discussion here', 1, 1, 0, 2, 0, '2018-01-03 18:14:46', NULL, 0),
(15, 'Public Group - Testing', 'public-group-testing', '324c9335e6d86d941ca947b12d5d.jpg', 'public', 'Public group description goes here.', 1, 0, 0, 3, 0, '2018-01-24 15:08:11', NULL, 0),
(17, 'New grp', 'new-grp', '408644f2390d793429d6459b3cf1.png', 'public', 'kajskldf', 1, 1, 0, 3, 0, '2018-02-06 18:07:57', NULL, 0),
(18, 'Fit4site main group', 'fit4site-main-group', 'd9ebfe70d55d9dd08708b1acf77d.jpg', 'public', 'All members of the site welcome to discuss construction topics.', 1, 0, 1, 11, 0, '2018-02-14 16:38:50', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group_members`
--

CREATE TABLE IF NOT EXISTS `tbl_group_members` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `leader_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_mod` tinyint(1) NOT NULL DEFAULT '0',
  `is_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `is_banned` tinyint(1) NOT NULL DEFAULT '0',
  `invite_sent` tinyint(1) NOT NULL DEFAULT '0',
  `comments` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=108 ;

--
-- Dumping data for table `tbl_group_members`
--

INSERT INTO `tbl_group_members` (`id`, `group_id`, `leader_id`, `user_id`, `is_admin`, `is_mod`, `is_confirmed`, `is_banned`, `invite_sent`, `comments`) VALUES
(2, 17, 3, 3, 1, 0, 0, 0, 0, NULL),
(3, 18, 11, 11, 1, 0, 0, 0, 0, NULL),
(82, 18, NULL, 3, 0, 0, 0, 0, 0, NULL),
(87, 13, NULL, 2, 0, 0, 0, 0, 0, NULL),
(89, 13, NULL, 4, 0, 0, 0, 0, 0, NULL),
(95, 13, NULL, 3, 0, 0, 0, 0, 0, NULL),
(96, 14, NULL, 3, 0, 0, 0, 0, 0, NULL),
(103, 15, NULL, 2, 0, 0, 0, 0, 0, NULL),
(104, 13, NULL, 6, 0, 0, 0, 0, 0, NULL),
(105, 13, NULL, 7, 0, 0, 0, 0, 0, NULL),
(106, 14, NULL, 6, 0, 0, 0, 0, 0, NULL),
(107, 14, NULL, 2, 0, 0, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group_posts`
--

CREATE TABLE IF NOT EXISTS `tbl_group_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_type` varchar(150) NOT NULL,
  `post_desc` text NOT NULL,
  `group_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `attachment` text NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `tbl_group_posts`
--

INSERT INTO `tbl_group_posts` (`id`, `post_type`, `post_desc`, `group_id`, `user_id`, `attachment`, `time`) VALUES
(4, '', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.', 13, 3, '', '1519291315'),
(6, 'image/jpeg', ' Lorem Ipsum is not simply random text. ', 13, 3, 'back-appsens.jpg', '1519292196'),
(7, 'video/mp4', 'This is Video about text.', 13, 3, 'videoplayback.mp4', '1519292220'),
(10, 'image/jpeg', 'Hey Team, you know this is main group.', 18, 3, 'bedroom-blue.jpg', '1519298936'),
(15, 'application/pdf', 'PDF checking Post', 13, 6, 'ILC-Brochure.pdf', '1519362768'),
(18, 'image/jpeg', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.', 13, 3, '442972-river-landscape-Banff_National_Park-748x4213.jpg', '1519366768'),
(19, 'image/jpeg', 'hey This is Group.', 15, 3, 'train.jpg', '1519369446'),
(23, 'image/gif', '', 14, 3, 'image_1173785.gif', '1519392849'),
(24, '', 'Hello', 18, 11, '', '1519475755'),
(25, 'video/mp4', 'Birds...', 13, 2, 'videoplayback1.mp4', '1520309901'),
(26, 'image/jpeg', 'Its a Beautiful Day', 13, 4, 'electus-parrot.jpg', '1520313465'),
(27, 'image/jpeg', 'Wonderful innings.', 18, 3, '235819.jpg', '1520317562'),
(29, 'image/jpeg', 'Cricket Fans!', 13, 3, '235819.jpg', '1520396872'),
(31, 'image/jpeg', 'Hey I am Testing.', 13, 2, 'homepage-default-banner.jpg', '1520425380'),
(32, 'image/jpeg', 'Hello, This is a title/heading', 15, 2, 'tr.jpg', '1520425918'),
(33, 'image/jpeg', 'Ocean Beach', 13, 3, 'OceanTrashBelow.jpg', '1520576376'),
(34, 'image/jpeg', 'My Favourite', 13, 6, 'minyonok-elozetes.jpg', '1520578418');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_individual_docs`
--

CREATE TABLE IF NOT EXISTS `tbl_individual_docs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `doc_type` varchar(255) NOT NULL,
  `doc_visibilty` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_individual_docs`
--

INSERT INTO `tbl_individual_docs` (`id`, `user_id`, `title`, `description`, `doc_type`, `doc_visibilty`, `created_at`, `updated_at`) VALUES
(1, 3, 'Custom Gallery', 'Lorem ipsum is simple dummy text which is use in most of websites for developement purpose.asdf', 'photo', 'adminonly', '2018-02-23 11:41:47', NULL),
(2, 3, 'Why we use it?', 's simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the reledfgsdfase of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Loremfdgsdfgdfg', 'document', 'public', '2018-02-23 11:47:23', NULL),
(3, 3, 'Third F4S Document Here', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\n\n\n', 'document', 'public', '2018-02-23 11:53:11', NULL),
(4, 2, 'Individual Gallery', 'Gallery description goes here', 'photo', 'public', '2018-03-13 10:24:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_individual_docs_meta`
--

CREATE TABLE IF NOT EXISTS `tbl_individual_docs_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_id` int(11) NOT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `image_type` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_individual_docs_meta`
--

INSERT INTO `tbl_individual_docs_meta` (`id`, `doc_id`, `filename`, `image_type`, `user_id`) VALUES
(2, 1, 'fluimalv_3d_2014_1424384229.png', 'image/png', 3),
(3, 1, 'acugen_pack_3d_1501797262.png', 'image/png', 3),
(4, 2, 'sample.pdf', 'application/pdf', 3),
(5, 3, 'sample.doc', 'application/msword', 3),
(6, 1, 'restaurant2.jpg', 'image/jpeg', 3),
(8, 2, 'restaurant3.jpg', 'image/jpeg', 3),
(9, 3, 'fluimalv_3d_2014_14243842291.png', 'image/png', 3),
(11, 4, 'pink-rose-garden-wallpaper-456416.jpg', 'image/jpeg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items`
--

CREATE TABLE IF NOT EXISTS `tbl_items` (
  `itemId` int(11) NOT NULL AUTO_INCREMENT,
  `itemHeader` varchar(512) NOT NULL COMMENT 'Heading',
  `itemSub` varchar(1021) NOT NULL COMMENT 'sub heading',
  `itemDesc` text COMMENT 'content or description',
  `itemImage` varchar(80) DEFAULT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedDtm` datetime DEFAULT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`itemId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_items`
--

INSERT INTO `tbl_items` (`itemId`, `itemHeader`, `itemSub`, `itemDesc`, `itemImage`, `isDeleted`, `createdBy`, `createdDtm`, `updatedDtm`, `updatedBy`) VALUES
(1, 'jquery.validation.js', 'Contribution towards jquery.validation.js', 'jquery.validation.js is the client side javascript validation library authored by Jörn Zaefferer hosted on github for us and we are trying to contribute to it. Working on localization now', 'validation.png', 0, 1, '2015-09-02 00:00:00', NULL, NULL),
(2, 'CodeIgniter User Management', 'Demo for user management system', 'This the demo of User Management System (Admin Panel) using CodeIgniter PHP MVC Framework and AdminLTE bootstrap theme. You can download the code from the repository or forked it to contribute. Usage and installation instructions are provided in ReadMe.MD', 'cias.png', 0, 1, '2015-09-02 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobs`
--

CREATE TABLE IF NOT EXISTS `tbl_jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_title` varchar(255) DEFAULT NULL,
  `job_description` text,
  `job_short_description` text,
  `annual_salary` int(11) DEFAULT NULL,
  `experience` varchar(255) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `skills` text,
  `job_category_id` int(11) DEFAULT NULL,
  `job_type_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `company_logo` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `posted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_jobs`
--

INSERT INTO `tbl_jobs` (`id`, `job_title`, `job_description`, `job_short_description`, `annual_salary`, `experience`, `qualification`, `skills`, `job_category_id`, `job_type_id`, `company_id`, `location`, `featured_image`, `company_logo`, `lat`, `lng`, `posted_by`, `created_at`) VALUES
(5, 'Php Developer', '<p>Google is and always will be an engineering company. We hire people with a broad set of technical skills who are ready to tackle some of technology&#39;s greatest challenges and make an impact on millions, if not billions, of users. At Google, engineers not only revolutionize search, they routinely work on massive scalability and storage solutions, large-scale applications and entirely new platforms for developers around the world. From AdWords to Chrome, Android to YouTube, Social to Local, Google engineers are changing the world one technological achievement after another.</p>\n\n<h2>Responsibilities</h2>\n\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non.</p>\n\n<ul>\n	<li>Build next-generation web applications with a focus on the client side.</li>\n	<li>Redesign UI&#39;s, implement new UI&#39;s, and pick up Java as necessary.</li>\n	<li>Explore and design dynamic and compelling consumer experiences.</li>\n	<li>Design and build scalable framework for web applications.</li>\n</ul>\n\n<p>&nbsp;</p>\n\n<h2>Minimum qualifications</h2>\n\n<ul>\n	<li>BA/BS degree in a technical field or equivalent practical experience.</li>\n	<li>2 years of relevant work experience in software development.</li>\n	<li>Programming experience in C, C++ or Java.</li>\n	<li>Experience with AJAX, HTML and CSS.</li>\n</ul>\n', 'Php Developer Job Short Description', 680000, '3 Years', 'B. Tech', 'php,codeigniter,laravel', 9, 2, 4, 'Noida', 'e703c4b2ba83ace109df5ae55815.jpg', 'ad08eda72800c29ddeb7e1c646ab.jpg', '17.3983774', '17.3983774', 1, '2017-11-02 11:37:31'),
(6, 'SEO', '<p>Google is and always will be an engineering company. We hire people with a broad set of technical skills who are ready to tackle some of technology&#39;s greatest challenges and make an impact on millions, if not billions, of users. At Google, engineers not only revolutionize search, they routinely work on massive scalability and storage solutions, large-scale applications and entirely new platforms for developers around the world. From AdWords to Chrome, Android to YouTube, Social to Local, Google engineers are changing the world one technological achievement after another.</p>\n\n<h2>Responsibilities</h2>\n\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non.</p>\n\n<ul>\n	<li>Build next-generation web applications with a focus on the client side.</li>\n	<li>Redesign UI&#39;s, implement new UI&#39;s, and pick up Java as necessary.</li>\n	<li>Explore and design dynamic and compelling consumer experiences.</li>\n	<li>Design and build scalable framework for web applications.</li>\n</ul>\n\n<p>&nbsp;</p>\n\n<h2>Minimum qualifications</h2>\n\n<ul>\n	<li>BA/BS degree in a technical field or equivalent practical experience.</li>\n	<li>2 years of relevant work experience in software development.</li>\n	<li>Programming experience in C, C++ or Java.</li>\n	<li>Experience with AJAX, HTML and CSS.</li>\n</ul>\n\n<p>&nbsp;</p>\n', 'DESC', 280000, '4 Years', 'Msc', 'SEO,PPC', 9, 2, 4, 'DELHI', 'cc33622f7b33fa73009dfd9ad989.jpg', 'cc33622f7b33fa73009dfd9ad9891.jpg', '17.3983774', '17.3983774', 1, '2017-11-13 11:29:56'),
(7, 'Marketing Job', '<p>Google is and always will be an engineering company. We hire people with a broad set of technical skills who are ready to tackle some of technology&#39;s greatest challenges and make an impact on millions, if not billions, of users. At Google, engineers not only revolutionize search, they routinely work on massive scalability and storage solutions, large-scale applications and entirely new platforms for developers around the world. From AdWords to Chrome, Android to YouTube, Social to Local, Google engineers are changing the world one technological achievement after another.</p>\n\n<h2>Responsibilities</h2>\n\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non.</p>\n\n<ul>\n	<li>Build next-generation web applications with a focus on the client side.</li>\n	<li>Redesign UI&#39;s, implement new UI&#39;s, and pick up Java as necessary.</li>\n	<li>Explore and design dynamic and compelling consumer experiences.</li>\n	<li>Design and build scalable framework for web applications.</li>\n</ul>\n\n<p>&nbsp;</p>\n\n<h2>Minimum qualifications</h2>\n\n<ul>\n	<li>BA/BS degree in a technical field or equivalent practical experience.</li>\n	<li>2 years of relevant work experience in software development.</li>\n	<li>Programming experience in C, C++ or Java.</li>\n	<li>Experience with AJAX, HTML and CSS.</li>\n</ul>\n\n<p>&nbsp;</p>\n\n<h2>&nbsp;</h2>\n', 'desc', 580000, '3 Years', 'B.tech', 'Business Developer', 9, 1, 5, 'noida', '757198ed05c0e08dfebf94f824f6.jpg', '757198ed05c0e08dfebf94f824f61.jpg', '17.3983774', '17.3983774', 1, '2017-11-13 11:31:25'),
(8, 'Web Developer', '<p>Test Description</p>\n', 'We are in the process to hire a HR', 250000, '2 Years', 'MBA in HR and Management', 'php,nodejs,javascript,ajax', 4, 2, 6, 'Block B, Sector 16, Noida, Uttar Pradesh 201301, India', 'e3463c544b2c51ab48597f1adf43.png', NULL, '28.5785768', '77.31726819999994', 6, '2017-11-23 06:25:53'),
(10, 'Business Developer', '<p>Job long description.</p>\n', 'Business Developer', 258880, '4', 'MBA (Marketing and HR)', 'sales', 1, 2, 5, 'Uppal, Hyderabad, Telangana, India', '7674681944f4bc9a401ed241170a.jpg', NULL, '17.3983774', '78.55826520000005', 6, '2017-12-08 09:05:25'),
(11, 'SEO', 'asdfasdfadf', 'SMO', 500000, '4', 'BCA,MCA,B.Tech,Bsc', 'seo,ppc', 9, 2, 5, 'Noida Phase-2, Noida, Uttar Pradesh 201305, India', '0d8e7242a5ae4f44b52e72a05c65.png', NULL, '28.5324428', '77.40522290000001', 6, '2017-12-27 12:50:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_categories`
--

CREATE TABLE IF NOT EXISTS `tbl_job_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_job_categories`
--

INSERT INTO `tbl_job_categories` (`id`, `name`, `status`) VALUES
(1, 'Accounting/Finance', 1),
(2, 'Health Care', 1),
(3, 'Automaotive', 1),
(4, 'Education', 1),
(5, 'Transporation/Logistics', 1),
(6, 'Restaurant/Food Service', 1),
(7, 'Art/Multimedia', 1),
(8, 'Construction/Faculties', 1),
(9, 'IT Software', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_types`
--

CREATE TABLE IF NOT EXISTS `tbl_job_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_job_types`
--

INSERT INTO `tbl_job_types` (`id`, `name`, `status`) VALUES
(1, 'Freelance', 1),
(2, 'Full Time', 1),
(3, 'Internship', 1),
(4, 'Part Time', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

CREATE TABLE IF NOT EXISTS `tbl_messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_to` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `message` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Read','Unread') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unread',
  `star_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `attached_file` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_received` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=45 ;

--
-- Dumping data for table `tbl_messages`
--

INSERT INTO `tbl_messages` (`msg_id`, `user_to`, `user_from`, `message`, `status`, `star_status`, `attached_file`, `date_received`, `deleted`) VALUES
(41, 3, 2, 'message 1', 'Unread', 'unstarred', NULL, '2018-02-14 18:04:47', 'No'),
(42, 2, 3, 'Message 2', 'Unread', 'starred', NULL, '2018-02-14 18:05:10', 'No'),
(43, 2, 3, 'Message 3', 'Unread', 'unstarred', NULL, '2018-02-14 18:05:29', 'No'),
(44, 10, 11, 'Test f4s', 'Unread', '', '08e7c0bf86f72340cb832524febd.jpg', '2018-02-20 20:25:54', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message_conversation`
--

CREATE TABLE IF NOT EXISTS `tbl_message_conversation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_id` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `reply_messages` text NOT NULL,
  `sent_date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_message_conversation`
--

INSERT INTO `tbl_message_conversation` (`id`, `message_id`, `user_from`, `user_to`, `reply_messages`, `sent_date`) VALUES
(1, 41, 3, 2, 'test', '2018-02-19 17:28:02'),
(2, 41, 3, 2, 'hi', '2018-02-19 17:51:16'),
(3, 41, 3, 2, 'asdfasdfasdfasdf', '2018-02-19 17:58:37'),
(4, 41, 3, 2, 'dfadf', '2018-02-21 19:03:50'),
(5, 44, 10, 11, 'Hello', '2018-03-08 17:38:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_portfolio`
--

CREATE TABLE IF NOT EXISTS `tbl_portfolio` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `image_url` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_portfolio`
--

INSERT INTO `tbl_portfolio` (`id`, `title`, `description`, `image_url`, `user_id`, `is_deleted`, `created_at`, `updated_at`) VALUES
(2, 'Portfolio first', '<p>Portfolio First Description1</p>\n', '6a700ffd15c495906716836f48bf.png', 2, 0, '2017-10-30 07:55:19', '2017-10-30 07:55:19'),
(6, 'Admin - Portfolio 1', 'DESC', '269dc08de16790cd8876818b69b3.jpg', 1, 0, '2017-10-30 12:42:19', '2017-10-30 12:42:19'),
(7, 'Portfolio 2', 'Desc 2', '65d779110653bfee80070775a3b1.png', 1, 0, '2017-11-06 10:04:47', '2017-11-06 10:04:47'),
(8, 'portfolio 3', 'DESC 3', '3d92a1fad20785c7d4b38dcdb5d3.jpg', 1, 0, '2017-11-06 10:05:30', '2017-11-06 10:05:30'),
(9, 'portfolio 4', 'Desc 4', 'f6ccf6d5bafbbb05529f2e4ceaf7.jpg', 1, 0, '2017-11-06 10:06:18', '2017-11-06 10:06:18'),
(10, 'portfolio 5', 'desc 5', '57f164de0e5a1fac7aa5ba0ac425.jpg', 1, 0, '2017-11-06 10:07:03', '2017-11-06 10:07:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post_comment`
--

CREATE TABLE IF NOT EXISTS `tbl_post_comment` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `post_id` int(100) NOT NULL,
  `group_id` int(100) NOT NULL,
  `member_id` int(100) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `tbl_post_comment`
--

INSERT INTO `tbl_post_comment` (`id`, `post_id`, `group_id`, `member_id`, `comment`) VALUES
(12, 18, 13, 2, 'Wonder full It is very beautiful.'),
(13, 18, 13, 3, 'Testing...'),
(15, 25, 13, 3, 'Its a Beautiful day... :-)'),
(16, 26, 13, 4, 'Amazing Works for me !!! ... '),
(17, 26, 13, 3, 'Yes it is also for me.'),
(18, 7, 13, 3, 'beautiful Video :D'),
(19, 27, 18, 3, 'Bowled :-)'),
(20, 27, 18, 3, 'Great Pitch and bowling.'),
(21, 26, 13, 2, 'Nice Picture'),
(22, 26, 13, 3, 'Thanks individual'),
(23, 26, 13, 3, 'test'),
(24, 28, 13, 3, 'Are you bot?'),
(25, 29, 13, 3, 'Hey'),
(26, 30, 13, 3, 'hey'),
(27, 31, 13, 2, 'hello'),
(28, 26, 13, 6, 'Really Cool '),
(29, 34, 13, 3, 'Nice'),
(30, 33, 13, 3, 'nice'),
(31, 26, 13, 3, 'test'),
(32, 26, 13, 3, 'test\\'),
(33, 26, 13, 3, 'test'),
(34, 34, 13, 3, 'wow');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post_likes`
--

CREATE TABLE IF NOT EXISTS `tbl_post_likes` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `group_id` int(100) NOT NULL,
  `post_id` int(100) NOT NULL,
  `member_id` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `tbl_post_likes`
--

INSERT INTO `tbl_post_likes` (`id`, `group_id`, `post_id`, `member_id`) VALUES
(7, 13, 15, 3),
(15, 18, 7, 3),
(28, 18, 24, 3),
(30, 13, 6, 3),
(32, 13, 7, 3),
(33, 13, 25, 2),
(35, 13, 25, 3),
(36, 13, 25, 4),
(37, 13, 18, 4),
(38, 13, 26, 4),
(41, 14, 23, 3),
(42, 18, 27, 3),
(43, 13, 26, 2),
(44, 13, 18, 2),
(45, 13, 7, 2),
(46, 13, 4, 2),
(47, 13, 26, 3),
(49, 18, 24, 11),
(51, 13, 28, 3),
(52, 13, 29, 3),
(53, 13, 30, 3),
(54, 13, 31, 2),
(55, 13, 30, 2),
(56, 13, 33, 3),
(57, 13, 26, 6),
(58, 13, 34, 3),
(59, 18, 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE IF NOT EXISTS `tbl_products` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(255) DEFAULT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_description` text,
  `product_long_description` text,
  `additional` text,
  `product_price` double NOT NULL,
  `product_type` int(1) NOT NULL,
  `product_image` varchar(5000) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sub_category_id` varchar(500) NOT NULL,
  `store_id` int(10) DEFAULT NULL,
  `related_product` varchar(200) DEFAULT NULL,
  `quantity` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `gross_amount` varchar(255) NOT NULL,
  `net` varchar(255) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `product_code`, `product_name`, `product_description`, `product_long_description`, `additional`, `product_price`, `product_type`, `product_image`, `category_id`, `sub_category_id`, `store_id`, `related_product`, `quantity`, `discount`, `gross_amount`, `net`, `created_date`, `created_by`, `modified_date`, `modified_by`, `status`) VALUES
(15, '928137641297583', 'product 5', 'asdfasdf', 'sdfgsdf', 'sfdgsdf', 45, 1, 'b88ce612de589002c3bfba3bc48f.jpg', 8, '', 3, NULL, '5', '2', '225.00', '220.50', '2017-12-07 03:24:10', 4, '2017-12-07 03:24:10', 4, '0'),
(16, '257961300923288', 'Product10', 'product 10 description', 'long description', 'additional content', 4, 1, 'd18e245708ccee94befe140dc6be.png', 8, '', 3, NULL, '1', '0', '4.00', '4.00', '2018-01-22 11:42:32', 4, '2018-01-22 11:42:32', 4, '0'),
(17, '423165017913795', 'Product11', 'sadf', 'asdf', 'asdf', 45, 1, '9dbe9162934f3532d24705317640.jpg', 8, '', 3, '', '1', '0', '45.00', '45.00', '2017-11-23 02:41:29', 4, '2017-11-23 02:41:29', 4, '0'),
(18, '479667810791762', 'Popcorn', 'Popcorn description', 'Popcorn long description', 'Popcorn additional description', 15, 1, 'dee2b2cb03759bb85c3f5a3de278.png', 8, '', 3, '', '2', '0', '30.00', '30.00', '2017-12-04 02:39:04', 4, '2017-12-04 02:39:04', 4, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reset_password`
--

CREATE TABLE IF NOT EXISTS `tbl_reset_password` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `activation_id` varchar(32) NOT NULL,
  `agent` varchar(512) NOT NULL,
  `client_ip` varchar(32) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` bigint(20) NOT NULL DEFAULT '1',
  `createdDtm` datetime NOT NULL,
  `updatedBy` bigint(20) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_reset_password`
--

INSERT INTO `tbl_reset_password` (`id`, `email`, `activation_id`, `agent`, `client_ip`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'admin@gmail.com', 'zMVt93REFoPubi6', 'Chrome 61.0.3163.100', '0.0.0.0', 0, 1, '2017-10-31 14:03:32', NULL, NULL),
(2, 'admin@gmail.com', '6T9a9ecgMISRc5s', 'Chrome 61.0.3163.100', '0.0.0.0', 0, 1, '2017-11-22 23:27:30', NULL, NULL),
(3, 'ankit.jain@infiniteloopindia.com', '7ErSI9WHZJCkNji', 'Chrome 61.0.3163.100', '0.0.0.0', 0, 1, '2017-11-23 00:02:25', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE IF NOT EXISTS `tbl_roles` (
  `roleId` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'role id',
  `role` varchar(50) NOT NULL COMMENT 'role text',
  PRIMARY KEY (`roleId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`roleId`, `role`) VALUES
(1, 'System Administrator'),
(2, 'Individual'),
(3, 'Client'),
(4, 'Supplier'),
(5, 'Company');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales`
--

CREATE TABLE IF NOT EXISTS `tbl_sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `buyer_name` varchar(100) NOT NULL,
  `cash_discount` int(11) NOT NULL,
  `grand_amount` double NOT NULL,
  `description` varchar(250) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_by` int(11) NOT NULL,
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `total_quantity` int(11) NOT NULL,
  `shipped_status` int(11) NOT NULL COMMENT 'orderpace=0,',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_sales`
--

INSERT INTO `tbl_sales` (`id`, `buyer_name`, `cash_discount`, `grand_amount`, `description`, `status`, `created_by`, `issue_date`, `due_date`, `total_quantity`, `shipped_status`) VALUES
(6, '', 0, 54, '', 'active', 0, '2017-12-05', '0000-00-00', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales_detail`
--

CREATE TABLE IF NOT EXISTS `tbl_sales_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `selling_rate` double NOT NULL,
  `discount` int(2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `individual_shipped_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_sales_detail`
--

INSERT INTO `tbl_sales_detail` (`id`, `sale_id`, `product_code`, `selling_rate`, `discount`, `quantity`, `product_price`, `created_by`, `individual_shipped_status`) VALUES
(6, 6, '257961300923288', 0, 0, 1, 4, 4, 0),
(7, 6, '423165017913795', 0, 0, 1, 45, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategory`
--

CREATE TABLE IF NOT EXISTS `tbl_subcategory` (
  `subcat_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_category_id` int(11) NOT NULL,
  `subcategory_name` varchar(255) DEFAULT NULL,
  `image` varchar(500) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`subcat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_subcategory`
--

INSERT INTO `tbl_subcategory` (`subcat_id`, `parent_category_id`, `subcategory_name`, `image`, `created_by`, `modified_by`, `modified_date`, `created_date`, `status`) VALUES
(8, 8, 'Sub Category1', '4603dfa08057644d9f65a890517f.png', 1, 1, '2017-11-21 13:05:05', '2017-11-21 12:56:14', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL COMMENT 'login email',
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(128) NOT NULL COMMENT 'hashed login password',
  `name` varchar(128) DEFAULT NULL COMMENT 'full name of user',
  `profile_image` varchar(255) DEFAULT NULL,
  `cover_image` varchar(100) NOT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `roleId` tinyint(4) NOT NULL,
  `online_status` tinyint(1) NOT NULL DEFAULT '0',
  `availablity_status` enum('public','adminsonly','loggedin') NOT NULL,
  `on_call_status` enum('public','adminsonly','loggedin') NOT NULL,
  `website_status` enum('public','adminsonly','loggedin') NOT NULL,
  `email_status` enum('public','adminsonly','loggedin') NOT NULL,
  `about_status` enum('public','adminsonly','loggedin') NOT NULL,
  `last_login_date` text,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` int(11) DEFAULT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL,
  `education` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `skills` varchar(200) NOT NULL,
  `notes` varchar(150) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `email`, `username`, `password`, `name`, `profile_image`, `cover_image`, `mobile`, `roleId`, `online_status`, `availablity_status`, `on_call_status`, `website_status`, `email_status`, `about_status`, `last_login_date`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`, `education`, `location`, `lat`, `lng`, `skills`, `notes`) VALUES
(1, 'admin@gmail.com', 'admin', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', 'Administrator', NULL, '', '9890098900', 1, 1, 'public', 'public', 'public', 'public', 'public', '2018-01-19 06:35:51 PM', 0, 0, '2015-07-01 18:56:49', 1, '2017-03-03 12:08:39', '', '', NULL, NULL, '', ''),
(2, 'individual@gmail.com', 'individual', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', 'Small Business', '534c492dd87ccb2f63ef7e31de5f.jpg', 'bb1ac87d32e036a27503738de705.jpg', '9890098900', 2, 1, 'public', 'public', 'public', 'public', 'public', '2018-03-13 03:23:34 PM', 0, 1, '2017-12-04 17:49:56', 1, '2017-02-10 17:23:53', '', 'Block 1, WEA, Karol Bagh, New Delhi, Delhi 110060, India', '28.6439801', '77.1884354', '', 'About us content goes here'),
(3, 'girjesh@infiniteloopcorp.com', 'client', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', 'Client', '47671feeb187a23288ede878100b.png', 'cfb587163649b17d5e170255ff42.jpg', '9812345678', 3, 1, 'loggedin', 'public', 'public', 'adminsonly', 'public', '2018-03-12 09:48:26 AM', 0, 1, '2017-12-04 17:49:56', NULL, NULL, 'B.tech', 'Sector 101, Noida, Uttar Pradesh 201304, India', '28.5375667', '77.38371039999993', 'PHP', 'I am php developer'),
(4, 'supplier@gmail.com', 'supplier', '$2y$10$EZzSikKGp/HZdqGAOFtRFufyYKgrh9gLK5NFdy/y4tJGhvMRSQc5S', 'Supplier', '3d9e765561545e97f72a23384e7d.png', '', '1234567890', 4, 0, 'public', 'public', 'public', 'public', 'public', '2018-03-06 10:46:07 AM', 0, 1, '2017-10-30 17:09:01', 1, '2017-10-30 18:13:17', '', '', '', '', '', ''),
(6, 'company@gmail.com', 'company', '$2y$10$FIWVTHbhxp.geGl1meAGze3VPQFEbfSnR92h1KrX/qphCV/3S8YQm', 'Company', 'people.png', '', '1234567890', 5, 0, 'public', 'public', 'public', 'public', 'public', '2018-03-12 01:37:26 PM', 0, 0, '2017-10-31 10:59:49', 1, '2017-11-06 10:53:01', '', '', '', '', '', ''),
(7, 'ankit.jain@infiniteloopindia.com', 'ankit', '$2y$10$gGeolTTF3Pgx0s7veaXTsOPVAyCl6WzlnPowIoykfdPiU.T5wv1pa', 'Ankit Jain', NULL, '', '9718843015', 2, 1, 'public', 'public', 'public', 'public', 'public', NULL, 0, 0, '2017-11-22 22:22:30', NULL, NULL, '', '', NULL, NULL, '', ''),
(8, 'anniankit2010@gmail.com', NULL, '$2y$10$L1TW8DFr2EMfzenWff.mH.eRWEiYG12d0gbMwwGFAnzzHOy9emVZ2', 'Ankit Jain', NULL, '', '9718843015', 4, 0, 'public', 'public', 'public', 'public', 'public', NULL, 0, 0, '2017-11-22 22:41:18', NULL, NULL, '', '', NULL, NULL, '', ''),
(9, 'gargjainankit@gmail.com', NULL, '$2y$10$XP3Jr6I37jEQ8P5JIdmFbOGHxtufT5e8F4ha8T7yphxqu8xb3.15a', 'Ankit Jain', NULL, '', '9718843015', 3, 0, 'public', 'public', 'public', 'public', 'public', NULL, 0, 0, '2017-11-22 22:53:06', NULL, NULL, '', '', NULL, NULL, '', ''),
(10, 'chrisbsfs@aol.com', NULL, '$2y$10$9XZ9dI0LLUFn9r5Upalto.zrDRG/8IDEa4rqbX.bolkGSgSGE4lnC', 'Chris M', '', '', '07809153356', 4, 0, 'public', 'public', 'public', 'public', 'public', '2018-03-08 05:36:22 PM', 0, 0, '2017-12-07 03:11:07', NULL, NULL, '', '', '', '', '', ''),
(11, 'fit4site1@gmail.com', NULL, '$2y$10$IuXvX2Fuid2Z6co38KWWhusJhCySA.aEqrguR5pycYW6Hp0YfTMaW', 'Chris Moody', '200bd964be3055756c28bfd793b0.jpg', 'bfc62a80298e2a0322e556fc25ec.JPG', '07809153356', 2, 1, 'public', 'public', 'public', 'public', 'public', '2018-03-13 04:36:40 PM', 0, 0, '2017-12-07 03:21:09', NULL, NULL, 'NVQ level 2', 'Leeds, UK', '53.8007554', '-1.5490773999999874', 'joiner/shopfitter', 'From Leeds previous joiner');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_business_details`
--

CREATE TABLE IF NOT EXISTS `tbl_user_business_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_title` varchar(255) DEFAULT NULL,
  `about_us` text,
  `contact_us` text,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_user_business_details`
--

INSERT INTO `tbl_user_business_details` (`id`, `business_title`, `about_us`, `contact_us`, `user_id`, `status`) VALUES
(2, 'Ankit Cement Supplier', '<p>test</p>\n', 'test', 8, 0),
(3, 'Store ', '<p>Store 1 Description</p>\n', 'store contact us', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_follow`
--

CREATE TABLE IF NOT EXISTS `tbl_user_follow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `leader_id` int(11) DEFAULT NULL,
  `subscribed_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=93 ;

--
-- Dumping data for table `tbl_user_follow`
--

INSERT INTO `tbl_user_follow` (`id`, `user_id`, `leader_id`, `subscribed_at`) VALUES
(75, 2, 1, '2018-01-19 11:32:43'),
(76, 2, 3, '2018-01-19 01:44:13'),
(83, 3, 11, '2018-02-23 02:19:04'),
(84, 10, 11, '2018-03-08 05:38:22'),
(85, 3, 8, '2018-03-12 12:33:13'),
(89, 6, 3, '2018-03-12 01:45:47'),
(90, 3, 2, '2018-03-12 04:56:24'),
(91, 3, 7, '2018-03-12 05:14:36'),
(92, 3, 6, '2018-03-12 05:47:11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wall_post`
--

CREATE TABLE IF NOT EXISTS `tbl_wall_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_type` varchar(150) NOT NULL,
  `post_desc` text NOT NULL,
  `wall_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `attachment` text NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_wall_post`
--

INSERT INTO `tbl_wall_post` (`id`, `post_type`, `post_desc`, `wall_id`, `user_id`, `attachment`, `time`) VALUES
(2, 'image/jpeg', 'This is My Wall.', 3, 3, '10.jpg', '1520830866'),
(4, 'image/jpeg', 'My Interior Wall is great design.', 3, 3, 'bussiness.jpg', '1520832805'),
(5, 'image/jpeg', 'Great Wall !!! ...', 3, 6, 'slide1.jpg', '1520833275'),
(6, '', 'Hey Everyone', 2, 2, '', '1520839745'),
(7, 'image/jpeg', 'Cool Website.', 2, 3, '25.JPG', '1520854032'),
(8, 'video/mp4', 'Great Work', 3, 3, 'videoplayback.mp4', '1520856633'),
(9, 'text/html', '', 3, 3, 'old.js', '1520856674'),
(10, 'image/jpeg', 'Interior Wall', 3, 3, 'bedroom3.jpg', '1520856730');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wall_post_comment`
--

CREATE TABLE IF NOT EXISTS `tbl_wall_post_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(100) NOT NULL,
  `wall_id` int(100) NOT NULL,
  `member_id` int(100) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_wall_post_comment`
--

INSERT INTO `tbl_wall_post_comment` (`id`, `post_id`, `wall_id`, `member_id`, `comment`) VALUES
(1, 5, 3, 3, 'Testing...'),
(2, 5, 3, 2, 'Yes now it is working...'),
(3, 2, 3, 3, 'Hey Team !'),
(4, 6, 2, 3, 'Hi'),
(5, 6, 2, 3, 'Hello'),
(6, 6, 2, 2, 'hey'),
(7, 6, 2, 3, 'HEllo'),
(8, 7, 2, 3, 'nice website'),
(9, 6, 2, 3, 'Everything is working fine now :-)');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wall_post_likes`
--

CREATE TABLE IF NOT EXISTS `tbl_wall_post_likes` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `wall_id` int(100) NOT NULL,
  `post_id` int(100) NOT NULL,
  `member_id` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tbl_wall_post_likes`
--

INSERT INTO `tbl_wall_post_likes` (`id`, `wall_id`, `post_id`, `member_id`) VALUES
(2, 3, 2, 3),
(4, 3, 4, 3),
(5, 3, 5, 3),
(6, 3, 5, 2),
(7, 3, 2, 2),
(8, 2, 6, 2),
(10, 0, 6, 3),
(11, 2, 7, 3),
(12, 2, 6, 3),
(14, 3, 9, 3),
(15, 3, 10, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
