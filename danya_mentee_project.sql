-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2023 at 11:35 AM
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
-- Database: `danya_mentee_project`
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
(122, '2014_10_12_000000_create_users_table', 1),
(123, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(124, '2019_08_19_000000_create_failed_jobs_table', 1),
(125, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(126, '2023_07_05_040757_create_tb_admins_table', 1),
(127, '2023_07_05_044644_create_tb_change_making_projects_table', 1),
(128, '2023_07_05_044717_create_tb_award_achievements_table', 1),
(129, '2023_07_05_044735_create_tb_speaking_opportunities_table', 1),
(130, '2023_07_05_044751_create_tb_contact_with_me_table', 1);

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
(1, 'Admin', 'admin@example.com', '$2y$10$6GNxVdkA99J4.Pw/2NCSz.N5G5J1f8AqLpbrR9TOXXgPk5NUJCt0G', '2023-08-02 03:05:40', '2023-08-02 03:05:40');

-- --------------------------------------------------------

--
-- Table structure for table `tb_award_achievements`
--

CREATE TABLE `tb_award_achievements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `competition_name` varchar(255) NOT NULL,
  `award_name` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `alt` varchar(255) NOT NULL,
  `competition_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_award_achievements`
--

INSERT INTO `tb_award_achievements` (`id`, `competition_name`, `award_name`, `image`, `alt`, `competition_date`, `created_at`, `updated_at`) VALUES
(1, 'InaM2C', 'MERITORIOUS 2023', 'Award-Achievement-20230802104109.png', 'InaM2C', NULL, '2023-08-02 03:41:09', '2023-08-02 03:43:46'),
(2, 'KOMPeK', 'Grand Champion of Economic Research Paper', 'Award-Achievement-20230802104511.png', 'KOMPeK', '2022-02-01', '2023-08-02 03:45:11', '2023-08-02 03:45:11'),
(3, 'HiLo Teen Design Thinking Marathon 2022', 'Juara 3', 'Award-Achievement-20230802105017.png', 'HiLo Teen Design Thinking Marathon 2022', '2022-12-01', '2023-08-02 03:50:17', '2023-08-02 03:50:17'),
(4, 'Pelita Harapan International Model United Nations 2022', 'Honorable Mention in UNEP', 'Award-Achievement-20230802105108.png', 'Pelita Harapan International Model United Nations 2022', NULL, '2023-08-02 03:51:08', '2023-08-02 03:51:08');

-- --------------------------------------------------------

--
-- Table structure for table `tb_change_making_projects`
--

CREATE TABLE `tb_change_making_projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organization_name` varchar(255) NOT NULL,
  `roles` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `button_title` varchar(255) DEFAULT NULL,
  `button_link` text DEFAULT NULL,
  `is_highlight` enum('false','true') NOT NULL DEFAULT 'false',
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_change_making_projects`
--

INSERT INTO `tb_change_making_projects` (`id`, `organization_name`, `roles`, `description`, `button_title`, `button_link`, `is_highlight`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 'We The Genesis', 'Founder, Executive Director', '<p>Founded in 2020, We The Genesis is a Y2Y media organization dedicated to amplifying youth aspirations, stimulating young minds, and igniting youthful ambition with empathy. It serves as a voice for the younger generation, encouraging exploration of potential and contributing to positive change, by creating opportunities for engagement with diverse perspectives. Through its platform, We The Genesis provokes thought, inspires action, and cultivates empathy, empowering the youth to become active contributors to a more inclusive and informed society.</p>', 'Join We The Genesis', 'https://instagram.com/wtg.idn?igshid=MzRlODBiNWFlZA==', 'true', NULL, '2023-08-02 03:10:15', '2023-08-02 03:16:56'),
(2, '‘Nothing On A Dead Planet’ Campaign', 'Initiator', '<p>Danya and a group of climate activists initiated The Nothing On A Dead Planet Campaign to address the detachment felt by Indonesians towards climate change. The campaign\'s primary objective is to demonstrate that every individual stands to lose something due to climate change, highlighting the impact on aspects of life like education, romance, wellness, and even yoga. By raising awareness and inspiring action, the campaign aims to emphasize the profound societal impact of climate change.</p>', 'Visit Page', 'https://www.instagram.com/nothingonadeadplanet/', 'true', NULL, '2023-08-02 03:16:12', '2023-08-02 03:17:00'),
(3, 'Green Welfare Indonesia', 'Head of Climate Education', '<p>Green Welfare Indonesia, a non-profit organization, connects youth-led climate solutions in the areas of food security, climate education, and sustainable agriculture. Established on May 3, 2020, the organization strives to make a positive social and environmental impact. Recognizing the power of small steps, Green Welfare Indonesia aims to engage and encourage young individuals to address eco-social issues, promote climate and environmental awareness, and foster meaningful change through initiatives and projects.</p>', NULL, NULL, 'true', NULL, '2023-08-02 03:16:33', '2023-08-02 03:32:25');

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
-- Table structure for table `tb_speaking_opportunities`
--

CREATE TABLE `tb_speaking_opportunities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `video_link` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `alt` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_highlight` enum('false','true') NOT NULL DEFAULT 'false',
  `event_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_speaking_opportunities`
--

INSERT INTO `tb_speaking_opportunities` (`id`, `title`, `video_link`, `image`, `alt`, `description`, `is_highlight`, `event_date`, `created_at`, `updated_at`) VALUES
(1, 'Climate Change for Teens', 'https://youtu.be/amamQuZqz4Y', NULL, 'Climate Change for Teens', '<p>Danya actively participated in the public educational project called Climate Change for Teens (CCFT), initiated by FPCI, where she also took part in the Foreign Policy for Teens Video Project to engage high school students aged 15-20 in climate issues, foreign policy, and world affairs. She had a conversation with Prof. Dr. Emil Salim, the First Minister of Environment in Indonesia, which was captured in one of the videos to enrich the educational content and provide valuable insights.</p>', 'true', NULL, '2023-08-02 07:48:26', '2023-08-02 07:55:51'),
(2, 'AMSA', NULL, NULL, 'AMSA', '<p>Danya, as a speaker at AMSA\'s National Publication and Promotion Gathering 2023, highlighted the significance of targeting the right audience and understanding one\'s brand when sharing valuable content on social media. The presentation, delivered to over 100 participants from AMSA, aimed to equip them with essential marketing tips to effectively communicate information to their respective audiences.</p>', 'true', NULL, '2023-08-02 07:49:02', '2023-08-02 07:55:54'),
(3, 'AIESEC', NULL, NULL, 'AIESEC', '<p>Danya was a speaker for AIESEC\'s \"Youth Connects\" event at Universitas Indonesia, where the theme \"Dare to Learn, Live to Lead\" was explored, sharing her leadership journey within We The Genesis, a platform she built, to a diverse audience of over 100 enthusiastic and passionate students.</p>', 'true', NULL, '2023-08-02 07:55:36', '2023-08-02 07:55:57');

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
-- Indexes for table `tb_change_making_projects`
--
ALTER TABLE `tb_change_making_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_contact_with_me`
--
ALTER TABLE `tb_contact_with_me`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_speaking_opportunities`
--
ALTER TABLE `tb_speaking_opportunities`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_change_making_projects`
--
ALTER TABLE `tb_change_making_projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_contact_with_me`
--
ALTER TABLE `tb_contact_with_me`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_speaking_opportunities`
--
ALTER TABLE `tb_speaking_opportunities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
