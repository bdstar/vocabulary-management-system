-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2022 at 05:53 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vocabulary`
--

-- --------------------------------------------------------

--
-- Table structure for table `antonyms`
--

CREATE TABLE `antonyms` (
  `id` int(11) NOT NULL,
  `word_id` int(11) NOT NULL,
  `sword_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `synonyms`
--

CREATE TABLE `synonyms` (
  `id` int(11) NOT NULL,
  `word_id` int(11) NOT NULL,
  `sword_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `paragraph` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` varchar(20000) DEFAULT NULL,
  `iframe` varchar(1000) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `paragraph`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `paragraph_slug` (`slug`);

  ALTER TABLE `paragraph`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'IELTS', 'IELTS', 'International English Language Testing System', '2021-09-04 13:38:17', '2021-09-04 13:38:17'),
(2, 'GRE', 'GRE', 'Graduate Record Examinations', '2021-09-04 13:40:28', '2021-09-04 13:40:28'),
(3, 'TOEFL', 'TOEFL', 'Test of English as a Foreign Language', '2021-09-04 13:44:47', '2021-09-04 13:44:47'),
(4, 'SAT', 'SAT', 'SAT', '2021-09-04 13:45:50', '2021-09-04 13:45:50'),
(5, 'ETS', 'ETS', 'ETS', '2021-09-04 13:46:54', '2021-09-04 13:46:54'),
(6, 'Saifurs ', 'Saifurs ', 'Saifurs Vocabulary', '2021-09-04 13:47:01', '2021-09-04 13:47:01'),
(7, 'Cambridge', 'Cambridge', 'Cambridge IELTS', '2021-09-04 13:48:07', '2021-09-04 13:48:07'),
(9, 'Makkar IELTS', 'Makkar IELTS', 'Makkar IELTS', '2021-09-04 13:56:10', '2021-09-04 13:56:10'),
(10, 'Collins IELTS', 'Collins IELTS', 'Collins IELTS', '2021-09-04 13:57:07', '2021-09-04 13:57:07'),
(11, 'Barrons', 'Barrons', 'Barrons GRE Vocabulary', '2021-09-04 20:54:32', '2021-09-04 20:54:32'),
(12, 'Manhattan', 'Manhattan', 'Manhattan GRE ', '2021-09-04 20:55:03', '2021-09-04 20:55:03'),
(13, 'Major Test Vocabulary', 'Major Test Vocabulary', 'Major Test Vocabulary', '2021-09-04 20:56:07', '2021-09-04 20:56:07'),
(14, 'Big Book', 'Big Book', 'Big Book GRE', '2021-09-04 21:02:58', '2021-09-04 21:02:58');

-- --------------------------------------------------------

--
-- Table structure for table `tag_word`
--

CREATE TABLE `tag_word` (
  `tag_id` int(11) NOT NULL,
  `word_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `words`
--

CREATE TABLE `words` (
  `id` int(11) NOT NULL,
  `word` varchar(200) NOT NULL,
  `pos` enum('Noun','Pronoun','Adjective','Verb','Adverb','Preposition','Conjunction','Interjection') NOT NULL,
  `spelling` varchar(300) DEFAULT NULL,
  `utterance` varchar(300) DEFAULT NULL,
  `mnemonics` varchar(500) DEFAULT NULL,
  `smeaning` varchar(300) NOT NULL,
  `lmeaning` varchar(1000) NOT NULL,
  `sentence` varchar(1000) DEFAULT NULL,
  `picture` varchar(200) DEFAULT NULL,
  `meaning_number` int(11) NOT NULL DEFAULT 1,
  `past` varchar(100) DEFAULT NULL,
  `participle` varchar(100) DEFAULT NULL,
  `complete` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `words`
--

INSERT INTO `words` (`id`, `word`, `pos`, `spelling`, `utterance`, `mnemonics`, `smeaning`, `lmeaning`, `sentence`, `picture`, `meaning_number`, `past`, `participle`, `complete`, `created_at`, `updated_at`) VALUES
(1, 'Good', 'Noun', 'g-oo-d', 'gud', 'mnemonics', 'ভাল', 'that which is morally right; righteousness.', 'a mysterious balance of good and evil', NULL, 1, NULL, NULL, 0, '2021-09-09 22:57:12', '2021-09-09 22:57:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antonyms`
--
ALTER TABLE `antonyms`
  ADD KEY `antonyms_words` (`word_id`);

--
-- Indexes for table `synonyms`
--
ALTER TABLE `synonyms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `synonyms_words` (`word_id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tag_slug` (`slug`);

--
-- Indexes for table `tag_word`
--
ALTER TABLE `tag_word`
  ADD KEY `tag` (`tag_id`),
  ADD KEY `word` (`word_id`);

--
-- Indexes for table `words`
--
ALTER TABLE `words`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `synonyms`
--
ALTER TABLE `synonyms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `words`
--
ALTER TABLE `words`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `antonyms`
--
ALTER TABLE `antonyms`
  ADD CONSTRAINT `antonyms_words` FOREIGN KEY (`word_id`) REFERENCES `words` (`id`);

--
-- Constraints for table `synonyms`
--
ALTER TABLE `synonyms`
  ADD CONSTRAINT `synonyms_words` FOREIGN KEY (`word_id`) REFERENCES `words` (`id`);

--
-- Constraints for table `tag_word`
--
ALTER TABLE `tag_word`
  ADD CONSTRAINT `tag` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`),
  ADD CONSTRAINT `word` FOREIGN KEY (`word_id`) REFERENCES `words` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
