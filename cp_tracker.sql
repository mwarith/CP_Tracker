-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2024 at 06:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cp-tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_password`) VALUES
(1, 'root', 'root');

-- --------------------------------------------------------

--
-- Table structure for table `checked`
--

CREATE TABLE `checked` (
  `checked_id` int(11) NOT NULL,
  `checked_flag` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'material_url',
  `user_id` int(11) NOT NULL COMMENT 'material_url',
  `material_id` int(11) NOT NULL COMMENT 'material_url'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checked`
--

INSERT INTO `checked` (`checked_id`, `checked_flag`, `user_id`, `material_id`) VALUES
(20, 1, 1, 0),
(21, 1, 1, 5),
(22, 1, 1, 6),
(23, 0, 2, 0),
(24, 1, 2, 5),
(25, 1, 2, 6),
(26, 1, 2, 11),
(27, 1, 1, 11),
(28, 1, 0, 5),
(29, 0, 0, 11),
(30, 1, 4, 20),
(31, 1, 5, 20),
(32, 0, 5, 21),
(33, 0, 5, 23),
(34, 0, 4, 21),
(35, 0, 4, 23),
(36, 0, 6, 23),
(37, 0, 6, 21),
(38, 0, 6, 20),
(39, 1, 7, 20);

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `material_id` int(255) NOT NULL,
  `material_title` varchar(255) NOT NULL,
  `material_url` text NOT NULL,
  `topic_id` int(255) NOT NULL,
  `material_tag` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`material_id`, `material_title`, `material_url`, `topic_id`, `material_tag`) VALUES
(5, 'Fenwick', 'google.com', 1, NULL),
(6, 'mat', 'https://chatgpt.com/c/67643845-dac4-8011-ac66-c8a41ee33d5b', 2, NULL),
(11, 'code', 'code.com', 1, 'code'),
(15, 'code', 'code.com', 0, 'code'),
(17, 'Material 1', 'code.com', 13, 'Array'),
(18, 'Material 2', 'x.com', 13, 'Array'),
(19, 'Material 3', 'x.com', 13, 'Array'),
(20, 'Material 1', 'codeforces.com', 18, 'dp'),
(21, 'Material 1', 'codeforces.com', 19, 'graphs'),
(23, 'Material 1', 'codeforces.com', 20, 'trees');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `news_text` text NOT NULL,
  `news_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news_text`, `news_date`) VALUES
(11, 'new expert !!!!:Mohamed Waheed reched new rank after his outsanding performance.', '2024-12-23'),
(12, 'New Candidate Master:Mr.Turtle reached CM on Codeforces !!', '2024-12-23'),
(13, 'ElBo3Bo3 Team Has achievments:Reached ACPC 2 times on a row and did a great performance!', '2024-12-23');

-- --------------------------------------------------------

--
-- Table structure for table `problem`
--

CREATE TABLE `problem` (
  `problem_id` int(11) NOT NULL,
  `problem_title` varchar(255) NOT NULL,
  `problem_url` text NOT NULL,
  `topic_id` int(11) NOT NULL,
  `problem_tag` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `problem`
--

INSERT INTO `problem` (`problem_id`, `problem_title`, `problem_url`, `topic_id`, `problem_tag`) VALUES
(1, 'AND Queries', 'https://codeforces.com/', 1, 'abcdefg'),
(3, 'test', 'google.com', 2, NULL),
(10, 'Codeforces', 'codeforces.com', 0, 'codeforces'),
(14, 'Problem1', 'code.com', 13, 'Array'),
(15, 'Problem2 ', 'code.com', 13, 'Array'),
(16, 'Problem3', 'code.com', 13, 'Array'),
(17, 'Problem4', 'x.com', 13, 'Array'),
(18, 'Problem5', 'x.com', 13, 'Array'),
(19, 'problem1', 'x.com', 18, 'dp'),
(20, 'problem2', 'x.com', 18, 'dp'),
(21, 'Problem3', 'codeforces.com', 18, 'dp'),
(22, 'Problem1', 'codeforces.com', 19, 'graphs'),
(23, 'Problem2 ', 'codeforces.com', 19, 'graphs'),
(24, 'Problem3', 'codeforces.com', 19, 'graphs'),
(25, 'problem1', 'codeforces.com', 20, 'trees'),
(26, 'Problem2 ', 'code', 20, 'trees'),
(27, 'Problem3', 'codeforces.com', 20, 'trees');

-- --------------------------------------------------------

--
-- Table structure for table `solved`
--

CREATE TABLE `solved` (
  `solved_id` int(11) NOT NULL,
  `solved_flag` int(1) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `problem_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `solved`
--

INSERT INTO `solved` (`solved_id`, `solved_flag`, `user_id`, `problem_id`) VALUES
(5, 1, 1, 1),
(6, 3, 1, 2),
(7, 1, 1, 3),
(8, 3, 2, 1),
(9, 1, 2, 2),
(10, 1, 2, 3),
(11, 1, 2, 8),
(12, 0, 2, 4),
(13, 1, 1, 8),
(14, 1, 0, 1),
(15, 1, 4, 19),
(16, 2, 4, 20),
(17, 3, 4, 21),
(18, 1, 5, 19),
(19, 1, 5, 20),
(20, 2, 5, 21),
(21, 1, 5, 22),
(22, 3, 5, 23),
(23, 3, 5, 24),
(24, 3, 5, 25),
(25, 3, 5, 26),
(26, 1, 5, 27),
(27, 1, 4, 22),
(28, 1, 4, 23),
(29, 2, 4, 24),
(30, 1, 4, 25),
(31, 3, 4, 26),
(32, 3, 4, 27),
(33, 1, 6, 25),
(34, 1, 6, 26),
(35, 3, 6, 27),
(36, 1, 6, 22),
(37, 1, 6, 23),
(38, 1, 6, 24),
(39, 1, 6, 19),
(40, 3, 6, 20),
(41, 3, 6, 21),
(42, 1, 7, 19),
(43, 2, 7, 20),
(44, 3, 7, 21);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `team_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`, `coach_id`, `team_url`) VALUES
(0, 'user', 0, 'google.com');

-- --------------------------------------------------------

--
-- Table structure for table `team_coach`
--

CREATE TABLE `team_coach` (
  `team_coach_id` int(11) NOT NULL,
  `team_coach_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_coach`
--

INSERT INTO `team_coach` (`team_coach_id`, `team_coach_name`) VALUES
(0, 'Waheed'),
(0, 'Thaer'),
(0, 'Men3m'),
(0, 'Mostafa Adel'),
(0, 'Mohamed Alaa');

-- --------------------------------------------------------

--
-- Table structure for table `team_member`
--

CREATE TABLE `team_member` (
  `team_member_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `team_member_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_member`
--

INSERT INTO `team_member` (`team_member_id`, `team_id`, `team_member_name`) VALUES
(0, 0, 'ahmed'),
(0, 0, 'ahmed'),
(0, 0, 'mohamed');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `topic_id` int(255) NOT NULL,
  `topic_name` varchar(255) NOT NULL,
  `topic_img` varchar(255) NOT NULL,
  `topic_description` text NOT NULL,
  `topic_level` int(1) NOT NULL,
  `topic_sub` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_name`, `topic_img`, `topic_description`, `topic_level`, `topic_sub`) VALUES
(13, 'Array', '5299array.png', 'List of data', 1, 'array, sort, 2D array'),
(14, 'Loops', '2264loops.png', 'iterating over data and make some operations to solve problems', 1, 'for, while, nested loops'),
(15, 'Binary Search', '5544bs.png', 'Searching in a sorted data container to find the answer', 2, 'Binary search on answer, dealing with doubles'),
(16, 'Bitmasks', '1644bitmask.png', 'How to deal with bits and manipulate operations with it', 2, 'AND, OR, XOR tips and tricks, Bitset'),
(17, 'Recursion& Backtracking', '4479recursion.png', 'Recursive Functions, dealing with them to divide the problems and solve', 2, '8 Queens'),
(18, 'Dynamic Programming', '1113dp.jpeg', 'Solve recurrence in a Perfect Time Complexity', 3, 'DP recursive, iterative, digits, bitmasks'),
(19, 'Graphs', '3228graph.png', 'Dealing with graphs and solve problems on a different types of graphs', 3, 'DFS, BFS, Dijkstra, Bellman Ford, DSU, Floyd'),
(20, 'Trees', '2241trees.png', 'Trees and its good algorithms', 3, 'LCA, HLD, Centroid Decomposition, MO on Trees, DSU on Trees');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(255) NOT NULL,
  `user_username` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_level` int(1) NOT NULL COMMENT '1=>Level one 2=> Level two 3=> Level three',
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_email`, `user_password`, `user_level`, `is_admin`) VALUES
(2, 'root', 'root', 'root', 3, 1),
(3, 'Mahmoud91', 'nana@poku.com', 'abc', 3, 0),
(4, 'Thaer', 'thaer@a.com', 'thaer', 3, 0),
(5, 'warith', 'warith@a.com', 'warith', 3, 0),
(6, 'waheed', 'waheed@a.com', 'waheed', 3, 0),
(7, 'Mwaheed', 'waheed@gmail.com', 'root', 3, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_username` (`admin_username`);

--
-- Indexes for table `checked`
--
ALTER TABLE `checked`
  ADD PRIMARY KEY (`checked_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `material_id` (`material_id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`material_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `problem`
--
ALTER TABLE `problem`
  ADD PRIMARY KEY (`problem_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `solved`
--
ALTER TABLE `solved`
  ADD PRIMARY KEY (`solved_id`),
  ADD KEY `problem_id` (`problem_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `checked`
--
ALTER TABLE `checked`
  MODIFY `checked_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `material_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `problem`
--
ALTER TABLE `problem`
  MODIFY `problem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `solved`
--
ALTER TABLE `solved`
  MODIFY `solved_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
