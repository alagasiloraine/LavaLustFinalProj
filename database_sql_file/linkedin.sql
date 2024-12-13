-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 13, 2024 at 03:31 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `linkedin`
--

-- --------------------------------------------------------

--
-- Table structure for table `employers`
--

CREATE TABLE `employers` (
  `employer_id` int NOT NULL,
  `user_id` int NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `company_address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact_info` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `profile_picture` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employers`
--

INSERT INTO `employers` (`employer_id`, `user_id`, `company_name`, `company_address`, `contact_info`, `profile_picture`, `created_at`) VALUES
(1, 4, 'Tech Corp updated ', '123 Tech Street, Silicon Valley', '12345678', 'e1ba8d0b8e2cc78b96a50448bc1038c848ccc9d6.jpg', '2024-11-29 11:46:45');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int NOT NULL,
  `employer_id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `requirements` text COLLATE utf8mb4_general_ci,
  `location` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `job_type` enum('full-time','part-time','remote') COLLATE utf8mb4_general_ci NOT NULL,
  `salary` int NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `posted_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_general_ci DEFAULT 'active',
  `inactive_timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `employer_id`, `title`, `description`, `requirements`, `location`, `job_type`, `salary`, `category`, `posted_at`, `updated_at`, `status`, `inactive_timestamp`) VALUES
(5, 1, 'test version 3 update update ule', 'test', 'test', 'hindi na test', 'full-time', 1, 'Software Development', '2024-11-20 02:32:22', '2024-12-10 01:45:57', 'active', NULL),
(6, 1, 'test update uli? and again again again', 'test ', 'test', 'test', 'full-time', 1, 'Software Development', '2024-11-20 02:33:25', '2024-12-09 21:16:31', 'active', NULL),
(7, 1, 'employer job post update', 'ito ay post n employer', 'walang requirements', 'sa may kanto lang', 'full-time', 2, 'Data & Analytics', '2024-11-20 02:34:14', '2024-11-29 15:38:52', 'active', NULL),
(10, 1, 'test update', 'test', 'test', 'test', 'full-time', 1234, 'Artificial Intelligence & Machine Learning', '2024-11-23 11:17:40', '2024-11-29 15:39:01', 'active', '2024-11-27 20:16:59'),
(11, 1, 'test', 'test', 'test', 'test', 'full-time', 1234, 'Cloud Computing & DevOps', '2024-11-27 02:24:15', '2024-11-29 15:39:12', 'active', NULL),
(12, 1, 'employer 2 job post', 'ito ay job post ng another employer', 'wertyui', 'ertyu', 'full-time', 234567, 'Cybersecurity', '2024-11-27 11:55:38', '2024-11-29 15:39:22', 'active', NULL),
(13, 1, 'test', 'fghjkl', 'fghjkl', '456789', 'full-time', 45678, 'IT Infrastructure & Networking', '2024-11-27 15:32:57', '2024-11-29 15:39:30', 'active', NULL),
(14, 1, 'test', 'test', 'test', 'test', 'full-time', 56789, 'Software Development', '2024-12-08 09:43:26', NULL, 'active', NULL),
(15, 1, 'test again', 'test', 'test', 'test', 'full-time', 678789, 'Software Development', '2024-12-08 10:33:24', NULL, 'active', NULL),
(16, 1, 'Data Analyst', 'This is for IT Professional Only', 'You must have a 2-3years of experience.', 'California', 'remote', 125, 'Data & Analytics', '2024-12-13 05:05:18', NULL, 'active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` int NOT NULL,
  `job_id` int NOT NULL,
  `jobseeker_id` int NOT NULL,
  `employer_id` int NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `resume` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `interview_date` date DEFAULT NULL,
  `interview_time` time DEFAULT NULL,
  `applied_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`id`, `job_id`, `jobseeker_id`, `employer_id`, `first_name`, `last_name`, `email`, `resume`, `status`, `interview_date`, `interview_time`, `applied_at`, `updated_at`) VALUES
(2, 6, 1, 1, 'test application ', 'test_add', 'application@gmail.com', '340470183c37cd06fd2d56fe638522cf52c3959b.docx', 'Applied', NULL, NULL, '2024-11-23 05:09:43', '2024-12-13 05:19:05'),
(3, 7, 1, 1, 'test update again', 'test_add', 'test@gmail.com', 'd2a1016978953fa785d65c60039e5865bafe152d.docx', 'Hired', NULL, NULL, '2024-11-23 06:42:16', '2024-11-27 22:31:54'),
(4, 5, 1, 1, 'test', 'test_add', 'testing@gmail.com', NULL, 'Scheduled', '2024-11-28', '10:31:00', '2024-11-27 02:25:15', '2024-11-27 02:31:24'),
(5, 5, 2, 1, 'test update', 'test', 'test@gmail.com', '666e3f83e2c8a643e7fe87f147968ad36dbf6c12.docx', 'Applied', NULL, NULL, '2024-11-27 15:58:21', NULL),
(6, 7, 2, 1, 'John Doe', 'Evans', 'johndoe@gmail.com', NULL, 'Applied', NULL, NULL, '2024-11-27 19:20:18', NULL),
(7, 10, 2, 1, 'test apply', 'test', 'test@gmail.com', NULL, 'Applied', NULL, NULL, '2024-11-30 02:18:35', NULL),
(8, 11, 2, 1, 'test apply', 'test', 'test@gmail.com', NULL, 'Applied', NULL, NULL, '2024-11-30 02:26:45', NULL),
(9, 11, 1, 1, 'teating the apply form', 'test', 'perjescykean356@gmail.com', '828fd8b277ef284c17808ebf704404b406aa693a.docx', 'Applied', NULL, NULL, '2024-12-13 05:00:56', NULL),
(10, 16, 1, 1, 'Loraine', 'Alagasi', 'alagasilorain@gmail.com', '530ffdd4ffda45f417f566ac74b1a988e85ce6c2.docx', 'Applied', NULL, NULL, '2024-12-13 05:06:39', NULL),
(11, 15, 1, 1, 'Cy Kean', 'Perjes', 'cyperjes@gmail.com', 'b4f30a0004ab6e8da011c6893ed5be5b2328a647.docx', 'Applied', NULL, NULL, '2024-12-13 14:36:50', NULL),
(12, 10, 2, 1, 'Cy Kean', 'Perjes', 'cyperjes@gmail.com', 'ac9577d035fed93d9862fd45d244c1a5748db937.docx', 'Applied', NULL, NULL, '2024-12-13 15:59:05', NULL),
(13, 16, 2, 1, 'Cy Kean', 'Perjes', 'cyperjes@gmail.com', '1f43f9ea145d9f829f3595152467b9e40024c5f6.docx', 'Applied', NULL, NULL, '2024-12-13 16:14:58', NULL),
(14, 6, 2, 1, 'Cy Kean', 'Perjes', 'cyperjes@gmail.com', '5fe228cb90c4558af362a5c1ad4423c739ca5f51.docx', 'Cancelled', NULL, NULL, '2024-12-13 16:20:56', '2024-12-13 16:23:26'),
(15, 6, 2, 1, 'Cy Kean', 'Perjes', 'cyperjes@gmail.com', '5572f32d6e7d4f978a4c018d3d23299b77308ca1.docx', 'Applied', NULL, NULL, '2024-12-13 16:23:43', NULL),
(16, 15, 2, 1, 'Cy Kean', 'Perjes', 'cyperjes@gmail.com', 'd67b89aab85d23985aace987e7d406b406cb55b4.docx', 'Applied', NULL, NULL, '2024-12-13 16:26:46', NULL),
(17, 12, 1, 1, 'Cy Kean', 'Perjes', 'cyperjes@gmail.com', '4a830218e595c9c20d6530b94c4ab6457643e49d.docx', 'Applied', NULL, NULL, '2024-12-13 16:28:22', NULL),
(18, 10, 1, 1, 'Cy Kean', 'Perjes', 'cyperjes@gmail.com', 'efca7965e6fadb54b67d478c2706837d5e3fd894.docx', 'Applied', NULL, NULL, '2024-12-13 16:30:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_seekers`
--

CREATE TABLE `job_seekers` (
  `seeker_id` int NOT NULL,
  `user_id` int NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `resume` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_general_ci,
  `skills` text COLLATE utf8mb4_general_ci,
  `phone` int DEFAULT NULL,
  `education` text COLLATE utf8mb4_general_ci,
  `experience` text COLLATE utf8mb4_general_ci,
  `availability` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `profile_picture` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_seekers`
--

INSERT INTO `job_seekers` (`seeker_id`, `user_id`, `full_name`, `resume`, `location`, `bio`, `skills`, `phone`, `education`, `experience`, `availability`, `profile_picture`, `created_at`) VALUES
(1, 3, 'Loraine', '5faf2fe48ef42492ca41ab3a7ad4b96952565f11.docx', 'Baco', 'gandaa hehe', 'Networking', 987654321, 'College Graduate', '2-3 years experience in Networking', 'available', '4647413078b7f8bcda03156f8a246b0d08eef535.jpg', '2024-11-29 11:47:31'),
(2, 6, 'test', 'b64271478db76ef546979246d5522726c4492d49.pdf', 'test', 'test', 'test', 987654321, 'test', 'test', 'available', 'a24d45eec90b2ae6c62465c913ab140c191a5b58.png', '2024-11-28 11:47:39');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `reset_token` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`id`, `email`, `reset_token`, `created_on`) VALUES
(1, 'perjescykean35@gmail.com', '65kWGb9rD7', '2024-12-05 11:09:17'),
(2, 'perjescykean35@gmail.com', 'FWDGxmbz6Z', '2024-12-05 11:17:13'),
(3, 'perjescykean35@gmail.com', 'IhsJGXcgv8', '2024-12-05 11:24:59'),
(4, 'perjescykean35@gmail.com', '6wMnotYSdI', '2024-12-05 11:32:03'),
(5, 'perjescykean35@gmail.com', 'k2GeVIThM1', '2024-12-05 11:33:42'),
(6, 'perjescykean35@gmail.com', 'GxgmQ536i2', '2024-12-05 11:37:20'),
(7, 'perjescykean35@gmail.com', 'Y9fT7nR5hL', '2024-12-05 11:39:15'),
(8, 'perjescykean35@gmail.com', '1jM94ve3Uk', '2024-12-05 11:39:29'),
(9, 'perjescykean35@gmail.com', 'zE5K9tGI3O', '2024-12-05 11:40:16'),
(10, 'perjescykean35@gmail.com', 'qRYszv0rLK', '2024-12-05 11:41:24'),
(11, 'perjescykean35@gmail.com', 'bCgW6dHBA3', '2024-12-05 11:48:26'),
(12, 'perjescykean35@gmail.com', 'ns84zDt9ry', '2024-12-05 11:49:44');

-- --------------------------------------------------------

--
-- Table structure for table `saved_jobs`
--

CREATE TABLE `saved_jobs` (
  `id` int NOT NULL,
  `job_id` int NOT NULL,
  `jobseeker_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saved_jobs`
--

INSERT INTO `saved_jobs` (`id`, `job_id`, `jobseeker_id`, `created_at`) VALUES
(54, 6, 2, '2024-12-13 08:18:09');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` int NOT NULL,
  `user_id` int NOT NULL,
  `browser` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ip` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `session_data` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `user_id`, `browser`, `ip`, `session_data`, `created_at`) VALUES
(17, 4, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', '::1', 'fb15fb74f29a7c9979f95a7db3bca5894772e6ac50da9f91e3db198705f0b0d1', '2024-11-13 05:59:24'),
(26, 4, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', '::1', '1ebece43faa515813155b1d7dce60d424a1c727002076c88c852c33818cbe14d', '2024-11-20 09:54:42'),
(55, 3, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', '::1', 'd50ca65b4d5225965a00915dd1f4bf790b1c91d498400f9e8fe9062b27ff497d', '2024-11-23 23:41:52'),
(58, 7, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', '::1', '801065587b77c3b8ffc9fe4aa19c59b571c9c7bc92a7585c4e5dbdce0643095b', '2024-11-25 09:08:12'),
(60, 7, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', '::1', 'ce2d24d693ceaca99af41e7850efb58b25844092e9352e9fe16d26cdc075754c', '2024-11-25 09:09:21'),
(62, 7, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', '::1', 'bec324d129307ba7e4a77ba309087459f7d4ed31cd0fac4561d672bec8d249ad', '2024-11-25 09:13:32'),
(69, 3, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', '::1', '5d2c06d956abe05e1fc363258ffa042fca2623984526b96d14bf84406c1ef17a', '2024-11-25 10:20:21'),
(70, 3, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', 'fa398616d28f405562c60400ed057706194350e23af8c84c57803bf7a7830867', '2024-11-25 11:54:40'),
(80, 4, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', 'c2d55a325b6586a68178241d98fa8c86f4be642cb2e5c4894c739b94e2ff0106', '2024-11-27 09:10:39'),
(89, 5, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', '::1', 'd428fccbded8c7d9a228f8d49724d81f3c37b9eb320e0f3fd65071fd8c19c1c7', '2024-11-27 19:52:04'),
(90, 5, 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36 Edg/131.0.0.0', '::1', 'e124f86860988331b611effb10db50b485b51e73b6efe9f70b57556e59410e11', '2024-11-27 20:23:38'),
(138, 3, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '019efe7f52e199e009102c2f89b767fd985280cf57f62238fe391bd1fce49fad', '2024-12-05 13:42:52'),
(155, 4, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '16430a190c34801105c3b7def02a8d7c82fc9b477496f6640242c84627f28003', '2024-12-08 16:23:02'),
(162, 7, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', '::1', '9c322d20473ce246579dff582f15e34a67bb33790e8f81f05af0cb18f1130970', '2024-12-10 18:48:36'),
(164, 4, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '173fdab7aa5524c30c013e3937ad70606f0ad3926e6e2a3271003f18947f98b6', '2024-12-11 08:59:16'),
(177, 4, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', 'ce9f6c94e32a0545b0fd7fd71f4c1080f58f3dd5a5ab61715a1f85f09c1591d8', '2024-12-13 20:30:51'),
(179, 3, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', '::1', 'f4fcb3dfdbe426697c2a4d99b16c3a8a812676ab44d772a7ca391df62328aafe', '2024-12-13 23:27:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `google_oauth_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'active',
  `isVerified` enum('0','1') COLLATE utf8mb4_general_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_token`, `email_verified_at`, `password`, `role`, `remember_token`, `google_oauth_id`, `created_at`, `updated_at`, `status`, `isVerified`) VALUES
(3, 'JobSeeker', 'jobseeker@gmail.com', '4ef9c6553ca4d05553f78f2ec3d2955b592d76237db9555bf75a00745f3a6fce59e5da545ffdaed7e96fee5884ee1e6c84aa', '2024-12-05 02:45:23', '$2y$04$hZMGDiFHp/9J8gEzufp6puY4R9RH2NQZeliBK81pFVs6d9QVS30Si', 'jobseeker', NULL, NULL, '2024-11-12 11:58:11', '2024-12-05 02:45:41', 'active', '1'),
(4, 'Employer', 'employer@gmail.com', '9570288edab910225e4265ab09e374339d073eb246b6a75d8b41c03534cc806809034e623595d7a468e3a104fab97a4a516a', '2024-12-05 02:39:35', '$2y$04$Js4OUi1WHvrW9glVoDkWJelrH9Ilsl.E0IBEATYdz6iqunSB3AM.6', 'employer', NULL, NULL, '2024-11-12 14:09:24', '2024-12-05 02:39:43', 'active', '1'),
(5, 'employer2', 'employer2@gmail.com', '35d2cc43b498b2793957b43249d66638c5879862e3003339ba384a1046c1822154f5c3bc9e88764abd10977173615c99c2fd', NULL, '$2y$04$OGGWuMT9E5uQB6XX9ofDa.TytuaYfsaicEXlxhCNAQAyvIF3JkNXK', 'employer', NULL, NULL, '2024-11-21 10:47:52', '2024-11-28 10:58:13', 'active', '0'),
(6, 'jobseeker2', 'jobseeker2@gmail.com', NULL, '2024-12-13 14:35:44', '$2y$04$T/lfrYwR.46JXVHnmebka.Q41tArGAaSq5byljDTdch1HkFtRZ9YO', 'jobseeker', NULL, NULL, '2024-11-21 10:58:55', '2024-12-13 14:35:57', 'active', '1'),
(7, 'admin', 'admin@gmail.com', 'f60e37be82372fc671d9007e9ee8aefe0bed30b68a0c1b6517ffb661df4c33eaeb445da6bad8dd9e400dd3e11998abf31303', NULL, '$2y$04$ukbXmiKZxR7aukp4I4fkjeWn3YE7jOgEKL6Vsn6/7s9dJCJXVIzwG', 'admin', NULL, NULL, '2024-11-25 00:54:07', '2024-12-05 06:52:18', 'active', '1'),
(8, 'JobSeeker3', 'jobseeker3@gmail.com', NULL, '2024-12-05 06:52:26', '$2y$04$WC7Lk0k3BcKoKWzxiAejSuH/obtfVrhfPCT/DHqUnvIjfz8SCF8bG', 'jobseeker', NULL, NULL, '2024-11-28 11:50:45', '2024-12-05 06:52:37', 'inactive', '0'),
(14, 'testuse', 'perjescykean35@gmail.com', NULL, '2024-11-29 21:28:18', '$2y$04$Rzy7Xkvz0BIOiiuZBTANue2eXUMnriIjgHG7zTqCM4fpsaNOql.la', 'jobseeker', NULL, NULL, '2024-11-30 04:23:22', '2024-12-05 03:51:02', 'active', '1'),
(15, 'fasodfaioh', 'adfioahsd@gmail.com', '525516', NULL, '$2y$04$BPRXyvEjhXgcBvwHPDzzHeVTD.8RYU8ElS7tnUtch/tN93DrgE6CS', 'jobseeker', NULL, NULL, '2024-12-05 03:03:59', NULL, 'active', '0'),
(16, 'psyche', 'test@gmail.com', '593729', NULL, '$2y$04$NgTIXp2M9b584i/yAWtEOufAt5B67Kez7kWwQFQMCxh9bzvh0AuQC', 'jobseeker', NULL, NULL, '2024-12-05 03:57:50', NULL, 'active', '0'),
(17, 'username', 'carnalyn@gmail.com', '875322', NULL, '$2y$04$PHOSVAFMwursCvg5VEskReFOUXR4feHLTlRrOozB0y0qlmSXljmPq', 'employer', NULL, NULL, '2024-12-10 01:03:25', NULL, 'active', '0'),
(18, 'carnalyn', 'carnalynbaltazar26@gmail.com', '246140', NULL, '$2y$04$pkdwFN35UwY2R4/pcQYB2uNum5S6btcHqSm08ZlKkirrqyQm0mgHe', 'employer', NULL, NULL, '2024-12-10 01:04:42', NULL, 'active', '0'),
(19, 'perjes', 'perjescykean356@gmail.com', '707806', NULL, '$2y$04$yDcfVFl3VG7s8Gkufkgadu/LpWOUvRycuaahtAZHwFsL/3tYOeZee', 'employer', NULL, NULL, '2024-12-13 02:29:39', NULL, 'active', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employers`
--
ALTER TABLE `employers`
  ADD PRIMARY KEY (`employer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `employer_id` (`employer_id`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `jobseeker_id` (`jobseeker_id`),
  ADD KEY `employer_id` (`employer_id`);

--
-- Indexes for table `job_seekers`
--
ALTER TABLE `job_seekers`
  ADD PRIMARY KEY (`seeker_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saved_jobs`
--
ALTER TABLE `saved_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_job` (`job_id`),
  ADD KEY `fk_jobseeker` (`jobseeker_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employers`
--
ALTER TABLE `employers`
  MODIFY `employer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `job_seekers`
--
ALTER TABLE `job_seekers`
  MODIFY `seeker_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `saved_jobs`
--
ALTER TABLE `saved_jobs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employers`
--
ALTER TABLE `employers`
  ADD CONSTRAINT `employers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`employer_id`) REFERENCES `employers` (`employer_id`) ON DELETE CASCADE;

--
-- Constraints for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `job_applications_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`),
  ADD CONSTRAINT `job_applications_ibfk_2` FOREIGN KEY (`jobseeker_id`) REFERENCES `job_seekers` (`seeker_id`),
  ADD CONSTRAINT `job_applications_ibfk_3` FOREIGN KEY (`employer_id`) REFERENCES `employers` (`employer_id`);

--
-- Constraints for table `job_seekers`
--
ALTER TABLE `job_seekers`
  ADD CONSTRAINT `job_seekers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `saved_jobs`
--
ALTER TABLE `saved_jobs`
  ADD CONSTRAINT `fk_job` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_jobseeker` FOREIGN KEY (`jobseeker_id`) REFERENCES `job_seekers` (`seeker_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
