-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 10, 2012 at 10:13 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_albums`
--

CREATE TABLE IF NOT EXISTS `tbl_albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `directory` varchar(50) NOT NULL,
  `about` text NOT NULL,
  `date_modified` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_albums`
--

INSERT INTO `tbl_albums` (`id`, `author`, `name`, `directory`, `about`, `date_modified`, `date_created`) VALUES
(2, 1, 'My Photos', 'my-photos', 'The default my photos album.', '2012-01-19 17:17:40', '2012-01-19 17:17:40'),
(3, 8, 'My Photos', 'my-photos', 'The default my photos album', '2012-01-31 12:07:38', '2012-01-31 12:07:38'),
(6, 12, 'My Photos', 'my-photos', 'The default my photos album', '2012-02-01 20:11:26', '2012-02-01 20:11:26'),
(7, 13, 'My Photos', 'my-photos', 'The default my photos album', '2012-02-09 11:37:39', '2012-02-09 11:37:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_articles`
--

CREATE TABLE IF NOT EXISTS `tbl_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `keywords` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `hits` int(11) NOT NULL,
  `published` int(1) NOT NULL,
  `comments` int(1) NOT NULL,
  `date_modified` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_articles`
--

INSERT INTO `tbl_articles` (`id`, `author`, `category`, `name`, `content`, `keywords`, `description`, `hits`, `published`, `comments`, `date_modified`, `date_created`) VALUES
(1, 1, 2, 'Test Article', 'This is a test article.', 'article keywords here', 'article description here', 3, 1, 1, '2012-01-22 21:52:11', '2012-01-22 21:52:11'),
(2, 1, 3, 'PHP Tutorial', 'Basic PHP Tutorial', '', '', 0, 1, 1, '2012-01-22 22:06:32', '2012-01-22 22:06:32'),
(3, 1, 2, 'Lorem Ipsum', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse porttitor pulvinar tortor, quis varius lorem porttitor sit amet. Vestibulum nulla quam, varius in mattis sed, viverra at elit. Quisque sodales nulla vel est scelerisque et pharetra neque mollis.</p>\r\n<p>Duis adipiscing pulvinar mauris, quis facilisis risus volutpat quis. Vivamus velit quam, auctor ut semper in, commodo ac dui. Duis blandit ultricies tortor, id auctor ante auctor in. Fusce non ultricies nibh. Proin id tellus sem. Pellentesque ac felis in diam porttitor consectetur et eget sapien. Donec volutpat mauris sit amet odio adipiscing varius. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>\r\n<p>Integer sed sem lectus, a hendrerit purus. Integer euismod massa id elit ullamcorper ut vulputate dui rutrum. Integer accumsan auctor risus et ornare. Phasellus sem nunc, egestas ut iaculis non, fringilla quis tellus. Donec mollis pulvinar purus, nec ornare magna congue sed. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum arcu sem, gravida ut porta id, aliquet eget dui</p>\r\n<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean aliquet quam in arcu interdum vulputate. Etiam adipiscing molestie luctus. Sed tristique tempor ornare. Cras ligula nisl, porta sit amet pellentesque id, mattis vel mauris.</p>', 'Lorem, Ipsum', 'Lorem ipsum dolor sit amet.', 6, 1, 1, '2012-02-01 10:57:41', '2012-02-01 10:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE IF NOT EXISTS `tbl_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_category` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `notes` text NOT NULL,
  `date_modified` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`id`, `parent_category`, `name`, `notes`, `date_modified`, `date_created`) VALUES
(1, 2, 'Uncategorized', 'This is the uncategorized category.', '2012-01-19 13:20:53', '2012-01-18 17:46:54'),
(2, 0, 'Tutorials', 'The tutorials category', '2012-01-18 17:49:17', '2012-01-18 17:49:17'),
(3, 2, 'PHP', 'The PHP Tutorials category.', '2012-01-18 17:49:39', '2012-01-18 17:49:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comments`
--

CREATE TABLE IF NOT EXISTS `tbl_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` int(11) NOT NULL,
  `article` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_comments`
--

INSERT INTO `tbl_comments` (`id`, `author`, `article`, `name`, `email`, `url`, `comment`, `date_created`) VALUES
(1, 1, 3, 'Chris Pynegar', 'chris@develop21.com', '', 'This is a test comment.', '2012-02-01 14:52:13'),
(2, 1, 3, 'Chris Pynegar', 'chris@develop21.com', '', 'This is another test comment', '2012-02-01 15:18:51'),
(3, 1, 3, 'Chris Pynegar', 'chris@develop21.com', '', 'Here is another comment.', '2012-02-01 19:30:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_editors`
--

CREATE TABLE IF NOT EXISTS `tbl_editors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `directory` varchar(50) NOT NULL,
  `source` varchar(50) NOT NULL,
  `script` text NOT NULL,
  `date_installed` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_editors`
--

INSERT INTO `tbl_editors` (`id`, `name`, `directory`, `source`, `script`, `date_installed`) VALUES
(1, 'TinyMCE', 'tinymce', 'tiny_mce.js', 'tinyMCE.init({\r\n// general options\r\ntheme : "advanced",\r\nskin : "o2k7",\r\nskin_variant : "silver",\r\n//skin_variant : "black",\r\nmode : "specific_textareas",\r\neditor_selector : "editor",\r\n\r\n// plugins\r\nplugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,directionality,fullscreen,noneditable,visualchars",\r\n\r\n// theme options\r\n\r\ntheme_advanced_buttons1 : "bold,italic,underline, strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect",\r\n\r\ntheme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bulllist,numlist,|,outent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,cod,|,insertdate,inserttime,preview,|,forecolor,backcolor,|,code",\r\n\r\ntheme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespll,media,advhr,|,print,|,ltr,rtl,|,fullscreen",\r\n\r\ntheme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",\r\n\r\ntheme_advanced_toolbar_location : "top",\r\ntheme_advanced_toolbar_align : "left",\r\ntheme_advanced_statusbar_location : "bottom"\r\n});', '2011-11-25 13:57:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_friends`
--

CREATE TABLE IF NOT EXISTS `tbl_friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `confirmed` int(1) NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_friends`
--

INSERT INTO `tbl_friends` (`id`, `user1`, `user2`, `confirmed`, `date_created`) VALUES
(3, 1, 12, 0, '2012-02-08 15:12:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menus`
--

CREATE TABLE IF NOT EXISTS `tbl_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `notes` text NOT NULL,
  `date_modified` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_menus`
--

INSERT INTO `tbl_menus` (`id`, `name`, `notes`, `date_modified`, `date_created`) VALUES
(1, 'Main Menu', 'This is the main menu and cannot be deleted.', '2012-01-17 12:41:40', '2012-01-09 14:06:19'),
(2, 'Footer', 'This is the footer menu', '2012-01-09 17:47:11', '2012-01-09 17:47:11'),
(3, 'New Menu', 'This is my new menu.', '2012-02-09 11:55:35', '2012-02-09 11:55:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu_items`
--

CREATE TABLE IF NOT EXISTS `tbl_menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `alias` varchar(100) NOT NULL,
  `access` varchar(20) NOT NULL,
  `website_title` varchar(255) NOT NULL,
  `position` int(3) NOT NULL,
  `parameters` text NOT NULL,
  `date_modified` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `tbl_menu_items`
--

INSERT INTO `tbl_menu_items` (`id`, `menu`, `type`, `name`, `alias`, `access`, `website_title`, `position`, `parameters`, `date_modified`, `date_created`) VALUES
(16, 1, 2, 'Log In', 'log-in', 'public', 'Log In', 3, '', '2012-01-24 15:04:57', '2012-01-24 15:04:57'),
(1, 1, 1, 'Home', 'home', 'all', 'Develop21 Web Design and Application Development', 1, '24', '2012-01-23 20:12:02', '2012-01-23 20:12:02'),
(23, 1, 6, 'Profile List', 'profile-list', 'loggedin', 'Profile List', 5, '', '2012-01-31 11:35:44', '2012-01-31 11:35:44'),
(24, 1, 7, 'Register', 'register', 'public', 'Register', 6, '', '2012-02-01 23:23:37', '2012-02-01 23:23:37'),
(17, 1, 3, 'Profile', 'profile', 'loggedin', 'My Profile', 4, '1, 1, 1', '2012-01-25 15:30:05', '2012-01-24 16:46:43'),
(22, 1, 4, 'Tutorials', 'tutorials', 'loggedin', 'Tutorials', 2, '2, 1, 1, 1, 1', '2012-01-24 21:54:25', '2012-01-24 21:54:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu_types`
--

CREATE TABLE IF NOT EXISTS `tbl_menu_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `directory` varchar(50) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `brief` varchar(255) NOT NULL,
  `date_modified` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_menu_types`
--

INSERT INTO `tbl_menu_types` (`id`, `name`, `directory`, `alias`, `brief`, `date_modified`, `date_created`) VALUES
(1, 'Single Page View', 'content/page', 'single-page-view', 'Displays a single page.', '2012-01-16 12:58:19', '2012-01-16 12:58:19'),
(2, 'Login', 'users/login', 'login', 'Displays a login form.', '2012-01-18 15:03:16', '2012-01-18 15:03:16'),
(3, 'Profile', 'users/profile', 'profile', 'Displays a logged in users profile.', '2012-01-24 15:01:31', '2012-01-24 15:01:31'),
(4, 'Category View', 'content/category', 'category', 'Get articles from a specific category.', '2012-01-24 21:43:17', '2012-01-24 21:43:17'),
(5, 'Article', 'content/article', 'article', 'Displays a single article.', '2012-01-25 13:30:03', '2012-01-25 13:30:03'),
(6, 'Profile List', 'users/profilelist', 'profile-list', 'Displays a list of all the user profiles.', '2012-01-31 11:35:13', '2012-01-31 11:35:13'),
(7, 'Register', 'users/register', 'register', 'A user register form.', '2012-02-01 11:46:59', '2012-02-01 11:46:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

CREATE TABLE IF NOT EXISTS `tbl_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` int(11) NOT NULL,
  `recipient` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `recieved` int(1) NOT NULL,
  `date_sent` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_messages`
--

INSERT INTO `tbl_messages` (`id`, `sender`, `recipient`, `subject`, `message`, `recieved`, `date_sent`) VALUES
(1, 1, 4, 'Test Message', 'This is a test message.', 0, '2012-01-30 11:24:17'),
(2, 7, 1, 'Test Message', 'This is a test message.', 0, '2012-01-30 13:50:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_modules`
--

CREATE TABLE IF NOT EXISTS `tbl_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `directory` varchar(50) NOT NULL,
  `brief` varchar(255) NOT NULL,
  `date_modified` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_modules`
--

INSERT INTO `tbl_modules` (`id`, `name`, `directory`, `brief`, `date_modified`, `date_created`) VALUES
(1, 'Login', 'users/login', 'A user login form.', '2012-01-22 00:50:24', '2012-01-22 00:50:24'),
(2, 'Register', 'users/register', 'A user register form.', '2012-02-01 11:47:59', '2012-02-01 11:47:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_module_items`
--

CREATE TABLE IF NOT EXISTS `tbl_module_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `position` int(3) NOT NULL,
  `parameters` text NOT NULL,
  `date_modified` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_module_items`
--

INSERT INTO `tbl_module_items` (`id`, `type`, `name`, `position`, `parameters`, `date_modified`, `date_created`) VALUES
(1, 1, 'Log In', 1, '', '2012-01-26 17:05:09', '2012-01-26 17:05:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pages`
--

CREATE TABLE IF NOT EXISTS `tbl_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `published` int(1) NOT NULL,
  `date_modified` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `tbl_pages`
--

INSERT INTO `tbl_pages` (`id`, `author`, `name`, `content`, `keywords`, `description`, `published`, `date_modified`, `date_created`) VALUES
(23, 1, 'A Test Page', 'This is a test page.', '', '', 1, '2012-01-23 12:42:25', '2012-01-23 12:42:25'),
(24, 1, 'Home', '<p>This is the home page.</p>', '', '', 1, '2012-01-23 20:11:38', '2012-01-23 20:11:38'),
(25, 1, 'Format Test', '<p>Plain Test</p>\r\n<p><strong>Bold Test</strong></p>\r\n<p><em>Italic Test</em></p>\r\n<p><span style="text-decoration: underline;">Underline Test</span></p>\r\n<p><span style="text-decoration: line-through;">Strikethrough Test</span></p>\r\n<p><span style="font-family: comic sans ms,sans-serif;">Font Family Test</span></p>\r\n<p><span style="color: #00ff00;">Font Color Test</span></p>', '', '', 1, '2012-01-24 09:30:17', '2012-01-24 09:30:17'),
(20, 1, 'Test Page One', 'This is the first test page.', '', '', 1, '2012-01-23 12:41:09', '2012-01-23 12:41:09'),
(22, 1, 'Test Page Three', 'This is the third test page.', '', '', 1, '2012-01-23 12:41:37', '2012-01-23 12:41:37'),
(21, 1, 'Test Page Two', 'This is the second test page.', '', '', 1, '2012-01-23 12:41:24', '2012-01-23 12:41:24'),
(26, 1, 'My new page', '<p>This is my new page.</p>', '', '', 1, '2012-01-25 15:01:20', '2012-01-25 15:01:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permissions`
--

CREATE TABLE IF NOT EXISTS `tbl_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `access` int(3) NOT NULL,
  `date_modified` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_permissions`
--

INSERT INTO `tbl_permissions` (`id`, `name`, `access`, `date_modified`, `date_created`) VALUES
(1, 'User', 1, '2012-01-05 16:34:50', '2012-01-05 16:34:55'),
(2, 'Author', 2, '2012-01-05 16:35:05', '2012-01-05 16:35:09'),
(3, 'Manager', 4, '2012-01-05 16:35:22', '2012-01-05 16:35:25'),
(4, 'Admin', 8, '2012-01-05 16:35:35', '2012-01-05 16:35:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_photos`
--

CREATE TABLE IF NOT EXISTS `tbl_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` int(11) NOT NULL,
  `album` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL,
  `size` varchar(10) NOT NULL,
  `profile_picture` int(1) NOT NULL,
  `date_uploaded` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_photos`
--

INSERT INTO `tbl_photos` (`id`, `author`, `album`, `name`, `photo`, `type`, `size`, `profile_picture`, `date_uploaded`) VALUES
(1, 1, 2, 'Alissa', 'lissy.jpg', '1', '795133', 0, '2012-01-19 18:35:35'),
(2, 1, 2, 'Me and Alissa', 'me-and-lissy.jpg', '1', '47553', 1, '2012-01-19 19:02:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE IF NOT EXISTS `tbl_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `website_name` varchar(100) NOT NULL,
  `tagline` varchar(100) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `offline` int(1) NOT NULL,
  `offline_message` varchar(255) NOT NULL,
  `editor` int(11) NOT NULL,
  `use_htaccess` int(1) NOT NULL,
  `debug_mode` int(1) NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `website_name`, `tagline`, `keywords`, `description`, `offline`, `offline_message`, `editor`, `use_htaccess`, `debug_mode`, `date_modified`) VALUES
(1, 'My Website', 'My New Website', 'new, website, cms', 'My new website created with this awesome CMS.', 0, 'This site is currently offline, try again soon.', 1, 0, 1, '2012-02-10 15:40:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_statuses`
--

CREATE TABLE IF NOT EXISTS `tbl_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `date_modified` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_statuses`
--

INSERT INTO `tbl_statuses` (`id`, `name`, `date_modified`, `date_created`) VALUES
(1, 'Prefer not to say', '2012-01-17 16:30:58', '2012-01-17 16:30:58'),
(2, 'Single', '2012-01-17 16:30:58', '2012-01-17 16:30:58'),
(3, 'In a relationship', '2012-01-17 16:30:58', '2012-01-17 16:30:58'),
(4, 'Married', '2012-01-17 16:30:58', '2012-01-17 16:30:58'),
(5, 'Engaged', '2012-01-17 16:30:58', '2012-01-17 16:30:58'),
(6, 'It''s complicated', '2012-01-17 16:30:58', '2012-01-17 16:30:58'),
(7, 'Cival partnership', '2012-01-17 16:30:58', '2012-01-17 16:30:58'),
(8, 'Widowed', '2012-01-17 16:30:58', '2012-01-17 16:30:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_templates`
--

CREATE TABLE IF NOT EXISTS `tbl_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL,
  `directory` varchar(50) NOT NULL,
  `active` int(1) NOT NULL,
  `date_modified` datetime NOT NULL,
  `date_installed` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_templates`
--

INSERT INTO `tbl_templates` (`id`, `name`, `type`, `directory`, `active`, `date_modified`, `date_installed`) VALUES
(1, 'Default', 'admin', 'default', 0, '2012-01-05 17:41:08', '2012-01-05 17:41:11'),
(2, 'Default', 'public', 'default', 1, '2012-01-05 17:41:28', '2012-01-05 17:41:30'),
(4, 'New Default', 'admin', 'newdefault', 1, '2012-02-07 13:20:45', '2012-02-07 13:20:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `bio` text NOT NULL,
  `url` varchar(200) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `status` varchar(50) NOT NULL,
  `email_notifications` int(1) NOT NULL,
  `enabled` int(1) NOT NULL,
  `date_modified` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `permission`, `username`, `password`, `email`, `first_name`, `last_name`, `bio`, `url`, `gender`, `status`, `email_notifications`, `enabled`, `date_modified`, `date_created`) VALUES
(1, 4, 'admin', '4da2e77f83655854d560c844a165f986483735f5', 'chris@develop21.com', 'Christopher', 'Pynegar', 'Developer of Untitled CMS.', 'admin', 'm', 'Single', 1, 1, '2012-02-08 12:55:56', '2012-01-05 16:36:33'),
(8, 1, 'johndoe', '6c074fa94c98638dfe3e3b74240573eb128b3d16', 'johndoe@develop21.com', 'John', 'Doe', '', '', 'p', 'Prefer not to say', 1, 1, '2012-02-01 12:40:54', '2012-01-31 12:07:38'),
(12, 1, 'kezza', 'e727d1464ae12436e899a726da5b2f11d8381b26', 'kez@develop21.com', 'Kez', 'Louise', '', '', '', '', 1, 1, '2012-02-01 20:11:26', '2012-02-01 20:11:26'),
(13, 1, 'johnsmith', '3b842bcd6faab4047ab49f9a99fa0704b9c9d2d7', 'johnsmith@develop21.com', 'John', 'Smith', '', '', '', '', 1, 1, '2012-02-09 11:37:39', '2012-02-09 11:37:39');
