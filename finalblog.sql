-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2019 at 05:15 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finalblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Game updated', 'game-updated', 'game-updated-2019-01-01-5c2b2fd93a241.jpg', '2018-12-13 08:31:40', '2019-01-01 03:16:09'),
(3, 'Entertainment', 'entertainment', 'entertainment-2019-01-01-5c2b2fbbbc19c.jpg', '2018-12-17 03:56:15', '2019-01-01 03:15:40'),
(4, 'Politics', 'politics', 'politics-2019-01-01-5c2b2fa9d9a2d.jpg', '2018-12-28 06:52:28', '2019-01-01 03:15:22'),
(5, 'Fashion', 'fashion', 'fashion-2019-01-01-5c2b30392d139.jpg', '2019-01-01 03:17:45', '2019-01-01 03:17:45');

-- --------------------------------------------------------

--
-- Table structure for table `category_post`
--

CREATE TABLE `category_post` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_post`
--

INSERT INTO `category_post` (`id`, `category_id`, `post_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2018-12-16 18:00:00', '2018-12-16 18:00:00'),
(2, 3, 3, NULL, NULL),
(3, 2, 4, NULL, NULL),
(4, 3, 4, NULL, NULL),
(7, 3, 2, NULL, NULL),
(8, 3, 5, NULL, NULL),
(9, 2, 6, NULL, NULL),
(10, 2, 7, NULL, NULL),
(11, 3, 7, NULL, NULL),
(12, 4, 8, '2019-01-02 12:33:35', '2019-01-02 12:33:35'),
(13, 5, 8, '2019-01-02 12:33:35', '2019-01-02 12:33:35');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'This is new comment', '2019-01-02 09:23:30', '2019-01-02 09:23:30'),
(4, 8, 2, 'New comment', '2019-01-02 12:34:07', '2019-01-02 12:34:07');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"displayName\":\"App\\\\Notifications\\\\NewAuthorPost\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":11:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:31:\\\"App\\\\Notifications\\\\NewAuthorPost\\\":9:{s:4:\\\"post\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\Post\\\";s:2:\\\"id\\\";i:8;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:2:\\\"id\\\";s:36:\\\"89e7b871-bbcd-4aec-a973-48e376800319\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1546454016, 1546454016),
(2, 'default', '{\"displayName\":\"App\\\\Notifications\\\\AuthorPostApproved\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":11:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\AuthorPostApproved\\\":9:{s:4:\\\"post\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\Post\\\";s:2:\\\"id\\\";i:8;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:2:\\\"id\\\";s:36:\\\"7e67048d-4a15-4f4d-a7e3-23e614e522be\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1546454572, 1546454572),
(3, 'default', '{\"displayName\":\"App\\\\Notifications\\\\NewPostNotify\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":11:{s:11:\\\"notifiables\\\";O:44:\\\"Illuminate\\\\Notifications\\\\AnonymousNotifiable\\\":1:{s:6:\\\"routes\\\";a:1:{s:4:\\\"mail\\\";s:16:\\\"plabon@gmail.com\\\";}}s:12:\\\"notification\\\";O:31:\\\"App\\\\Notifications\\\\NewPostNotify\\\":9:{s:4:\\\"post\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\Post\\\";s:2:\\\"id\\\";i:8;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:2:\\\"id\\\";s:36:\\\"661da483-64f6-46ba-b3cd-2f49e6b8e11c\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1546454572, 1546454572);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_12_10_085950_create_roles_table', 1),
(4, '2018_12_12_125146_create_tags_table', 2),
(5, '2018_12_13_123005_create_categories_table', 3),
(6, '2018_12_17_094219_create_category_post_table', 4),
(7, '2018_12_17_094328_create_posts_table', 4),
(8, '2018_12_17_094408_create_post_tag_table', 4),
(9, '2018_12_20_180122_create_subscribers_table', 5),
(10, '2018_12_21_062358_create_jobs_table', 6),
(11, '2018_12_28_122900_create_post_user_table', 7),
(12, '2019_01_02_143325_create_comments_table', 8),
(13, '2019_01_08_034406_create_socials_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `view_count` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `slug`, `image`, `body`, `view_count`, `status`, `is_approved`, `created_at`, `updated_at`) VALUES
(1, 1, 'First post', 'first-post', 'first-post-2019-01-01-5c2b2f66ef29a.jpg', '<div class=\"panel-pane pane-author margin-top-big\">\r\n<div class=\"pane-content\">\r\n<div class=\"author-name margin-bottom-big\">Star Online Report</div>\r\n</div>\r\n</div>\r\n<div class=\"panel-separator\">&nbsp;</div>\r\n<div class=\"panel-pane pane-node-content\">\r\n<div class=\"pane-content\">\r\n<article id=\"node-1681528\" class=\"node node-news clearfix\">\r\n<div>\r\n<div class=\"field-body\">\r\n<p><strong>Jatiya Party candidate for<a href=\"https://www.thedailystar.net/bangladesh-national-election-2018/results\" target=\"_blank\">Dhaka-8 constituency</a>Advocate Eunus Ali Akond today filed a writ petition with the High Court seeking its directive upon the Election Commission (EC) to cancel the&nbsp;result of the constituency citing irregularities.</strong></p>\r\n<p>In the petition, Eunus Ali prayed to the High Court to order the EC not to include the name of Rashed Khan Menon in the in the gazette notification.</p>\r\n<p>Menon, a candidate from Awami League-led 14-party alliance, has been elected in the December 30 general election.</p>\r\n<p>Eunus Ali&nbsp;Akond told the Daily Star that the agents of the other candidates were not allowed in the polling centres during the election.</p>\r\n<p>The presence of voters was also very low, but it was said in the election result that huge turnout took place in the election, he said.</p>\r\n</div>\r\n</div>\r\n</article>\r\n</div>\r\n</div>', 5, 1, 1, '2018-12-16 18:00:00', '2019-01-09 02:12:38'),
(2, 1, 'Second Post up', 'second-post-up', 'second-post-up-2019-01-01-5c2b2f8578b14.jpg', '<div class=\"panel-pane pane-author margin-top-big\">\r\n<div class=\"pane-content\">\r\n<div class=\"author-name margin-bottom-big\">Star Online Report</div>\r\n</div>\r\n</div>\r\n<div class=\"panel-separator\">&nbsp;</div>\r\n<div class=\"panel-pane pane-node-content\">\r\n<div class=\"pane-content\">\r\n<article id=\"node-1681528\" class=\"node node-news clearfix\">\r\n<div>\r\n<div class=\"field-body\">\r\n<p><strong>Jatiya Party candidate for<a href=\"https://www.thedailystar.net/bangladesh-national-election-2018/results\" target=\"_blank\">Dhaka-8 constituency</a>Advocate Eunus Ali Akond today filed a writ petition with the High Court seeking its directive upon the Election Commission (EC) to cancel the&nbsp;result of the constituency citing irregularities.</strong></p>\r\n<p>In the petition, Eunus Ali prayed to the High Court to order the EC not to include the name of Rashed Khan Menon in the in the gazette notification.</p>\r\n<p>Menon, a candidate from Awami League-led 14-party alliance, has been elected in the December 30 general election.</p>\r\n<p>Eunus Ali&nbsp;Akond told the Daily Star that the agents of the other candidates were not allowed in the polling centres during the election.</p>\r\n<p>The presence of voters was also very low, but it was said in the election result that huge turnout took place in the election, he said.</p>\r\n</div>\r\n</div>\r\n</article>\r\n</div>\r\n</div>', 3, 0, 1, '2018-12-10 18:00:00', '2019-01-02 11:13:34'),
(3, 1, 'Third Post', 'third-post', 'third-post-2019-01-01-5c2b2f5468235.jpg', '<div class=\"panel-pane pane-author margin-top-big\">\r\n<div class=\"pane-content\">\r\n<div class=\"author-name margin-bottom-big\">Star Online Report</div>\r\n</div>\r\n</div>\r\n<div class=\"panel-separator\">&nbsp;</div>\r\n<div class=\"panel-pane pane-node-content\">\r\n<div class=\"pane-content\">\r\n<article id=\"node-1681528\" class=\"node node-news clearfix\">\r\n<div>\r\n<div class=\"field-body\">\r\n<p><strong>Jatiya Party candidate for<a href=\"https://www.thedailystar.net/bangladesh-national-election-2018/results\" target=\"_blank\">Dhaka-8 constituency</a>Advocate Eunus Ali Akond today filed a writ petition with the High Court seeking its directive upon the Election Commission (EC) to cancel the&nbsp;result of the constituency citing irregularities.</strong></p>\r\n<p>In the petition, Eunus Ali prayed to the High Court to order the EC not to include the name of Rashed Khan Menon in the in the gazette notification.</p>\r\n<p>Menon, a candidate from Awami League-led 14-party alliance, has been elected in the December 30 general election.</p>\r\n<p>Eunus Ali&nbsp;Akond told the Daily Star that the agents of the other candidates were not allowed in the polling centres during the election.</p>\r\n<p>The presence of voters was also very low, but it was said in the election result that huge turnout took place in the election, he said.</p>\r\n</div>\r\n</div>\r\n</article>\r\n</div>\r\n</div>', 2, 0, 1, '2018-12-17 12:23:07', '2019-01-02 09:54:53'),
(4, 1, 'Fourth Post', 'fourth-post', 'fourth-post-2019-01-01-5c2b2f429b674.jpg', '<div class=\"panel-pane pane-author margin-top-big\">\r\n<div class=\"pane-content\">\r\n<div class=\"author-name margin-bottom-big\">Star Online Report</div>\r\n</div>\r\n</div>\r\n<div class=\"panel-separator\">&nbsp;</div>\r\n<div class=\"panel-pane pane-node-content\">\r\n<div class=\"pane-content\">\r\n<article id=\"node-1681528\" class=\"node node-news clearfix\">\r\n<div>\r\n<div class=\"field-body\">\r\n<p><strong>Jatiya Party candidate for<a href=\"https://www.thedailystar.net/bangladesh-national-election-2018/results\" target=\"_blank\">Dhaka-8 constituency</a>Advocate Eunus Ali Akond today filed a writ petition with the High Court seeking its directive upon the Election Commission (EC) to cancel the&nbsp;result of the constituency citing irregularities.</strong></p>\r\n<p>In the petition, Eunus Ali prayed to the High Court to order the EC not to include the name of Rashed Khan Menon in the in the gazette notification.</p>\r\n<p>Menon, a candidate from Awami League-led 14-party alliance, has been elected in the December 30 general election.</p>\r\n<p>Eunus Ali&nbsp;Akond told the Daily Star that the agents of the other candidates were not allowed in the polling centres during the election.</p>\r\n<p>The presence of voters was also very low, but it was said in the election result that huge turnout took place in the election, he said.</p>\r\n</div>\r\n</div>\r\n</article>\r\n</div>\r\n</div>', 5, 1, 1, '2018-12-17 12:23:39', '2019-01-09 02:02:08'),
(5, 2, 'Fifth Post', 'fifth-post', 'fifth-post-2019-01-01-5c2b2f2acb2aa.jpg', '<div class=\"panel-pane pane-author margin-top-big\">\r\n<div class=\"pane-content\">\r\n<div class=\"author-name margin-bottom-big\">Star Online Report</div>\r\n</div>\r\n</div>\r\n<div class=\"panel-separator\">&nbsp;</div>\r\n<div class=\"panel-pane pane-node-content\">\r\n<div class=\"pane-content\">\r\n<article id=\"node-1681528\" class=\"node node-news clearfix\">\r\n<div>\r\n<div class=\"field-body\">\r\n<p><strong>Jatiya Party candidate for<a href=\"https://www.thedailystar.net/bangladesh-national-election-2018/results\" target=\"_blank\">Dhaka-8 constituency</a>Advocate Eunus Ali Akond today filed a writ petition with the High Court seeking its directive upon the Election Commission (EC) to cancel the&nbsp;result of the constituency citing irregularities.</strong></p>\r\n<p>In the petition, Eunus Ali prayed to the High Court to order the EC not to include the name of Rashed Khan Menon in the in the gazette notification.</p>\r\n<p>Menon, a candidate from Awami League-led 14-party alliance, has been elected in the December 30 general election.</p>\r\n<p>Eunus Ali&nbsp;Akond told the Daily Star that the agents of the other candidates were not allowed in the polling centres during the election.</p>\r\n<p>The presence of voters was also very low, but it was said in the election result that huge turnout took place in the election, he said.</p>\r\n</div>\r\n</div>\r\n</article>\r\n</div>\r\n</div>', 2, 1, 0, '2018-12-20 23:59:44', '2019-01-06 02:42:43'),
(6, 2, 'Sixth post', 'sixth-post', 'sixth-post-2019-01-01-5c2b2f167c068.jpg', '<div class=\"panel-pane pane-author margin-top-big\">\r\n<div class=\"pane-content\">\r\n<div class=\"author-name margin-bottom-big\">Star Online Report</div>\r\n</div>\r\n</div>\r\n<div class=\"panel-separator\">&nbsp;</div>\r\n<div class=\"panel-pane pane-node-content\">\r\n<div class=\"pane-content\">\r\n<article id=\"node-1681528\" class=\"node node-news clearfix\">\r\n<div>\r\n<div class=\"field-body\">\r\n<p><strong>Jatiya Party candidate for<a href=\"https://www.thedailystar.net/bangladesh-national-election-2018/results\" target=\"_blank\">Dhaka-8 constituency</a>Advocate Eunus Ali Akond today filed a writ petition with the High Court seeking its directive upon the Election Commission (EC) to cancel the&nbsp;result of the constituency citing irregularities.</strong></p>\r\n<p>In the petition, Eunus Ali prayed to the High Court to order the EC not to include the name of Rashed Khan Menon in the in the gazette notification.</p>\r\n<p>Menon, a candidate from Awami League-led 14-party alliance, has been elected in the December 30 general election.</p>\r\n<p>Eunus Ali&nbsp;Akond told the Daily Star that the agents of the other candidates were not allowed in the polling centres during the election.</p>\r\n<p>The presence of voters was also very low, but it was said in the election result that huge turnout took place in the election, he said.</p>\r\n</div>\r\n</div>\r\n</article>\r\n</div>\r\n</div>', 1, 1, 0, '2018-12-21 00:21:13', '2019-01-06 02:41:05'),
(7, 2, 'Seventh Post', 'seventh-post', 'seventh-post-2019-01-01-5c2b2ef8688ff.jpg', '<div class=\"panel-pane pane-author margin-top-big\">\r\n<div class=\"pane-content\">\r\n<div class=\"author-name margin-bottom-big\">Star Online Report</div>\r\n</div>\r\n</div>\r\n<div class=\"panel-separator\">&nbsp;</div>\r\n<div class=\"panel-pane pane-node-content\">\r\n<div class=\"pane-content\">\r\n<article id=\"node-1681528\" class=\"node node-news clearfix\">\r\n<div>\r\n<div class=\"field-body\">\r\n<p><strong><a href=\"https::/www.facebook.com\">Jatiya Party</a> candidate for<a href=\"https://www.thedailystar.net/bangladesh-national-election-2018/results\" target=\"_blank\">Dhaka-8 constituency</a>Advocate Eunus Ali Akond today filed a writ petition with the High Court seeking its directive upon the Election Commission (EC) to cancel the&nbsp;result of the constituency citing irregularities.</strong></p>\r\n<p>In the petition, Eunus Ali prayed to the High Court to order the EC not to include the name of Rashed Khan Menon in the in the gazette notification.</p>\r\n<p>Menon, a candidate from Awami League-led 14-party alliance, has been elected in the December 30 general election.</p>\r\n<p>Eunus Ali&nbsp;Akond told the Daily Star that the agents of the other candidates were not allowed in the polling centres during the election.</p>\r\n<p>The presence of voters was also very low, but it was said in the election result that huge turnout took place in the election, he said.</p>\r\n</div>\r\n</div>\r\n</article>\r\n</div>\r\n</div>', 9, 1, 1, '2018-12-21 00:29:29', '2019-01-07 05:04:36'),
(8, 2, 'New post', 'new-post', 'new-post-2019-01-02-5c2d03fe57a49.jpg', '<div class=\"panel-pane pane-author margin-top-big\">\r\n<div class=\"pane-content\">\r\n<div class=\"author-name margin-bottom-big\">Star Online Report</div>\r\n</div>\r\n</div>\r\n<div class=\"panel-separator\">&nbsp;</div>\r\n<div class=\"panel-pane pane-node-content\">\r\n<div class=\"pane-content\">\r\n<article id=\"node-1681528\" class=\"node node-news clearfix\">\r\n<div>\r\n<div class=\"field-body\">\r\n<p><strong><a href=\"https://127.0.0.1/www.facebook.com\">Jatiya Party</a>&nbsp;candidate for<a href=\"https://www.thedailystar.net/bangladesh-national-election-2018/results\" target=\"_blank\">Dhaka-8 constituency</a>Advocate Eunus Ali Akond today filed a writ petition with the High Court seeking its directive upon the Election Commission (EC) to cancel the&nbsp;result of the constituency citing irregularities.</strong></p>\r\n<p>In the petition, Eunus Ali prayed to the High Court to order the EC not to include the name of Rashed Khan Menon in the in the gazette notification.</p>\r\n<p>Menon, a candidate from Awami League-led 14-party alliance, has been elected in the December 30 general election.</p>\r\n<p>Eunus Ali&nbsp;Akond told the Daily Star that the agents of the other candidates were not allowed in the polling centres during the election.</p>\r\n<p>The presence of voters was also very low, but it was said in the election result that huge turnout took place in the election, he said.</p>\r\n</div>\r\n</div>\r\n</article>\r\n</div>\r\n</div>', 3, 1, 0, '2019-01-02 12:33:35', '2019-01-03 21:10:58');

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_tag`
--

INSERT INTO `post_tag` (`id`, `post_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2018-12-16 18:00:00', '2018-12-16 18:00:00'),
(2, 3, 5, NULL, NULL),
(3, 4, 2, NULL, NULL),
(4, 4, 4, NULL, NULL),
(5, 4, 5, NULL, NULL),
(8, 2, 2, NULL, NULL),
(9, 2, 5, NULL, NULL),
(10, 5, 4, NULL, NULL),
(11, 6, 2, NULL, NULL),
(12, 6, 5, NULL, NULL),
(13, 7, 2, NULL, NULL),
(14, 8, 4, '2019-01-02 12:33:35', '2019-01-02 12:33:35'),
(15, 8, 5, '2019-01-02 12:33:35', '2019-01-02 12:33:35');

-- --------------------------------------------------------

--
-- Table structure for table `post_user`
--

CREATE TABLE `post_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_user`
--

INSERT INTO `post_user` (`id`, `post_id`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 7, 1, '2018-12-28 09:21:10', '2018-12-28 09:21:10'),
(7, 6, 1, '2018-12-28 09:29:41', '2018-12-28 09:29:41'),
(8, 7, 2, '2019-01-06 02:42:09', '2019-01-06 02:42:09'),
(9, 4, 1, '2019-01-07 22:12:41', '2019-01-07 22:12:41');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', NULL, NULL),
(2, 'Author', 'author', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` int(10) UNSIGNED NOT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instagram` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vemio` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pinterest` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `socials`
--

INSERT INTO `socials` (`id`, `facebook`, `twitter`, `instagram`, `vemio`, `pinterest`, `created_at`, `updated_at`) VALUES
(1, 'https://www.faceook.com', 'https://www.twiter.com', 'https://www.insagram.com', 'https://www.veio.com', 'https://www.pinerest.com', '2019-01-07 22:05:03', '2019-01-07 22:08:09');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `created_at`, `updated_at`) VALUES
(2, 'plabon@gmail.com', '2018-12-20 12:19:31', '2018-12-20 12:19:31'),
(3, 'plabon@blog.com', '2019-01-03 21:08:13', '2019-01-03 21:08:13'),
(4, 'author@blog.com', '2019-01-05 09:34:44', '2019-01-05 09:34:44'),
(5, 'admin@gmail.com', '2019-01-09 02:03:06', '2019-01-09 02:03:06');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(2, 'Test', 'test', '2018-12-12 07:39:10', '2018-12-12 07:39:10'),
(4, 'Entertainment Updated', 'entertainment-updated', '2018-12-12 08:02:33', '2018-12-12 08:15:15'),
(5, 'Football', 'football', '2018-12-12 08:03:13', '2018-12-12 08:03:13'),
(6, 'fashion', 'fashion', '2019-01-01 03:18:29', '2019-01-01 03:18:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `about` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `username`, `email`, `email_verified_at`, `password`, `image`, `about`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Plabon', 'admin', 'plabon@blog.com', NULL, '$2y$10$S4aehBl99xlx.fKUsTJ//.pEj9VxE0o1i/9Oe6hgLbl5NfvfQxv2m', 'plabon-2018-12-23-5c1fd9b438226.jpg', 'Hello, I am laravel developer and admin', 'XDPcK2Rh4eu9dSSjRUAi3Jyzcxf4FM7BBQzHLMqggluZxOWmrGNNCKhiUiFE', '2019-01-01 21:37:03', '2018-12-23 13:19:24'),
(2, 2, 'Joseph', 'author', 'joseph@blog.com', NULL, '$2y$10$rTeaeQUcnf9W7akxqqcMfeXbY3oCw8D.qNEF4gsVAYsUHplbGPbDe', 'joseph-2019-01-06-5c31bf491d4c8.jpg', 'Hello, I am author', '5afjwOefawGC3CaIaE11qi29pMLIlgEQ2DQ41K6w2edQDzcKs4vdK4sERj91', '2018-12-31 20:24:06', '2019-01-06 02:41:45'),
(3, 2, 'Preity', 'blogger', 'blogger@blog.com', NULL, '$2y$10$grxr5EBlscABp0m4c8Auaud0miQqJjIjeTrLvY4hapl3wNHopNgYS', 'preity-2019-01-05-5c30c72ed5e73.jpg', 'I am Preity', 'gkMi2DW1gkv1jvXwxZjxMFBUyA0eErpHgAdsO3R9Y2Ms5baWmPlSngevGZZ3', '2019-01-05 09:02:05', '2019-01-05 09:03:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_post`
--
ALTER TABLE `category_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_user`
--
ALTER TABLE `post_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_user_post_id_foreign` (`post_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category_post`
--
ALTER TABLE `category_post`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `post_user`
--
ALTER TABLE `post_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_user`
--
ALTER TABLE `post_user`
  ADD CONSTRAINT `post_user_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
