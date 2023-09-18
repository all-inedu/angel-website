-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2023 at 04:59 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `angel_mentee_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(19, '2014_10_12_000000_create_users_table', 1),
(20, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(21, '2019_08_19_000000_create_failed_jobs_table', 1),
(22, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(23, '2023_07_05_040757_create_tb_admins_table', 1),
(24, '2023_07_05_044717_create_tb_award_achievements_table', 1),
(25, '2023_07_05_044751_create_tb_contact_with_me_table', 1),
(26, '2023_09_13_162749_create_tb_projects_table', 1),
(27, '2023_09_13_162841_create_tb_other_activities_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_admins`
--

CREATE TABLE `tb_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_admins`
--

INSERT INTO `tb_admins` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@example.com', '$2y$10$N1HHjSqlSW6WubAYKexSN.9eVwfB7N3B19inSCe7a0cp3.Hd4Gvau', '2023-09-18 01:38:46', '2023-09-18 01:38:46');

-- --------------------------------------------------------

--
-- Table structure for table `tb_award_achievements`
--

CREATE TABLE `tb_award_achievements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `competition_name` varchar(255) NOT NULL,
  `award_name` varchar(255) NOT NULL,
  `image` text DEFAULT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `competition_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_contact_with_me`
--

CREATE TABLE `tb_contact_with_me` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_other_activities`
--

CREATE TABLE `tb_other_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organization_name` varchar(255) NOT NULL,
  `roles` varchar(255) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `image` text DEFAULT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `brief_description` text NOT NULL,
  `is_highlight` enum('false','true') NOT NULL DEFAULT 'false',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_projects`
--

CREATE TABLE `tb_projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organization_name` varchar(255) NOT NULL,
  `roles` varchar(255) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `image` text DEFAULT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `button_title` varchar(255) DEFAULT NULL,
  `button_link` text DEFAULT NULL,
  `is_highlight` enum('false','true') NOT NULL DEFAULT 'false',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_projects`
--

INSERT INTO `tb_projects` (`id`, `organization_name`, `roles`, `start_date`, `end_date`, `image`, `alt`, `description`, `button_title`, `button_link`, `is_highlight`, `created_at`, `updated_at`) VALUES
(1, 'MUZARTT', 'CEO, Co-Founder', '2021-01-01', '2023-09-01', 'Projects-20230918090926.png', 'muzartt', '<p>A startup that aims to provide application-based virtual Music and Art therapy to elderly patients with dementia and other mental disabilities. Currently at the commitment stage (application programming) - launching in September 2023. Worked with a professor at UIUC to do research on conceptualising the business model and establishing Muzartt as a company.&nbsp;</p>\r\n<p>Role: Research and exploration of target market, creating business model, designer and creator of prototype, Website creator, Pitching to and converesed with different health organisations, hospitals and music therapists.</p>', 'Visit Muzartt', NULL, 'false', '2023-09-18 02:09:26', '2023-09-18 02:09:55'),
(2, 'AKU BISA', 'Curriculum Creator, Co-Founder, Head Mentor', '2022-01-01', '2023-09-01', 'Projects-20230918095304.png', 'AKU BISA', '<p>Aku Bisa is a student-led service initiative with a vision to cultivate young entrepreneurs (from underprivileged backgrounds) who are adopters of modern technology that are able to bring prosperity to and strengthen the economy of the community around them. Aku Bisa believes that entrepreneurship is key to breaking the chain of vicious economic cycles that plagued many poverty pockets in developing countries.</p>\r\n<p>To achieve its vision, Angel developed a curriculum specially crafted not only to introduce entrepreneurship, business concepts, e-commerce and digital skills through simple terms and engaging materials, but also to nurture confidence, communication and collaboration skills. This curriculum is then applied to weekly lessons and trainings led by Aku Bisa mentors.</p>\r\n<p>Aku Bisa is currently working together with three organisations: Rumah Belajar Parousia in Desa Kapan, Indonesia, Rumah Pelangi Kasih in Bandung, Indonesia, and Covenant Evangelical Church in Singapore, providing hands on training to more than 100 mentees To date, Aku Bisa has helped them to launch 3 online ventures.</p>\r\n<p>Aku Bisa has shared its resources (curriculum and lesson plans) to 5 other organisations which further impact more than 350 young people. As an open platform, any individuals or organisations who share a similar vision with Aku Bisa are welcomed to join the team as mentors or collaborate in service projects.</p>', 'Visit Aku Bisa', NULL, 'false', '2023-09-18 02:53:04', '2023-09-18 02:53:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tb_admins`
--
ALTER TABLE `tb_admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tb_admins_email_unique` (`email`);

--
-- Indexes for table `tb_award_achievements`
--
ALTER TABLE `tb_award_achievements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_contact_with_me`
--
ALTER TABLE `tb_contact_with_me`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_other_activities`
--
ALTER TABLE `tb_other_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_projects`
--
ALTER TABLE `tb_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_admins`
--
ALTER TABLE `tb_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_award_achievements`
--
ALTER TABLE `tb_award_achievements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_contact_with_me`
--
ALTER TABLE `tb_contact_with_me`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_other_activities`
--
ALTER TABLE `tb_other_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_projects`
--
ALTER TABLE `tb_projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
