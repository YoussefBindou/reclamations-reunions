-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2023 at 01:49 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app`
--

-- --------------------------------------------------------

--
-- Table structure for table `bureau`
--

CREATE TABLE `bureau` (
  `id_Bureau` int(6) NOT NULL,
  `Bureau_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bureau`
--

INSERT INTO `bureau` (`id_Bureau`, `Bureau_name`) VALUES
(26, 'Bureau 1'),
(23, 'Bureau 2'),
(25, 'Bureau 3'),
(14, 'DSI');

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `categorie_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `categorie_name`) VALUES
(4, 'aaa'),
(10, 'aaaaa'),
(12, 'zazaz'),
(2, 'zzzzz');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` int(11) NOT NULL,
  `date_reunion` date NOT NULL,
  `heure_reunion` time NOT NULL,
  `objet` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `duree` varchar(50) NOT NULL,
  `local` varchar(100) NOT NULL,
  `vote_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `date_reunion`, `heure_reunion`, `objet`, `detail`, `duree`, `local`, `vote_id`) VALUES
(40, '2023-06-15', '23:50:00', 'gegg', 'yutyutèzzz', 'utrf', 'kjkk', NULL),
(41, '2023-06-17', '15:11:00', 'test', 'ezeezez', 'dzdz', 'zeze', NULL),
(42, '2023-06-29', '20:18:00', 'test', 'test test', '1h', 'test', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `id` int(11) NOT NULL,
  `date_enregistrement` date DEFAULT NULL,
  `type_demande` varchar(10) DEFAULT NULL,
  `categorie` int(11) NOT NULL,
  `resume_demande` varchar(255) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `fichier_attache` varchar(255) DEFAULT NULL,
  `priorite` varchar(10) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `repons` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `supportextern`
--

CREATE TABLE `supportextern` (
  `id` int(11) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `adresse` varchar(200) NOT NULL,
  `date_enregistrement` date NOT NULL,
  `type_demande` varchar(20) NOT NULL,
  `resume_demande` varchar(100) NOT NULL,
  `detail` text NOT NULL,
  `priorite` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supportextern`
--

INSERT INTO `supportextern` (`id`, `prenom`, `nom`, `email`, `phone`, `adresse`, `date_enregistrement`, `type_demande`, `resume_demande`, `detail`, `priorite`) VALUES
(1, 'ezezez', 'ezezez', 'ezeze@oo', 'ezezez', 'ezezez', '2023-06-06', 'demande', 'eezez', 'ezzeez', 'moyenne'),
(2, 'ezezez', 'ezezez', 'ezeze@oo', 'ezezez', 'ezezez', '2023-06-06', 'demande', 'eezez', 'ezzeez', 'moyenne'),
(3, 'ezezez', 'ezezez', 'ezeze@oo', 'ezezez', 'ezezez', '2023-06-06', 'demande', 'eezez', 'ezzeez', 'moyenne'),
(4, 'youssef7777', 'admin', 'aaaa@oa', 'aaaa@oop', 'aaa', '2023-06-06', 'support', 'aaa', 'aaa', 'haut'),
(5, 'youssef7777', 'admin', 'aaaa@oa', 'aaaa@oop', 'aaa', '2023-06-06', 'support', 'aaa', 'aaa', 'haut'),
(6, 'youssef7777', 'admin', 'aaaa@oa', 'aaaa@oop', 'aaa', '2023-06-06', 'support', 'aaa', 'aaa', 'haut'),
(8, 'youssef7777', 'admin', 'aaaa@oa', 'aaaa@oop', 'aaa', '2023-06-06', 'support', 'aaa', 'aaa', 'haut'),
(9, 'youssef7777', 'admin', 'aaaa@oa', 'aaaa@oop', 'aaa', '2023-06-06', 'support', 'aaa', 'aaa', 'haut'),
(10, 'youssef7777', 'admin', 'aaaa@oa', 'aaaa@oop', 'aaa', '2023-06-06', 'support', 'aaa', 'aaa', 'haut'),
(11, 'youssef7777', 'admin', 'aaaa@oa', 'aaaa@oop', 'aaa', '2023-06-06', 'support', 'aaa', 'aaa', 'haut'),
(12, 'youssef7777', 'admin', 'aaaa@oa', 'aaaa@oop', 'aaa', '2023-06-06', 'support', 'aaa', 'aaa', 'haut'),
(13, 'youssef7777', 'admin', 'aaaa@oa', 'aaaa@oop', 'aaa', '2023-06-06', 'support', 'aaa', 'aaa', 'haut'),
(14, 'youssef7777', 'admin', 'aaaa@oa', 'aaaa@oop', 'aaa', '2023-06-06', 'support', 'aaa', 'aaa', 'haut'),
(15, 'yousse55f', 'bindou', 'youssefbindouu@gmail.com', '+212625203733', 'hay hassani Nr1009 Dakhla', '2023-06-06', 'demande', 'aaaaaaa', '5757', 'bloquant'),
(17, 'youssef', 'bindou', 'youssefbindouu@gmail.com', '+212625203733', 'hay hassani Nr1009 Dakhla', '2023-06-06', 'demande', 'aaaaaaa', '5757', 'bloquant'),
(18, 'said', 'zdz', 'zezezez@ufdzd.4j', '8686868686', 'ezezez', '2023-06-08', 'demande', 'sss', 'teeztzet', 'moyenne'),
(20, 'youssef', 'bindou', 'youssefbindouu@gmail.com', '+212625203733', 'hay hassani Nr1009 Dakhla', '2023-06-15', 'support', 'azzz', 'eze', 'haut'),
(21, 'ezeze', 'ezeze', 'zezez@dsdsf.2j', 'ezeze', 'zezeze', '2023-06-15', 'support', 'zeze', 'zezez', 'haut'),
(22, 'youssef', 'bindou', 'youssefbindouu@gmail.com', '+212625203733', 'hay hassani Nr1009 Dakhla', '2023-06-15', 'support', 'zeze', 'zea', 'haut'),
(23, 'youssef', 'bindou', 'youssefbindouu@gmail.com', '+212625203733', 'hay hassani Nr1009 Dakhla', '2023-06-15', 'demande', 'ezez', 'ezez', 'bas'),
(24, 'youssef', 'bindou', 'youssefbindouu@gmail.com', '+212625203733', 'hay hassani Nr1009 Dakhla', '2023-06-19', 'support', 'ttrtrt', 'ferteret', 'haut'),
(25, 'youssef', 'bindou', 'youssefbindouu@gmail.com', '+212625203733', 'hay hassani Nr1009 Dakhla', '2023-06-22', 'support', 'rrrrr', 'fthukuthy', 'moyenne');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `Sexe` varchar(10) NOT NULL,
  `Bureau` int(6) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Telephone` varchar(15) NOT NULL,
  `USER` varchar(10) NOT NULL,
  `PASS` varchar(100) NOT NULL,
  `admin_y_n` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `Sexe`, `Bureau`, `Email`, `Telephone`, `USER`, `PASS`, `admin_y_n`) VALUES
(93, 'gorssa', 'mohamad', 'Male', 14, 'youssefbindouu@gmail.c', '+212625203733', 'admin', '12345', 2),
(94, 'youssef', 'youssef', 'Male', 14, 'youssefbindouu@gmail.com', '+212625203733', '99', '99', 1),
(95, 'Bindou', 'anass', 'Male', 14, 'youssefbindouzzzu@gmail.com', '+212625203733', '111', '111', 0);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `id_meeting` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `id_meeting`, `id_user`) VALUES
(9, 41, 93),
(10, 40, 93),
(11, 42, 95);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bureau`
--
ALTER TABLE `bureau`
  ADD PRIMARY KEY (`id_Bureau`),
  ADD UNIQUE KEY `Bureau_name` (`Bureau_name`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`),
  ADD UNIQUE KEY `categorie_name` (`categorie_name`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rt` (`id_user`),
  ADD KEY `categorie` (`categorie`);

--
-- Indexes for table `supportextern`
--
ALTER TABLE `supportextern`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `Bureau` (`Bureau`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_meeting` (`id_meeting`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bureau`
--
ALTER TABLE `bureau`
  MODIFY `id_Bureau` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `supportextern`
--
ALTER TABLE `supportextern`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `meetings`
--
ALTER TABLE `meetings`
  ADD CONSTRAINT `meetings_ibfk_1` FOREIGN KEY (`vote_id`) REFERENCES `vote` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `support`
--
ALTER TABLE `support`
  ADD CONSTRAINT `rt` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `support_ibfk_1` FOREIGN KEY (`categorie`) REFERENCES `categorie` (`id_categorie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`Bureau`) REFERENCES `bureau` (`id_Bureau`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`id_meeting`) REFERENCES `meetings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
