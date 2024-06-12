-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 06:58 AM
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
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `admin_id` int(11) NOT NULL,
  `admin_photo` varchar(200) NOT NULL,
  `admin_name` varchar(30) NOT NULL,
  `gender` varchar(2) NOT NULL,
  `admin_password` varchar(30) NOT NULL,
  `admin_email` varchar(30) NOT NULL,
  `admin_phone` varchar(30) NOT NULL,
  `role_position` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`admin_id`, `admin_photo`, `admin_name`, `gender`, `admin_password`, `admin_email`, `admin_phone`, `role_position`) VALUES
(6, 'uploads/Screenshot 2024-02-26 205220.png', 'admin', 'm', 'Ding_2004', 'admin@mhs.com', '012-55555888', 'ADMIN'),
(12, '', 'Lim Chia Zee', 'M', 'Lim_2005', 'chiazee@gmail.com', '011-123456789', 'admin'),
(13, '', 'Celina Hee', 'M', 'Celina_1234', 'celina@gmail.com', '012-123456789', 'admin'),
(14, '', 'Ding Wei Jie', 'M', '2300418', 'ding@gmail.com', '012-123458486', 'admin'),
(15, '', 'Chia Yee Shan', 'F', '2300365', 'chia@gmail.com', '012-481349865', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `ticket_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `seat_number` int(11) NOT NULL,
  `purchase_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `buyer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`ticket_id`, `event_id`, `seat_number`, `purchase_time`, `buyer`) VALUES
(1, 5, 1, '2024-05-05 18:57:51', 'Arno ong'),
(2, 6, 462, '2024-05-05 19:10:50', 'Arno ong'),
(3, 0, 0, '2024-05-05 19:10:53', 'Arno ong'),
(4, 7, 375, '2024-05-05 19:12:29', 'Arno ong'),
(5, 0, 0, '2024-05-05 19:12:31', 'Arno ong'),
(6, 10, 405, '2024-05-05 19:33:02', 'Arno ong'),
(7, 0, 0, '2024-05-05 19:33:05', 'Arno ong'),
(8, 5, 20, '2024-05-06 00:05:44', 'Arno ong'),
(9, 6, 194, '2024-05-06 00:18:48', 'Arno ong'),
(10, 7, 255, '2024-05-06 00:50:26', 'Arno ong'),
(11, 0, 0, '2024-05-06 00:50:29', 'Arno ong'),
(16, 0, 0, '2024-05-06 01:05:54', 'celina'),
(17, 0, 0, '2024-05-06 01:06:03', 'celina'),
(18, 0, 0, '2024-05-06 01:06:04', 'celina'),
(19, 0, 0, '2024-05-06 01:06:38', 'celina'),
(20, 0, 0, '2024-05-06 01:06:49', 'celina'),
(21, 29, 18, '2024-05-06 01:06:53', 'celina'),
(22, 29, 14, '2024-05-06 01:06:53', 'celina'),
(23, 29, 19, '2024-05-06 01:06:53', 'celina'),
(24, 29, 13, '2024-05-06 01:06:53', 'celina'),
(25, 29, 15, '2024-05-06 01:16:48', 'celina'),
(26, 29, 16, '2024-05-06 01:16:48', 'celina'),
(27, 29, 17, '2024-05-06 01:16:48', 'celina'),
(28, 0, 0, '2024-05-06 01:16:51', 'celina'),
(29, 0, 0, '2024-05-06 01:16:55', 'celina'),
(30, 0, 0, '2024-05-06 01:17:07', 'celina'),
(31, 0, 0, '2024-05-06 01:17:27', 'celina'),
(32, 0, 0, '2024-05-06 01:17:29', 'celina');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `client_photo` varchar(155) NOT NULL,
  `client_name` varchar(30) NOT NULL,
  `client_password` varchar(20) NOT NULL,
  `gender` varchar(2) NOT NULL,
  `client_email` varchar(30) NOT NULL,
  `client_phone` varchar(15) NOT NULL,
  `birth_date` date NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `client_photo`, `client_name`, `client_password`, `gender`, `client_email`, `client_phone`, `birth_date`, `reg_date`) VALUES
(13, 'WhatsApp Image 2024-03-11 at 9.48.34 PM.jpeg', 'Arno ong', 'Ding_2004', 'M', 'arno@gmail.com', '0123456578', '2024-04-30', '2024-05-06 04:51:14'),
(29, 'Screenshot 2024-03-15 233711.png', 'celina', 'Ding_2004', 'M', 'dweijie0701@gmail.com', '0123456579', '2024-05-23', '2024-05-06 01:11:29');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_poster` varchar(300) NOT NULL,
  `event_name` varchar(155) NOT NULL,
  `event_detail` varchar(300) NOT NULL,
  `event_price` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` varchar(20) NOT NULL,
  `event_place` varchar(155) NOT NULL,
  `event_nation` varchar(155) NOT NULL,
  `venue_seat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_poster`, `event_name`, `event_detail`, `event_price`, `event_date`, `event_time`, `event_place`, `event_nation`, `venue_seat`) VALUES
(5, 'event_poster/itzy1-bonetobe.jpg', 'Born to Be World Tour', 'Born to Be World Tour is the ongoing second worldwide concert by South Korean girl group Itzy, held in support of the group\'s second studio album Born to Be (2024). It began on February 24, 2024, in Seoul, South Korea, and will hold 30 shows, in Asia, Oceania, North America, South America and Europe', 300, '2024-08-10', '19:00', 'AsiaWorld–Arena', 'Hong Kong ,China', 481),
(6, 'event_poster/taylor swift.jpg', 'The Eras Tour', 'Paris, France', 800, '2024-05-09', '19:00', ' PARIS LA DÉFENSE ARENA', 'Paris, France', 480),
(7, 'event_poster/richie jen.jpeg', 'Richie Jen Concert', '', 388, '2024-07-13', '20:00', 'Axiata Arena Bukit Jalil', 'Malaysia', 480),
(8, 'event_poster/kelly yu.jpeg', ' 3 x 3 World Tour', '', 488, '2024-04-24', '18:00', 'Arena of Stars', 'Malaysia', 480),
(9, 'event_poster/jay chou.jpeg', 'Jay Chou Carnival World Tour', '', 563, '2024-04-07', '19:00', ' K – Arena Yokohama', 'Tokyo', 480),
(10, 'event_poster/oneus.jpeg', 'ONEUS 2nd World Tour - La Dolce Vita', '', 388, '2024-05-04', '18:00', ' Zepp Kuala Lumpur', 'Malaysia', 480),
(11, 'event_poster/willian so.jpeg', 'Love Story Concert', '', 438, '2024-05-11', '20:00', ' Mega Star Arena', 'Kuala Lumpur , Malaysia', 480),
(12, 'event_poster/Power Station.jpg', 'LOVE', '', 596, '2024-04-06', '18:00', 'Arena of Stars', 'Malaysia', 480),
(13, 'event_poster/Nick Chou.png', ' Realive', '', 438, '2024-04-13', '20:00', 'Zepp', 'Kuala Lumpur , Malaysia', 480),
(14, 'event_poster/Kyuhyun.png', 'Restart', '', 698, '2024-04-13', '17:00', 'Mega Star Arena', 'Malaysia', 480),
(15, 'event_poster/Fish Leong.png', 'When Talk About Love ', '', 888, '0024-04-20', '20:00', 'Axiata Arena Bukit Jalil', 'Malaysia', 480),
(16, 'event_poster/Young Captain.png', 'Starry U', '', 688, '2024-04-28', '18:00', 'Arena of Stars', 'Malaysia', 480),
(17, 'event_poster/Ivana Wong.png', 'Live in Kuala Lumpur', '', 868, '2024-04-28', '20:00', 'Mega Star Arena', 'Malaysia', 480),
(18, 'event_poster/Michael Wong.png', 'Lonely Planet', '', 598, '2024-05-04', '20:00', 'Axiata Arena Bukit Jalil', 'Malaysia', 201),
(19, 'event_poster/Zhao Chuan.png', 'Zhao Chuan Live Concert', '', 796, '2024-05-11', '18:00', 'Arena of Stars', 'Malaysia', 480),
(20, 'event_poster/Frances Yip.png', 'Mother’s Day Special 2024', '', 588, '2024-05-12', '17:00', 'Mega Star Arena', 'Kuala Lumpur , Malaysia', 480),
(21, 'event_poster/IU.png', 'H.E.R', '', 949, '2024-06-08', '19:30', 'Axiata Arena Bukit Jalil', 'Malaysia', 480),
(22, 'event_poster/Treasure.png', '2024 Treasure Relay Tour', '', 998, '2024-06-22', '18:00', 'Axiata Arena Bukit Jalil', 'Malaysia', 480),
(23, 'event_poster/Wu Bai & China Blue.png', 'Rockstar', '', 888, '2024-08-18', '20:00', 'Mega Star Arena', 'Malaysia', 480),
(24, 'event_poster/alink.jpg', 'A-Link with passengers ', '', 350, '2024-05-04', '20:00', 'Resort World Ballroom', 'Singapora', 30),
(25, 'event_poster/BTS.jpg', 'Map of the Soul Tour', '', 888, '2024-05-31', '20:00', 'Axiata Arena Bukit Jalil    ', 'Malaysia', 480),
(28, 'event_poster/Aptenodytes_forsteri_-Snow_Hill_Island,_Antarctica_-adults_and_juvenile-8.jpg', 'demo2222', 'hello my friend', 888, '2024-05-09', '03:33', 'Axiata Arena Bukit Jalil    ', 'Afghanistan', 30),
(29, 'event_poster/Screenshot 2024-03-08 154540.png', 'ken123', 'hello', 99, '2024-05-31', '09:04', 'Arena of Stars', 'Solomon Islands', 30);

-- --------------------------------------------------------

--
-- Table structure for table `history_image`
--

CREATE TABLE `history_image` (
  `id` int(11) NOT NULL,
  `name` varchar(51) NOT NULL,
  `concert_name` varchar(151) NOT NULL,
  `photo` varchar(151) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_image`
--

INSERT INTO `history_image` (`id`, `name`, `concert_name`, `photo`) VALUES
(3, 'Coldplay', 'National Stadium Singapore', 'past_image//a1.jpg'),
(6, '(G)I-DLE', 'Singapore Indoor Stadium', 'past_image//a4.jpg'),
(9, 'Young Captain', 'Arena of Stars Resorts World Genting', 'past_image//a7.jpg'),
(11, 'Taylor swift', 'Nissan stadium, Nashville,tn', 'past_image//Screenshot 2024-05-05 183037.png'),
(12, 'Ed Sheeran', 'London wembly stadium', 'past_image//Screenshot 2024-05-05 183514.png'),
(13, 'NCT dream', 'Axiata arena bukit jalil ', 'past_image//Screenshot 2024-05-05 183929.png'),
(14, 'BLUE', 'PLENARY hall KLCC', 'past_image//Screenshot 2024-05-05 184444.png'),
(19, 'Blackpink', 'Kuala lumpur', 'past_image//Screenshot 2024-05-05 201343.png'),
(20, 'Kelly chen', 'Arena Of Stars', 'past_image//Screenshot 2024-05-05 194847.png');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id` int(11) NOT NULL,
  `seat_number` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `seat_number`) VALUES
(1, '1'),
(10, '10'),
(100, '100'),
(1000, '1000'),
(101, '101'),
(102, '102'),
(103, '103'),
(104, '104'),
(105, '105'),
(106, '106'),
(107, '107'),
(108, '108'),
(109, '109'),
(11, '11'),
(110, '110'),
(111, '111'),
(112, '112'),
(113, '113'),
(114, '114'),
(115, '115'),
(116, '116'),
(117, '117'),
(118, '118'),
(119, '119'),
(12, '12'),
(120, '120'),
(121, '121'),
(122, '122'),
(123, '123'),
(124, '124'),
(125, '125'),
(126, '126'),
(127, '127'),
(128, '128'),
(129, '129'),
(13, '13'),
(130, '130'),
(131, '131'),
(132, '132'),
(133, '133'),
(134, '134'),
(135, '135'),
(136, '136'),
(137, '137'),
(138, '138'),
(139, '139'),
(14, '14'),
(140, '140'),
(141, '141'),
(142, '142'),
(143, '143'),
(144, '144'),
(145, '145'),
(146, '146'),
(147, '147'),
(148, '148'),
(149, '149'),
(15, '15'),
(150, '150'),
(151, '151'),
(152, '152'),
(153, '153'),
(154, '154'),
(155, '155'),
(156, '156'),
(157, '157'),
(158, '158'),
(159, '159'),
(16, '16'),
(160, '160'),
(161, '161'),
(162, '162'),
(163, '163'),
(164, '164'),
(165, '165'),
(166, '166'),
(167, '167'),
(168, '168'),
(169, '169'),
(17, '17'),
(170, '170'),
(171, '171'),
(172, '172'),
(173, '173'),
(174, '174'),
(175, '175'),
(176, '176'),
(177, '177'),
(178, '178'),
(179, '179'),
(18, '18'),
(180, '180'),
(181, '181'),
(182, '182'),
(183, '183'),
(184, '184'),
(185, '185'),
(186, '186'),
(187, '187'),
(188, '188'),
(189, '189'),
(19, '19'),
(190, '190'),
(191, '191'),
(192, '192'),
(193, '193'),
(194, '194'),
(195, '195'),
(196, '196'),
(197, '197'),
(198, '198'),
(199, '199'),
(2, '2'),
(20, '20'),
(200, '200'),
(201, '201'),
(202, '202'),
(203, '203'),
(204, '204'),
(205, '205'),
(206, '206'),
(207, '207'),
(208, '208'),
(209, '209'),
(21, '21'),
(210, '210'),
(211, '211'),
(212, '212'),
(213, '213'),
(214, '214'),
(215, '215'),
(216, '216'),
(217, '217'),
(218, '218'),
(219, '219'),
(22, '22'),
(220, '220'),
(221, '221'),
(222, '222'),
(223, '223'),
(224, '224'),
(225, '225'),
(226, '226'),
(227, '227'),
(228, '228'),
(229, '229'),
(23, '23'),
(230, '230'),
(231, '231'),
(232, '232'),
(233, '233'),
(234, '234'),
(235, '235'),
(236, '236'),
(237, '237'),
(238, '238'),
(239, '239'),
(24, '24'),
(240, '240'),
(241, '241'),
(242, '242'),
(243, '243'),
(244, '244'),
(245, '245'),
(246, '246'),
(247, '247'),
(248, '248'),
(249, '249'),
(25, '25'),
(250, '250'),
(251, '251'),
(252, '252'),
(253, '253'),
(254, '254'),
(255, '255'),
(256, '256'),
(257, '257'),
(258, '258'),
(259, '259'),
(26, '26'),
(260, '260'),
(261, '261'),
(262, '262'),
(263, '263'),
(264, '264'),
(265, '265'),
(266, '266'),
(267, '267'),
(268, '268'),
(269, '269'),
(27, '27'),
(270, '270'),
(271, '271'),
(272, '272'),
(273, '273'),
(274, '274'),
(275, '275'),
(276, '276'),
(277, '277'),
(278, '278'),
(279, '279'),
(28, '28'),
(280, '280'),
(281, '281'),
(282, '282'),
(283, '283'),
(284, '284'),
(285, '285'),
(286, '286'),
(287, '287'),
(288, '288'),
(289, '289'),
(29, '29'),
(290, '290'),
(291, '291'),
(292, '292'),
(293, '293'),
(294, '294'),
(295, '295'),
(296, '296'),
(297, '297'),
(298, '298'),
(299, '299'),
(3, '3'),
(30, '30'),
(300, '300'),
(301, '301'),
(302, '302'),
(303, '303'),
(304, '304'),
(305, '305'),
(306, '306'),
(307, '307'),
(308, '308'),
(309, '309'),
(31, '31'),
(310, '310'),
(311, '311'),
(312, '312'),
(313, '313'),
(314, '314'),
(315, '315'),
(316, '316'),
(317, '317'),
(318, '318'),
(319, '319'),
(32, '32'),
(320, '320'),
(321, '321'),
(322, '322'),
(323, '323'),
(324, '324'),
(325, '325'),
(326, '326'),
(327, '327'),
(328, '328'),
(329, '329'),
(33, '33'),
(330, '330'),
(331, '331'),
(332, '332'),
(333, '333'),
(334, '334'),
(335, '335'),
(336, '336'),
(337, '337'),
(338, '338'),
(339, '339'),
(34, '34'),
(340, '340'),
(341, '341'),
(342, '342'),
(343, '343'),
(344, '344'),
(345, '345'),
(346, '346'),
(347, '347'),
(348, '348'),
(349, '349'),
(35, '35'),
(350, '350'),
(351, '351'),
(352, '352'),
(353, '353'),
(354, '354'),
(355, '355'),
(356, '356'),
(357, '357'),
(358, '358'),
(359, '359'),
(36, '36'),
(360, '360'),
(361, '361'),
(362, '362'),
(363, '363'),
(364, '364'),
(365, '365'),
(366, '366'),
(367, '367'),
(368, '368'),
(369, '369'),
(37, '37'),
(370, '370'),
(371, '371'),
(372, '372'),
(373, '373'),
(374, '374'),
(375, '375'),
(376, '376'),
(377, '377'),
(378, '378'),
(379, '379'),
(38, '38'),
(380, '380'),
(381, '381'),
(382, '382'),
(383, '383'),
(384, '384'),
(385, '385'),
(386, '386'),
(387, '387'),
(388, '388'),
(389, '389'),
(39, '39'),
(390, '390'),
(391, '391'),
(392, '392'),
(393, '393'),
(394, '394'),
(395, '395'),
(396, '396'),
(397, '397'),
(398, '398'),
(399, '399'),
(4, '4'),
(40, '40'),
(400, '400'),
(401, '401'),
(402, '402'),
(403, '403'),
(404, '404'),
(405, '405'),
(406, '406'),
(407, '407'),
(408, '408'),
(409, '409'),
(41, '41'),
(410, '410'),
(411, '411'),
(412, '412'),
(413, '413'),
(414, '414'),
(415, '415'),
(416, '416'),
(417, '417'),
(418, '418'),
(419, '419'),
(42, '42'),
(420, '420'),
(421, '421'),
(422, '422'),
(423, '423'),
(424, '424'),
(425, '425'),
(426, '426'),
(427, '427'),
(428, '428'),
(429, '429'),
(43, '43'),
(430, '430'),
(431, '431'),
(432, '432'),
(433, '433'),
(434, '434'),
(435, '435'),
(436, '436'),
(437, '437'),
(438, '438'),
(439, '439'),
(44, '44'),
(440, '440'),
(441, '441'),
(442, '442'),
(443, '443'),
(444, '444'),
(445, '445'),
(446, '446'),
(447, '447'),
(448, '448'),
(449, '449'),
(45, '45'),
(450, '450'),
(451, '451'),
(452, '452'),
(453, '453'),
(454, '454'),
(455, '455'),
(456, '456'),
(457, '457'),
(458, '458'),
(459, '459'),
(46, '46'),
(460, '460'),
(461, '461'),
(462, '462'),
(463, '463'),
(464, '464'),
(465, '465'),
(466, '466'),
(467, '467'),
(468, '468'),
(469, '469'),
(47, '47'),
(470, '470'),
(471, '471'),
(472, '472'),
(473, '473'),
(474, '474'),
(475, '475'),
(476, '476'),
(477, '477'),
(478, '478'),
(479, '479'),
(48, '48'),
(480, '480'),
(481, '481'),
(482, '482'),
(483, '483'),
(484, '484'),
(485, '485'),
(486, '486'),
(487, '487'),
(488, '488'),
(489, '489'),
(49, '49'),
(490, '490'),
(491, '491'),
(492, '492'),
(493, '493'),
(494, '494'),
(495, '495'),
(496, '496'),
(497, '497'),
(498, '498'),
(499, '499'),
(5, '5'),
(50, '50'),
(500, '500'),
(501, '501'),
(502, '502'),
(503, '503'),
(504, '504'),
(505, '505'),
(506, '506'),
(507, '507'),
(508, '508'),
(509, '509'),
(51, '51'),
(510, '510'),
(511, '511'),
(512, '512'),
(513, '513'),
(514, '514'),
(515, '515'),
(516, '516'),
(517, '517'),
(518, '518'),
(519, '519'),
(52, '52'),
(520, '520'),
(521, '521'),
(522, '522'),
(523, '523'),
(524, '524'),
(525, '525'),
(526, '526'),
(527, '527'),
(528, '528'),
(529, '529'),
(53, '53'),
(530, '530'),
(531, '531'),
(532, '532'),
(533, '533'),
(534, '534'),
(535, '535'),
(536, '536'),
(537, '537'),
(538, '538'),
(539, '539'),
(54, '54'),
(540, '540'),
(541, '541'),
(542, '542'),
(543, '543'),
(544, '544'),
(545, '545'),
(546, '546'),
(547, '547'),
(548, '548'),
(549, '549'),
(55, '55'),
(550, '550'),
(551, '551'),
(552, '552'),
(553, '553'),
(554, '554'),
(555, '555'),
(556, '556'),
(557, '557'),
(558, '558'),
(559, '559'),
(56, '56'),
(560, '560'),
(561, '561'),
(562, '562'),
(563, '563'),
(564, '564'),
(565, '565'),
(566, '566'),
(567, '567'),
(568, '568'),
(569, '569'),
(57, '57'),
(570, '570'),
(571, '571'),
(572, '572'),
(573, '573'),
(574, '574'),
(575, '575'),
(576, '576'),
(577, '577'),
(578, '578'),
(579, '579'),
(58, '58'),
(580, '580'),
(581, '581'),
(582, '582'),
(583, '583'),
(584, '584'),
(585, '585'),
(586, '586'),
(587, '587'),
(588, '588'),
(589, '589'),
(59, '59'),
(590, '590'),
(591, '591'),
(592, '592'),
(593, '593'),
(594, '594'),
(595, '595'),
(596, '596'),
(597, '597'),
(598, '598'),
(599, '599'),
(6, '6'),
(60, '60'),
(600, '600'),
(601, '601'),
(602, '602'),
(603, '603'),
(604, '604'),
(605, '605'),
(606, '606'),
(607, '607'),
(608, '608'),
(609, '609'),
(61, '61'),
(610, '610'),
(611, '611'),
(612, '612'),
(613, '613'),
(614, '614'),
(615, '615'),
(616, '616'),
(617, '617'),
(618, '618'),
(619, '619'),
(62, '62'),
(620, '620'),
(621, '621'),
(622, '622'),
(623, '623'),
(624, '624'),
(625, '625'),
(626, '626'),
(627, '627'),
(628, '628'),
(629, '629'),
(63, '63'),
(630, '630'),
(631, '631'),
(632, '632'),
(633, '633'),
(634, '634'),
(635, '635'),
(636, '636'),
(637, '637'),
(638, '638'),
(639, '639'),
(64, '64'),
(640, '640'),
(641, '641'),
(642, '642'),
(643, '643'),
(644, '644'),
(645, '645'),
(646, '646'),
(647, '647'),
(648, '648'),
(649, '649'),
(65, '65'),
(650, '650'),
(651, '651'),
(652, '652'),
(653, '653'),
(654, '654'),
(655, '655'),
(656, '656'),
(657, '657'),
(658, '658'),
(659, '659'),
(66, '66'),
(660, '660'),
(661, '661'),
(662, '662'),
(663, '663'),
(664, '664'),
(665, '665'),
(666, '666'),
(667, '667'),
(668, '668'),
(669, '669'),
(67, '67'),
(670, '670'),
(671, '671'),
(672, '672'),
(673, '673'),
(674, '674'),
(675, '675'),
(676, '676'),
(677, '677'),
(678, '678'),
(679, '679'),
(68, '68'),
(680, '680'),
(681, '681'),
(682, '682'),
(683, '683'),
(684, '684'),
(685, '685'),
(686, '686'),
(687, '687'),
(688, '688'),
(689, '689'),
(69, '69'),
(690, '690'),
(691, '691'),
(692, '692'),
(693, '693'),
(694, '694'),
(695, '695'),
(696, '696'),
(697, '697'),
(698, '698'),
(699, '699'),
(7, '7'),
(70, '70'),
(700, '700'),
(701, '701'),
(702, '702'),
(703, '703'),
(704, '704'),
(705, '705'),
(706, '706'),
(707, '707'),
(708, '708'),
(709, '709'),
(71, '71'),
(710, '710'),
(711, '711'),
(712, '712'),
(713, '713'),
(714, '714'),
(715, '715'),
(716, '716'),
(717, '717'),
(718, '718'),
(719, '719'),
(72, '72'),
(720, '720'),
(721, '721'),
(722, '722'),
(723, '723'),
(724, '724'),
(725, '725'),
(726, '726'),
(727, '727'),
(728, '728'),
(729, '729'),
(73, '73'),
(730, '730'),
(731, '731'),
(732, '732'),
(733, '733'),
(734, '734'),
(735, '735'),
(736, '736'),
(737, '737'),
(738, '738'),
(739, '739'),
(74, '74'),
(740, '740'),
(741, '741'),
(742, '742'),
(743, '743'),
(744, '744'),
(745, '745'),
(746, '746'),
(747, '747'),
(748, '748'),
(749, '749'),
(75, '75'),
(750, '750'),
(751, '751'),
(752, '752'),
(753, '753'),
(754, '754'),
(755, '755'),
(756, '756'),
(757, '757'),
(758, '758'),
(759, '759'),
(76, '76'),
(760, '760'),
(761, '761'),
(762, '762'),
(763, '763'),
(764, '764'),
(765, '765'),
(766, '766'),
(767, '767'),
(768, '768'),
(769, '769'),
(77, '77'),
(770, '770'),
(771, '771'),
(772, '772'),
(773, '773'),
(774, '774'),
(775, '775'),
(776, '776'),
(777, '777'),
(778, '778'),
(779, '779'),
(78, '78'),
(780, '780'),
(781, '781'),
(782, '782'),
(783, '783'),
(784, '784'),
(785, '785'),
(786, '786'),
(787, '787'),
(788, '788'),
(789, '789'),
(79, '79'),
(790, '790'),
(791, '791'),
(792, '792'),
(793, '793'),
(794, '794'),
(795, '795'),
(796, '796'),
(797, '797'),
(798, '798'),
(799, '799'),
(8, '8'),
(80, '80'),
(800, '800'),
(801, '801'),
(802, '802'),
(803, '803'),
(804, '804'),
(805, '805'),
(806, '806'),
(807, '807'),
(808, '808'),
(809, '809'),
(81, '81'),
(810, '810'),
(811, '811'),
(812, '812'),
(813, '813'),
(814, '814'),
(815, '815'),
(816, '816'),
(817, '817'),
(818, '818'),
(819, '819'),
(82, '82'),
(820, '820'),
(821, '821'),
(822, '822'),
(823, '823'),
(824, '824'),
(825, '825'),
(826, '826'),
(827, '827'),
(828, '828'),
(829, '829'),
(83, '83'),
(830, '830'),
(831, '831'),
(832, '832'),
(833, '833'),
(834, '834'),
(835, '835'),
(836, '836'),
(837, '837'),
(838, '838'),
(839, '839'),
(84, '84'),
(840, '840'),
(841, '841'),
(842, '842'),
(843, '843'),
(844, '844'),
(845, '845'),
(846, '846'),
(847, '847'),
(848, '848'),
(849, '849'),
(85, '85'),
(850, '850'),
(851, '851'),
(852, '852'),
(853, '853'),
(854, '854'),
(855, '855'),
(856, '856'),
(857, '857'),
(858, '858'),
(859, '859'),
(86, '86'),
(860, '860'),
(861, '861'),
(862, '862'),
(863, '863'),
(864, '864'),
(865, '865'),
(866, '866'),
(867, '867'),
(868, '868'),
(869, '869'),
(87, '87'),
(870, '870'),
(871, '871'),
(872, '872'),
(873, '873'),
(874, '874'),
(875, '875'),
(876, '876'),
(877, '877'),
(878, '878'),
(879, '879'),
(88, '88'),
(880, '880'),
(881, '881'),
(882, '882'),
(883, '883'),
(884, '884'),
(885, '885'),
(886, '886'),
(887, '887'),
(888, '888'),
(889, '889'),
(89, '89'),
(890, '890'),
(891, '891'),
(892, '892'),
(893, '893'),
(894, '894'),
(895, '895'),
(896, '896'),
(897, '897'),
(898, '898'),
(899, '899'),
(9, '9'),
(90, '90'),
(900, '900'),
(901, '901'),
(902, '902'),
(903, '903'),
(904, '904'),
(905, '905'),
(906, '906'),
(907, '907'),
(908, '908'),
(909, '909'),
(91, '91'),
(910, '910'),
(911, '911'),
(912, '912'),
(913, '913'),
(914, '914'),
(915, '915'),
(916, '916'),
(917, '917'),
(918, '918'),
(919, '919'),
(92, '92'),
(920, '920'),
(921, '921'),
(922, '922'),
(923, '923'),
(924, '924'),
(925, '925'),
(926, '926'),
(927, '927'),
(928, '928'),
(929, '929'),
(93, '93'),
(930, '930'),
(931, '931'),
(932, '932'),
(933, '933'),
(934, '934'),
(935, '935'),
(936, '936'),
(937, '937'),
(938, '938'),
(939, '939'),
(94, '94'),
(940, '940'),
(941, '941'),
(942, '942'),
(943, '943'),
(944, '944'),
(945, '945'),
(946, '946'),
(947, '947'),
(948, '948'),
(949, '949'),
(95, '95'),
(950, '950'),
(951, '951'),
(952, '952'),
(953, '953'),
(954, '954'),
(955, '955'),
(956, '956'),
(957, '957'),
(958, '958'),
(959, '959'),
(96, '96'),
(960, '960'),
(961, '961'),
(962, '962'),
(963, '963'),
(964, '964'),
(965, '965'),
(966, '966'),
(967, '967'),
(968, '968'),
(969, '969'),
(97, '97'),
(970, '970'),
(971, '971'),
(972, '972'),
(973, '973'),
(974, '974'),
(975, '975'),
(976, '976'),
(977, '977'),
(978, '978'),
(979, '979'),
(98, '98'),
(980, '980'),
(981, '981'),
(982, '982'),
(983, '983'),
(984, '984'),
(985, '985'),
(986, '986'),
(987, '987'),
(988, '988'),
(989, '989'),
(99, '99'),
(990, '990'),
(991, '991'),
(992, '992'),
(993, '993'),
(994, '994'),
(995, '995'),
(996, '996'),
(997, '997'),
(998, '998'),
(999, '999');

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE `song` (
  `id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `title` varchar(50) NOT NULL,
  `artist` varchar(50) NOT NULL,
  `released_date` date NOT NULL,
  `song_file` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`id`, `image`, `title`, `artist`, `released_date`, `song_file`) VALUES
(1, 'song_image\\Taylor_Swift_Anti-Hero.jpeg', 'Anti-Hero', 'Taylor Swift', '2022-10-21', 'https://open.spotify.com/track/0V3wPSX9ygBnCm8psDIegu?si=bb21995bacf341a9'),
(2, 'song_image\\Taylor_Swift_Blank_Space.png', 'Blank Space', 'Taylor Swift', '2024-11-10', 'https://open.spotify.com/track/1u8c2t2Cy7UBoG4ArRcF5g?si=80bc4bdda79f4f0b'),
(3, 'song_image\\Taylor_Swift_Cruel_Summer.png', 'Cruel Summer', 'Taylor Swift', '2023-06-13', 'https://open.spotify.com/track/1BxfuPKGuaTgP7aM0Bbdwr?si=943e73991741484e'),
(4, 'song_image\\Taylor_Swift_dont_blame_me.png', 'Don\'t Blame Me', 'Taylor Swift', '2017-11-10', 'https://open.spotify.com/track/1R0a2iXumgCiFb7HEZ7gUE?si=2d7ef6ccfe0442d8'),
(5, 'song_image\\Taylor_Swift_isitovernow.png', 'Is It Over Now?', 'Taylor Swift', '2023-10-31', 'https://open.spotify.com/track/1Iq8oo9XkmmvCQiGOfORiz?si=9447ae9b426b4d41'),
(6, 'song_image\\Taylor_Swift_karma.png', 'Karma', 'Taylor Swift', '2023-05-01', 'https://open.spotify.com/track/7KokYm8cMIXCsGVmUvKtqf?si=c2c2fd5dd226448a'),
(7, 'song_image\\Taylor_Swift_Love_Story.png', 'Love Story', 'Taylor Swift', '2008-09-15', 'https://open.spotify.com/track/6YvqWjhGD8mB5QXcbcUKtx?si=346728cbd6c248e6'),
(8, 'song_image\\Taylor_Swift_Lover.png', 'Lover', 'Taylor Swift', '2019-08-23', 'https://open.spotify.com/track/1dGr1c8CrMLDpV6mPbImSI?si=8fbfc7a038964622'),
(9, 'song_image\\loveonthebrain.jpg', 'Love On The Brain', 'Rihanna', '2016-09-27', 'https://open.spotify.com/track/5oO3drDxtziYU2H1X23ZIp?si=ee23505993a544a0'),
(10, 'song_image\\Diamonds_Rihanna.png\r\n', 'Diamonds', 'Rihanna', '2012-09-26', 'https://open.spotify.com/track/4JQSMg83F8qYwSBt5xOXsQ?si=da10808e40b242ca'),
(11, 'song_image\\dont_stop_the_music_rihanna.jpg', 'Dont Stop The Music', 'Rihanna', '2007-09-07', 'https://open.spotify.com/track/0ByMNEPAPpOR5H69DVrTNy?si=a9b5c1cc40324ad6'),
(12, 'song_image\\stay.jpg', 'Stay', 'Rihanna', '2012-12-13', 'https://open.spotify.com/track/4zzzZ1UNfr75ASG1lUE9L1?si=4f336ed556e14ec7'),
(13, 'song_image\\needed_me.jpg', 'Needed Me', 'Rihanna', '2016-03-30', 'https://open.spotify.com/track/4pAl7FkDMNBsjykPXo91B3?si=e305686ab124406d'),
(14, 'song_image\\rihanna_wefoundlove.jpg', 'We Found Love', 'Rihanna', '2011-09-22', 'https://open.spotify.com/track/6qn9YLKt13AGvpq9jfO8py?si=1468749f270f48a4'),
(15, 'song_image\\This_Is_What_You_Came_For_cover.png', 'This Is What You Came For ', 'Rihanna ,  Calvin Harris', '2016-04-29', 'https://open.spotify.com/track/0azC730Exh71aQlOt9Zj3y?si=b44c83c6ac104a88'),
(16, 'song_image\\rihannaOnly_Girl_(In_the_World).png', 'Only Girl (In the World)', 'Rihanna', '2010-09-10', 'https://open.spotify.com/track/2ENexcMEMsYk0rVJigVD3i?si=40f01e91ed9f46cf'),
(17, 'song_image\\umbrella.jpg', 'Umbrella', 'Rihanna', '2007-03-29', 'https://open.spotify.com/track/49FYlytm3dAAraYgpoJZux?si=9b30c2de6a354679'),
(18, 'song_image\\s&m.jpg', 'S & M', 'Rihanna', '2011-01-23', 'https://open.spotify.com/track/7ySUcLPVX7KudhnmNcgY2D?si=3f14d2de29e24e73'),
(19, 'song_image\\Ed_Sheeran_Perfect_Single_cover.jpg', 'Prefect', 'Ed Sheeran', '2017-09-26', 'https://open.spotify.com/track/0tgVpDi06FyKpA1z0VMD4v?si=94e635380a0143bd'),
(20, 'song_image\\Shape_Of_You_(Official_Single_Cover)_by_Ed_Sheeran.png', 'Shape of You', 'Ed Sheeran', '2017-01-17', 'https://open.spotify.com/track/7qiZfU4dY1lWllzX7mPBI3?si=9347854731b54535');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id` int(11) NOT NULL,
  `voucher_id` varchar(10) NOT NULL,
  `voucher_name` varchar(20) NOT NULL,
  `discount` float NOT NULL,
  `valid_date` date NOT NULL,
  `owner` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `history_image`
--
ALTER TABLE `history_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `seat_number` (`seat_number`);

--
-- Indexes for table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `history_image`
--
ALTER TABLE `history_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- AUTO_INCREMENT for table `song`
--
ALTER TABLE `song`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;