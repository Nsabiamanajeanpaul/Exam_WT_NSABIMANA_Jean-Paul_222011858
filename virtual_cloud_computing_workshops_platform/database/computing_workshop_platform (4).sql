-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 10:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `computing_workshop_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE `attendees` (
  `attendee_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `workshop_type` varchar(150) DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendees`
--

INSERT INTO `attendees` (`attendee_id`, `user_id`, `workshop_type`, `registration_date`) VALUES
(1, 5, ' Data Technologies', '2024-05-16 22:00:00'),
(2, 4, 'Machine Learning Essentials', '2024-02-12 22:00:00'),
(3, 3, 'Cybersecurity Fundamentals', '2024-07-11 22:00:00'),
(4, 2, 'Data Analytics', '2024-05-10 22:00:00'),
(5, 1, 'Cloud Computing Basics', '2024-01-09 22:00:00'),
(6, 4, 'Nakumat shop located at Kigali ', '2024-05-09 22:00:00'),
(7, 5, 'teacher training', '2024-06-06 01:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `enrollment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `workshop_id` int(11) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`enrollment_id`, `user_id`, `workshop_id`, `status`) VALUES
(1, 1, 1, 'pending'),
(2, 4, 1, 'rejected'),
(3, 3, 2, 'approved'),
(4, 4, 2, 'rejected'),
(5, 5, 3, 'approved'),
(7, 5, 3, 'pending'),
(8, 5, 3, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `workshop_id` int(11) DEFAULT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `feedback_text` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `user_id`, `workshop_id`, `instructor_id`, `feedback_text`, `rating`) VALUES
(1, 1, 1, 1, 'Great workshop! Learned a lot about cloud computing fundamentals.', 5),
(3, 3, 2, 2, 'The workshop content was relevant and well-organized.', 5),
(4, 4, 2, 2, 'Would have liked more hands-on exercises.', 3),
(5, 5, 3, 3, 'Excellent presentation skills by the instructor.', 5),
(6, 5, 3, 2, 'great participation in our celemony', 10),
(7, 2, 4, 4, 'i see how the website is doing', 34);

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `instructor_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `experience_years` int(11) DEFAULT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`instructor_id`, `user_id`, `experience_years`, `specialization`, `website`) VALUES
(1, 1, 5, 'Cloud Computing', 'Amazone'),
(2, 2, 7, 'huge Data', 'facebook'),
(3, 3, 8, 'Cybersecurity', 'Andela'),
(4, 4, 6, 'Data Science', 'Istergram'),
(5, 5, 10, 'Machine Learning', 'youtube'),
(6, 10, 2, 'data management', 'RSSB'),
(7, 6, 14, 'Football', 'chelsea team');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `material_id` int(11) NOT NULL,
  `workshop_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `uploaded_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`material_id`, `workshop_id`, `title`, `file_path`, `uploaded_date`) VALUES
(1, 1, 'Material booking', '/materials/cost_optimization_strategies.pdf', '2024-05-24 00:35:00'),
(2, 4, 'Cloud Security Best Practices', '/materials/security_best_practices.pdf', '0000-00-00 00:00:00'),
(3, 2, 'Managing Cloud Infrastructure', '/materials/cloud_infra_management.pdf', '2024-09-15 00:00:00'),
(4, 1, 'Advanced Cloud Architectures', '/materials/advanced_cloud_architectures.pdf', '2024-10-20 00:00:00'),
(5, 4, 'Cloud Cost Optimization Strategies', '/materials/cost_optimization_strategies.pdf', '2024-11-25 00:00:00'),
(6, 5, 'Amazon materials', '/materials/security_best_practices.pdf', '2024-05-04 20:51:00'),
(7, 4, 'space workshops', '/materials/advanced_cloud_architectures.pdf', '2024-05-30 01:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `sent_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `message`, `sent_date`) VALUES
(1, 4, 'Your workshop registration is not performed.', '0000-00-00 00:00:00'),
(2, 1, 'Reminder: Workshop on Data Analytics tomorrow.', '2024-06-11 00:00:00'),
(3, 5, 'New workshop announcement: Cybersecurity Fundamentals.', '2024-01-30 00:00:00'),
(4, 3, 'Feedback request: Machine Learning Essentials workshop.', '2024-11-13 00:00:00'),
(5, 1, 'Congratulations! You have completed the Big Data Technologies workshop.', '2024-09-14 00:00:00'),
(6, 2, 'we sent feedback on your email please check as soon as possible', '2024-05-08 17:08:00'),
(7, 4, 'we approve your transaction or request visit our office as soon as possible', '2024-05-10 21:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `workshop_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `user_id`, `workshop_id`, `amount`, `payment_date`) VALUES
(1, 1, 1, 50.00, '2024-05-02 00:00:00'),
(2, 3, 3, 35.00, '2024-05-11 00:00:00'),
(3, 3, 3, 60.00, '2024-05-16 00:00:00'),
(4, 4, 4, 80.00, '2024-05-21 00:00:00'),
(5, 5, 5, 65.00, '2024-05-26 00:00:00'),
(6, 2, 4, 100.00, '2024-05-04 20:15:00'),
(7, 1, 5, 200.00, '2024-05-05 01:39:00'),
(8, 4, 3, 23.00, '2024-05-04 12:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `resource_id` int(11) NOT NULL,
  `resource_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`resource_id`, `resource_name`, `description`) VALUES
(1, 'Virtual Machines', 'Virtual machines for running applications and workloads'),
(2, 'Storage', 'Persistent and scalable storage solutions for data'),
(3, 'Networking', 'Networking services for connecting resources and users'),
(4, 'Databases sql', 'Managed database services for storing and managing data'),
(5, 'Security Services', 'Security solutions for protecting cloud resources'),
(6, 'ARCHIEVE', 'store all transaction about different domain  '),
(7, 'stock management', 'contral transfer in and transfer out of your warehouse'),
(8, 'Business income', 'tis is amount of money generated by business in their operation(activity)');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `registration_date`) VALUES
(1, 'john cloude', 'john1@gmail.com', 'Murara', '2024-04-10 22:00:00'),
(2, 'jane kabanda', 'jan12@gmail.com', 'MUnini', '2024-06-11 22:00:00'),
(3, 'alex mugisha', 'alex45@gmail.com', 'Alax250', '2024-02-09 22:00:00'),
(4, 'emily wangura', 'emil001@gmail.com', 'wangura', '2024-10-31 22:00:00'),
(5, 'mike kayihura', 'mike78@gmail.com', 'mikepass123', '2024-08-08 22:00:00'),
(6, 'Irankunda Eric', 'eric@gmail.com', 'Eri12', '2024-05-01 19:51:00'),
(8, '', 'joseph6@gmail.com', '$2y$10$HRVzuFVr22uZralS6XhHAO16kbKkvibe0E.21Y2V8kc3AxyMUDK5m', '2024-04-10 22:00:00'),
(9, 'mwiza mogani', 'mog4@gmail.com', '$2y$10$3Gejl3GfX8l53BmBpNO6UO2npPj.Bpna4geBLcwz6sJh6fD7IRjQi', '2024-04-10 22:00:00'),
(10, 'mupenzi sanuel', 'sanu6@gmail.com', '$2y$10$/sI5nwwaKXOO0uza81Aa4.9a5mozxBJQV4iUS3g/YZ4BYCzwDqP.O', '0000-00-00 00:00:00'),
(13, 'mupenzi sanuel', 'sanu@gmail.com', '$2y$10$i1YNeLejLx2MtW6krUXe3OyXpo7zJaIHxuptQy4bApKdU98R7R63u', '0000-00-00 00:00:00'),
(14, 'niyomuhoza Felcien', 'niyo1@gmail.com', '$2y$10$uCw0hsrBGbPr2lbd9aqRIeGhYmTDLxDTIQ1UAUePmhkohf5hQdIN6', '0000-00-00 00:00:00'),
(15, 'niyomugabo cloude', 'niyom@gmail.com', '$2y$10$bis2vWlJcpDWslGI7F6Aw.b.PQ2R11TU5Tn1Ad0O2UMbNHh11Nlk6', '0000-00-00 00:00:00'),
(17, 'niyitegeka patrick', 'niyo5@gmail.com', '$2y$10$NQeUUTdshWI1o7NJh7.HS.aPA2sGlGCfu/uAoPhYnlRDQjw8V14zK', '0000-00-00 00:00:00'),
(18, 'jp', 'byir@mail.com', '$2y$10$p6P/IMdpbAuODUYK9nV42.EhCgwIfzSn2kk4efwOS/gS4wcLFaC/a', '0000-00-00 00:00:00'),
(20, 'niyomugabo eliab', 'eliab@gmail.com', '$2y$10$FDf2KS/8R0B1//bz2qBO9eK.2v3GpYuYQfh7QK4r6s95WzFaKEt7y', '0000-00-00 00:00:00'),
(21, 'Ishimwe Eliab', 'Eli3@gmai.com', '$2y$10$Mf2w8/m4PGGSbH.HJK1tEearrw7XMwvC8.VTuYKev.J1HILWbqYvu', '0000-00-00 00:00:00'),
(22, 'Niyumuhoza fulgence', 'ful4@gmail.com', '$2y$10$DbwelW.hvzlphilBq7AwwevBQ8RUCWO1z6EBsErdZb1EBYTU8oRiC', '2024-05-03 22:00:00'),
(23, 'niyitegeka patrick', 'Patricknitiyitegeka801@gmail.com', '$2y$10$XSvVO1y1.VvgXp42famIAuqY941q5sTcxWtgGCtH4n5JPBxwcEPKW', '2024-05-02 22:00:00'),
(24, 'Niyohoza Olivier', 'niyo90@gmail.com', '$2y$10$c5laL.lS1MMWJEIX.57WXOqRVkMNctRyqDGDXPnAwlabiEULzgz5m', '2024-05-04 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `workshops`
--

CREATE TABLE `workshops` (
  `workshop_id` int(11) NOT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workshops`
--

INSERT INTO `workshops` (`workshop_id`, `instructor_id`, `title`, `description`, `start_date`, `end_date`) VALUES
(1, 4, 'Introduction to Cloud Computing', 'This workshop provides an overview of cloud computing concepts and technologies.', '2024-05-02 00:00:00', '2024-05-26 00:00:00'),
(2, 2, 'Advanced AWS Solutions Architect', 'Explore advanced topics in AWS architecture and design.', '2024-06-10 00:00:00', '2024-06-17 00:00:00'),
(3, 5, 'Google Cloud Fundamentals', 'Learn the fundamentals of Google Cloud Platform and its services.', '2024-01-15 00:00:00', '2024-02-17 00:00:00'),
(4, 1, 'Azure DevOps Workshop', 'Hands-on workshop on using Azure DevOps for continuous integration and deployment.', '2024-07-20 00:00:00', '2025-09-22 00:00:00'),
(5, 3, 'Kubernetes Essentials', 'Introduction to container orchestration using Kubernetes.', '2024-12-25 00:00:00', '2025-03-27 00:00:00'),
(6, 4, ' shoes choice', 'this folder contain different shoes like nike,airforce,Jordern', '2024-05-01 00:00:00', '2024-05-05 00:00:00'),
(7, 3, 'Envirnomental law ', 'this module help us to be aware for laws related to business and society', '2024-05-04 23:26:00', '2024-05-18 21:31:00'),
(8, 1, 'Business management', 'this sessions bring knowledge fof how business managed according t available resources.', '2024-05-03 17:35:00', '2024-05-26 16:40:00'),
(9, 4, 'Advanced AWS Solutions Architect', 'Advanced AWS Solutions Architect', '2024-05-02 16:37:00', '2024-06-07 16:37:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendees`
--
ALTER TABLE `attendees`
  ADD PRIMARY KEY (`attendee_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `workshop_id` (`workshop_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `workshop_id` (`workshop_id`),
  ADD KEY `instructor_id` (`instructor_id`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`instructor_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`material_id`),
  ADD KEY `workshop_id` (`workshop_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `workshop_id` (`workshop_id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`resource_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `workshops`
--
ALTER TABLE `workshops`
  ADD PRIMARY KEY (`workshop_id`),
  ADD KEY `instructor_id` (`instructor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendees`
--
ALTER TABLE `attendees`
  MODIFY `attendee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `instructor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `resource_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `workshops`
--
ALTER TABLE `workshops`
  MODIFY `workshop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendees`
--
ALTER TABLE `attendees`
  ADD CONSTRAINT `attendees_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`workshop_id`) REFERENCES `workshops` (`workshop_id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`workshop_id`) REFERENCES `workshops` (`workshop_id`),
  ADD CONSTRAINT `feedback_ibfk_3` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`instructor_id`);

--
-- Constraints for table `instructors`
--
ALTER TABLE `instructors`
  ADD CONSTRAINT `instructors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_ibfk_1` FOREIGN KEY (`workshop_id`) REFERENCES `workshops` (`workshop_id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`workshop_id`) REFERENCES `workshops` (`workshop_id`);

--
-- Constraints for table `workshops`
--
ALTER TABLE `workshops`
  ADD CONSTRAINT `workshops_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`instructor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
