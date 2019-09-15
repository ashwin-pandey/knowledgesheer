-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 15, 2019 at 04:52 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `knowledgesheer`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `comment_id` int(11) NOT NULL,
  `comment_post_id` int(11) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_likes`
--

CREATE TABLE `blog_likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `post_id` int(11) NOT NULL,
  `post_category_id` int(11) NOT NULL,
  `post_sub_cat_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_description` text NOT NULL,
  `post_comment_count` varchar(255) NOT NULL,
  `post_status` varchar(255) NOT NULL,
  `post_slug` varchar(255) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` text NOT NULL,
  `cat_description` text NOT NULL,
  `cat_image` text NOT NULL,
  `cat_slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`, `cat_description`, `cat_image`, `cat_slug`) VALUES
(1, 'Technology', 'Description of technology...', 'ph-100x100.png', ''),
(2, 'India', 'India Description...', 'ph-100x100.png', ''),
(3, 'New Category', 'New category description...', 'ph-100x100.png', 'new-category');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `quote_id` int(11) NOT NULL,
  `quote_image` text NOT NULL,
  `quote_date` date NOT NULL,
  `quote_content` text NOT NULL,
  `quote_hashtags` text NOT NULL,
  `quote_category` text NOT NULL,
  `quote_author` text NOT NULL,
  `likes` int(11) NOT NULL,
  `dislikes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quote_categories`
--

CREATE TABLE `quote_categories` (
  `quote_cat_id` int(11) NOT NULL,
  `quote_cat_title` varchar(255) NOT NULL,
  `quote_cat_desc` text NOT NULL,
  `quote_cat_image` text NOT NULL,
  `quote_cat_slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quote_categories`
--

INSERT INTO `quote_categories` (`quote_cat_id`, `quote_cat_title`, `quote_cat_desc`, `quote_cat_image`, `quote_cat_slug`) VALUES
(1, 'First Quote Category', 'First Quote Category', 'ph-100x100.png', 'first-quote-category'),
(2, 'Second Category', 'Second Quote Category', 'ph-100x100.png', 'second-category');

-- --------------------------------------------------------

--
-- Table structure for table `quote_likes`
--

CREATE TABLE `quote_likes` (
  `id` int(11) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `sub_cat_id` int(11) NOT NULL,
  `sub_cat_title` text NOT NULL,
  `parent_cat_id` int(11) NOT NULL,
  `sub_cat_description` text NOT NULL,
  `sub_cat_image` text NOT NULL,
  `sub_cat_slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`sub_cat_id`, `sub_cat_title`, `parent_cat_id`, `sub_cat_description`, `sub_cat_image`, `sub_cat_slug`) VALUES
(1, 'PHP Tutorials', 1, 'PHP Description...', 'ph-100x100.png', 'php-tutorials'),
(2, 'Java', 1, 'Java Description...', 'ph-100x100.png', ''),
(3, 'New Sub Category', 2, 'New Sub Category Description...', 'ph-100x100.png', 'new-sub-category');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` text NOT NULL,
  `user_lastname` text NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `user_description` text NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22',
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `user_description`, `randSalt`, `token`) VALUES
(1, 'ashwin', '$1$D9YTTMda$96nY5gB72T/jRZDOWlZid/', 'Ashwin', 'Pandey', 'ashwin@knowledgesheer.com', 'portrait.png', 'admin', 'Hello there...', '$2y$10$iusesomecrazystrings22', ''),
(2, 'ashwin2', '$2y$10$iusesomecrazystrings2uZPDPgQbE4mPf23XG0OdXGRV4xVKX60m', 'Ashwin', 'Pandey', 'ashwinpandey011197@gmail.com', '', 'admin', '', '$2y$10$iusesomecrazystrings22', ''),
(3, 'ashwin3', '$2y$10$iusesomecrazystrings2uZPDPgQbE4mPf23XG0OdXGRV4xVKX60m', 'Ashwin', 'Pandey', 'ashwinpandey011197@gmail.com', 'ph-100x100.png', 'editor', '', '$2y$10$iusesomecrazystrings22', ''),
(4, 'ashwin4', '$2y$10$iusesomecrazystrings2uZPDPgQbE4mPf23XG0OdXGRV4xVKX60m', 'Ashwin', 'Pandey', 'example@gmail.com', '', 'subscriber', '', '$2y$10$iusesomecrazystrings22', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `role_id` int(11) NOT NULL,
  `role_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`role_id`, `role_title`) VALUES
(1, 'admin'),
(2, 'subscriber'),
(3, 'editor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `blog_likes`
--
ALTER TABLE `blog_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`quote_id`);

--
-- Indexes for table `quote_categories`
--
ALTER TABLE `quote_categories`
  ADD PRIMARY KEY (`quote_cat_id`);

--
-- Indexes for table `quote_likes`
--
ALTER TABLE `quote_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `quote_id` (`quote_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`sub_cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_likes`
--
ALTER TABLE `blog_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `quote_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quote_categories`
--
ALTER TABLE `quote_categories`
  MODIFY `quote_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quote_likes`
--
ALTER TABLE `quote_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `sub_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
