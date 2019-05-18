-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 18, 2019 at 10:34 AM
-- Server version: 10.3.14-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id7377120_db_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_editors`
--

CREATE TABLE `admin_editors` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `added_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_editors`
--

INSERT INTO `admin_editors` (`id`, `email`, `type`, `password`, `name`, `added_by`) VALUES
(1, 'shadhin@gmail.com', 'admin', '202cb962ac59075b964b07152d234b70', 'Abu Hasan Shadhin', '------------'),
(7, 'pranto@friendzonebd.cf', 'editor', 'e2270f30df2e9318840360b51dbe6d89', 'Minhajul Pranto', 'Abu Hasan Shadhin');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_status`) VALUES
(17, 'কবিতা', 0),
(18, 'Hacking', 0),
(19, 'Funny Facebook Post', 0),
(21, 'গল্প', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `commenter_name` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `commenter_name`, `comment`, `comment_date`) VALUES
(1, 7, 'ruse@mymail90.com', 'WOW', '2018-10-08 14:35:19'),
(2, 9, 'ruse@mymail90.com', '100% working Boss Thanks', '2018-10-08 14:36:20'),
(3, 9, 'vica@mail4gmail.com', 'Wow', '2018-10-08 14:38:17');

-- --------------------------------------------------------

--
-- Table structure for table `comment_reply`
--

CREATE TABLE `comment_reply` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `replier_name` varchar(255) NOT NULL,
  `reply` text NOT NULL,
  `reply_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user_id`) VALUES
(1, 7, 2),
(2, 7, 7),
(3, 9, 7),
(4, 9, 8);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `post_title` text NOT NULL,
  `post_category` text NOT NULL,
  `post_description` text NOT NULL,
  `post_image` text DEFAULT NULL,
  `post_status` tinyint(4) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_author_id` int(11) NOT NULL,
  `post_popular` int(11) DEFAULT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_title`, `post_category`, `post_description`, `post_image`, `post_status`, `post_author`, `post_author_id`, `post_popular`, `post_date`) VALUES
(7, 'মুঠোফোনের কাব্য', '17', '<p>পাগলী আমার ঘুমিয়ে পড়েছে মুঠোফোন তাই শান্ত,</p>\r\n\r\n<p>আমি রাত জেগে দিচ্ছি পাহারা মুঠোফোনের এই প্রান্ত ।</p>\r\n\r\n<p>এ কথা যদি সে জানতো ?</p>\r\n\r\n<p>আমিও দিই না জানতে,</p>\r\n\r\n<p>কবির প্রেম তো এরকমই হয় - পান্তা ফুরায় নুন আনতে ।</p>\r\n\r\n<p>হে চির-অধরা আমার, তুমি তো সেকথা জানতে ।</p>\r\n', 'images/croquis-d-une-fille-avec-le-long-cheveu-62386604_2f0.jpg', 0, 'Shadhin', 1, 76, '2018-10-08 08:18:11'),
(9, 'How to confirm all friend request on facebook By ONE-CLICK', '18', '<p>1st Go to the link <a href=\"https://www.facebook.com/reqs.php\" target=\"_blank\">https://www.facebook.com/reqs.php</a> (chrome browser)</p>\r\n\r\n<p>copy the text and paste at the address Bar and press #ENTER</p>\r\n\r\n<p>javascript:var confirmBtns = document.getElementsByTagName(&#39;button&#39;);</p>\r\n\r\n<p>for (var i = 0; i &lt; confirmBtns.length; i++) {</p>\r\n\r\n<p>&nbsp; &nbsp; if (confirmBtns[i].innerHTML == &quot;Confirm&quot;) {</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;confirmBtns[i].click();</p>\r\n\r\n<p>&nbsp; &nbsp; }</p>\r\n\r\n<p>}</p>\r\n\r\n<p>Follow our FB PAGE -&nbsp;<a href=\"https://www.facebook.com/friendzonebd.cf\" target=\"_blank\">https://www.facebook.com/friendzonebd.cf</a></p>\r\n\r\n<p>Follow Me On FB -&nbsp;<a href=\"https://www.facebook.com/prantopl\" target=\"_blank\">https://www.facebook.com/prantopl</a></p>\r\n\r\n<h2 style=\"font-style:italic\"><strong>Thanks For Being With Us,</strong></h2>\r\n\r\n<h2 style=\"font-style:italic\"><strong>FriendZoneBD</strong></h2>\r\n', 'images/5a956adcdda4c895338b4588_d91.jpg', 0, 'Minhajul Pranto', 7, 71, '2018-10-08 14:25:22'),
(12, 'পরকীয়া প্রেমের গল্প', '21', '<p>অফিসের কলিগটা যদি আপনার মসৃন কপালের টিপটি সোজা হয়নি বলে আখ্যায়িত করে,তার মানে এই না যে, সে আপনার খেয়ালটি স্বামীর চেয়ে একটু বেশিই রাখে !<br />\r\nঅথবা দুপুরে লাঞ্চ ব্রেকে আপনাকে নিয়ে যদি বিলাসবহুল কোন ক্যাফে রেষ্টুরেন্টে খায় ,এর অর্থও এটা নয় যে আপনার মূল্য তার কাছে আকাশ ছোঁয়া !<br />\r\n...<br />\r\n__পরকীয়া প্রেম কিন্তু একদিনে হুট করে সৃষ্টি হয় না ! মনের কিছু অবুঝ আর অতিরিক্ত আকাঙ্খার অপূর্ণতার সমষ্টিগত কারণেই ধিরে ধিরে হতে থাকে।<br />\r\nআপনার স্বামী তার ক্যরিয়ার নিয়ে ব্যাস্ত , সন্তানের ফিউচার নিয়ে ও মগ্ন ! আর আপনি একজন অগান্তুকের সামান্য আহলাদিতে নিজেকে হারাতে বসেছেন অজানায় !<br />\r\nভুল, ভুল ছাড়া কিছুই না l<br />\r\n...<br />\r\nআপনার ছোট ছোট চাওয়াগুলো ,ঈশ্বর প্রদত্ত আপনার সেই অবিচ্ছেদ্য সঙ্গিটার মাঝে খুঁজে নিন ! না হয় ভুলের পাহাড়<br />\r\nবিশালতার আকার ধারন করবে l<br />\r\nএমন কিছু ভূল আমাদের প্রত্যাহিক জীবনে ঘটে যায় ,যা শুধু বালিশ বুকে চেপে কান্নাই শেখায় আর কিছু না !<br />\r\nএমন ভুল কেনই বা করবেন ,যে ভুল শোধরানোর কোন পথ নেই<br />\r\nআছে শুধু ভোগান্তি l</p>\r\n\r\n<pre>\r\n<ins><strong>আরো গল্প</strong></ins> <a href=\"https://www.facebook.com/uralcondi\" target=\"_blank\">https://www.facebook.com/uralcondi</a></pre>\r\n\r\n<p><span class=\"marker\"><em><strong>Our Fan Page - Click this&nbsp;<a href=\"https://www.facebook.com/friendzonebd.cf\" target=\"_blank\">Friend Zone BD</a></strong></em></span></p>\r\n\r\n<p><strong>Thanks For Being With Us</strong></p>\r\n\r\n<p><strong>FriendZoneBD</strong></p>\r\n', 'images/DPfpYXMWkAMaSJe_447.jpg', 0, 'Minhajul Pranto', 7, 35, '2018-10-09 07:01:39'),
(14, 'প্রতীক্ষা', '17', '<p>একদিন শান্ত সকালে<br />\r\nস্কুলের কোলাহলে<br />\r\nনিতান্তই খেলাচ্ছলে<br />\r\nদিয়েছিলো সে প্রস্তাব<br />\r\nঅবাক নয়নে চেয়ে থাকলাম<br />\r\nক্রোধে ফেটে পড়লাম<br />\r\nনিজেকে বললাম<br />\r\nআমি কি প্রেমে পড়লাম<br />\r\nঅবশেষে বুঝলাম<br />\r\nমনে মনে হাসলাম<br />\r\nনিজেকে বোঝালাম<br />\r\nতারই মাঝে হারালাম<br />\r\nআজ আমি চেয়ে থাকি<br />\r\nমনে মনে শুধু ভাবি<br />\r\nসে আবার আসবে নাকি<br />\r\nবলতে আমায় ভালোবাসি ।</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'images/hairstyle-art-drawing-image-about-girl-in-hairstyles-cherrycrush26_7ec.jpg', 0, 'Abu Hasan Shadhin', 1, 11, '2018-10-09 15:17:49'),
(15, 'অঘ্রান প্রান্তরে _____জীবনানন্দ দাশ', '17', '<p>&lsquo;জানি আমি তোমার দু&rsquo;চোখ আজ<br />\r\nআমাকে খোঁজেনা আর পৃথিবীর&rsquo; পরে-<br />\r\nবলে চুপে থামলাম, কেবলি অশত্থ<br />\r\nপাতা পড়ে আছে ঘাসের<br />\r\nভিতরে শুকনো মিয়োনো ছেঁড়া;- অঘ্রান<br />\r\nএসেছে আজপৃথিবীর বনে;<br />\r\nসে সবের ঢের আগে আমাদের দুজনের মনে হেমন্ত<br />\r\nএসেছে তবু; বললে সে, &lsquo;ঘাসের ওপরে সব<br />\r\nবিছানো পাতার<br />\r\nমুখে এই নিস্তব্ধতা কেমন যে-<br />\r\nসন্ধ্যারআবছা অন্ধকার<br />\r\nছড়িয়ে পড়েছে জলে; কিছুক্ষণ অঘ্রাণের অস্পষ্ট<br />\r\nজগতে হাঁটলাম, চিল উড়ে চলে গেছে-কুয়াশার প্রান্তরের<br />\r\nপথে<br />\r\nদু-একটা সজারুর আসা-যাওয়া; উচ্ছল<br />\r\nকলারঝড়ে উড়ে চুপে সন্ধ্যার<br />\r\nবাতাসে লক্ষ্মীপেঁচা হিজলের ফাঁক দিয়ে বাবলার<br />\r\nআঁধার গলিতে নেমে আসে;<br />\r\nআমাদের জীবনের অনেক অতীত<br />\r\nব্যাপ্তি আজো যেন<br />\r\nলেগে আছে বহতা পাখায়<br />\r\nঐ সব পাখিদের ঐ সব দূর দূর ধানক্ষেতে,<br />\r\nছাতকুড়োমাখা ক্লান্ত জামের শাখায়;<br />\r\nনীলচে ঘাসের ফুলে ফড়িঙের হৃদয়ের<br />\r\nমতো নীরবতা ছড়িয়ে রয়েছে এই<br />\r\nপ্রান্তরে বুকে আজ&hellip;&hellip; হেঁটে চলি&hellip;..<br />\r\nআজ কোনো কথা<br />\r\nনেই আর আমাদের; মাঠের কিনারে ঢের<br />\r\nঝরা ঝাউফল<br />\r\nপড়ে আছে; খড়কুটো উড়ে এসে লেগে আছে শড়ির<br />\r\nভিতরে,<br />\r\nসজনে পাতার গুঁড়ি চুলে বেঁধে গিয়ে নড়ে-চড়ে;<br />\r\nপতঙ্গ পালক্ জল-চারি দিকে সূর্যের<br />\r\nউজ্জ্বলতা নাশ;<br />\r\nআলোয়ার মতো ওই<br />\r\nধানগুলো নড়ে শূন্যে কী রকম অবাধ আকাশ<br />\r\nহয়ে যায়; সময়ও অপার-তাকে প্রেম আশা চেতনার কণা<br />\r\nধরে আছে বলে সে-ও সনাতন;-কিন্তু এই ব্যর্থ<br />\r\nধারণা<br />\r\nসরিয়ে মেয়েটি তাঁর আঁচলের<br />\r\nচোরাকাঁটা বেছে প্রান্তর নক্ষত্র নদী আকাশের<br />\r\nথেকে সরে গেছে যেই স্পষ্ট নির্লিপ্তিতে-তাই-ই<br />\r\nঠিক;- ওখানে সিগ্ধ হয়<br />\r\nসব।<br />\r\nঅপ্রেমে বা প্রেমে নয়- নিখিলের বৃক্ষ নিজ<br />\r\nবিকাশে নীরব।</p>\r\n', 'images/images_63f.jpg', 0, 'Abu Hasan Shadhin', 1, 5, '2018-10-11 14:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_email`, `user_password`) VALUES
(2, 'RiponSarkar', 'riponsarkar422725@gmail.com', '202cb962ac59075b964b07152d234b70'),
(6, 'test', 'hicoyir@g-mailix.com', '1'),
(7, 'ruse@mymail90.com', 'ruse@mymail90.com', 'ruse@mymail90.com'),
(8, 'vica@mail4gmail.com', 'vica@mail4gmail.com', 'vica@mail4gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_editors`
--
ALTER TABLE `admin_editors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_reply`
--
ALTER TABLE `comment_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_editors`
--
ALTER TABLE `admin_editors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comment_reply`
--
ALTER TABLE `comment_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
