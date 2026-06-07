-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql302.infinityfree.com
-- Generation Time: 07 يونيو 2026 الساعة 10:53
-- إصدار الخادم: 11.4.12-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_38924002_login_db2`
--

-- --------------------------------------------------------

--
-- بنية الجدول `games`
--

CREATE TABLE `games` (
  `game_id` int(11) NOT NULL,
  `game_name` varchar(255) NOT NULL,
  `game_url` varchar(500) NOT NULL,
  `info` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `games`
--

INSERT INTO `games` (`game_id`, `game_name`, `game_url`, `info`) VALUES
(1, 'AstroBot', 'https://myhotposters.com/cdn/shop/files/mL7382_1024x1024.jpg?v=1729362123', 'a 2024 platform game developed by Team Asobi and published by Sony Interactive Entertainment for the PlayStation 5 to coincide with PlayStation\'s 30th anniversary. Following Astro\'s Playroom (2020), it is the fifth overall installment in the Astro Bot series and marks Team Asobi\'s first game developed since its separation from Japan Studio. As the titular protagonist Astro, the player embarks on a quest to save lost Bots, retrieve parts for the PlayStation 5 mothership, and defeat the alien Spac'),
(2, 'Dragon Ball: Sparking! Zero', 'https://image.api.playstation.com/vulcan/ap/rnd/202405/2216/49945d4666d6443329a2593cbcdcb7cd6325ec1cc654563f.jpg', 'Developed by Spike Chunsoft and published by Bandai Namco, it revives the Budokai Tenkaichi series with high-speed 3D arena battles. Featuring massive character rosters and destructible environments, it’s a dream game for DBZ fans.'),
(3, 'HellDivers II', 'https://helldivers.wiki.gg/images/5/5e/HD2_SteamLibrary-Portrait.jpg?ffffe7', 'Helldivers 2 is a 2024 cooperative third-person shooter game developed by Arrowhead Game Studios and published by Sony Interactive Entertainment for the PlayStation 5 and Windows. The game is the direct sequel to Helldivers (2015). Set in the 22nd century, the story follows the Helldivers, an elite force of shock troops dispatched to combat various threats to humanity. '),
(5, 'Call of Duty: Black Ops 6', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSV4NV-1-4NBZBsdXzgrx1j9nnw0PmJB3OzTH-8eiUIJcuMEO5VJear917f3vZJlldixuU&usqp=CAU', 'Call of Duty®: Black Ops 6 is signature Black Ops across a cinematic single-player Campaign, a best-in-class Multiplayer experience and with the epic return of Round-Based Zombies. '),
(6, 'Like a Dragon: Infinite Wealth', 'https://moreigr.org/uploads/posts/2024-01/like-a-dragon-infinite-wealth-1.jpg', 'Developed by Ryu Ga Gotoku Studio and published by SEGA, this RPG continues Ichiban Kasuga’s journey alongside series veteran Kazuma Kiryu. Set in Hawaii and Japan, it features turn-based combat and wacky humor. It’s the eighth main entry in the Yakuza/Like a Dragon series.'),
(8, 'Final Fantasy VII Rebirth', 'https://i.etsystatic.com/37268737/r/il/35be3e/5852102385/il_fullxfull.5852102385_g8pm.jpg', 'Developed and published by Square Enix, this is the second part of the Final Fantasy VII Remake project. It expands the story beyond Midgar with a semi-open world, real-time combat, and character-driven exploration. It’s exclusive to PlayStation 5.'),
(9, 'Elden Ring Shadow of the Erdtree', 'https://storage.googleapis.com/pod_public/1300/230646.jpg', 'An expansion for Elden Ring, developed by FromSoftware and published by Bandai Namco. This DLC explores the mysterious Land of Shadow, diving deeper into the lore of the Lands Between. Expect challenging bosses and cryptic storytelling.'),
(10, 'Black Myth: Wukong', 'https://m.media-amazon.com/images/M/MV5BNGVmZTVjZDMtMzkyZi00MTczLWE4OTUtY2Y1ODBlMGFlYTAxXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'Developed by Game Science, this action RPG is inspired by Journey to the West. It features fast-paced Soulslike combat and stunning visuals powered by Unreal Engine 5. Players take on the role of the Destined One.'),
(11, 'Dragon’s Dogma 2', 'https://e.snmc.io/lk/l/x/afdc50f394267ca1f03e67d27b81d478/11548573', 'A long-awaited sequel from Capcom, this open-world action RPG brings back the Pawn system and dynamic combat. Players embark on a quest filled with mythical beasts, exploration, and a deep fantasy narrative. Built on the RE Engine.'),
(13, 'Indiana Jones and the Great Circle', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTPHHZQnuMRtApsBdGHgZvPbo_ZlcGM4QIqVl90RABo_-GnTyqOyQ0nAYqzslhj8v2SHS0&usqp=CAU', 'An action-adventure game developed by MachineGames and published by Bethesda. Set between Raiders of the Lost Ark and The Last Crusade, players control Indy in a first-person cinematic experience full of puzzles, relics, and Nazi-fighting.'),
(14, 'Tekken 8', 'https://www.yourdecoration.co.uk/cdn/shop/files/Poster-Tekken-8-Key-Art-61x91-5cm-PP35447_176067bc-9fed-4232-9cd9-d86560f3eac9.jpg?v=1739864608', 'Developed and published by Bandai Namco, this latest entry in the iconic fighting series continues the Mishima saga. Built on Unreal Engine 5, it introduces aggressive mechanics and stunning visuals, with classic characters and new challengers.'),
(16, 'Pacific Drive', 'https://m.media-amazon.com/images/M/MV5BYWQzNWEzYjgtYzY5Yy00NjNhLTg2ODMtODNlYmYwODEyOWZlXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'Developed by Ironwood Studios and published by Kepler Interactive, this is a first-person survival driving game. Set in a surreal reimagining of the Pacific Northwest, players upgrade their station wagon and survive anomalies in a dynamic world.'),
(18, 'Silent Hill 2 Remake', 'https://image.api.playstation.com/vulcan/ap/rnd/202404/2513/2a6901fad9bd11ff2a5fc0c63915ba16cd06d623dbf62043.jpg', 'A faithful remake of the horror classic, developed by Bloober Team and published by Konami. The game retains its psychological horror roots with updated visuals, sound, and gameplay for modern audiences. Exclusive to PS5 and PC.'),
(20, 'Prince of Persia: The Lost Crown', 'https://i.ebayimg.com/images/g/JjgAAOSwZHxlo-jb/s-l1200.jpg', 'Developed and published by Ubisoft, this side-scrolling action-adventure revives the franchise with Metroidvania gameplay. Play as Sargon, a warrior with time powers, exploring a cursed city full of traps and monsters.'),
(21, 'S.T.A.L.K.E.R. 2', 'https://m.media-amazon.com/images/M/MV5BOGJmNmRjMDUtMzM1OS00ZTVlLTkzZjUtZjA2NGI4ODI0MjEzXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'Developed by GSC Game World, this first-person survival horror shooter is set in the radioactive Exclusion Zone. Combining immersive sim mechanics with a haunting narrative, it features a massive open world and is coming to Xbox and PC.'),
(22, 'EA Sports FC 25', 'https://pbs.twimg.com/media/GPZFDQrWcAAJkXu?format=jpg&name=4096x4096', 'The next entry in EA’s football series after parting ways with FIFA. Developed by EA Sports, it features real clubs, players, and leagues. Expect improved graphics, gameplay mechanics, and new modes across consoles and PC.'),
(23, 'Marvel Rivals', 'https://m.media-amazon.com/images/M/MV5BMDExODM1MjItNDA1Zi00NGQ3LTkwYTctNmFhODhkNjRmNzJkXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'A team-based PvP shooter developed by NetEase Games in collaboration with Marvel Games. Players control iconic Marvel heroes and villains in 6v6 battles across destructible environments. Think Overwatch meets Marvel universe.');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`ID`, `username`, `password`) VALUES
(237, 'Nam', '$2y$10$8SldIxjsMcpBAqrkFDNO6uMRW7zUZOVF6KPXUDmJOiflOZ/Va/iPa'),
(238, 'squeez', '$2y$10$VaWCOc58gCpsyWXx4..uTeefOjZnoq18bG8bWkfHfRdKNEZBz1urq'),
(239, 'Amoraaa', '$2y$10$QrtlCY/H3K4I9Y0tpQCno.7iUeJQK9MhXZXixYFLcNvdiQfTTDsjq'),
(240, 'kbze', '$2y$10$Uwog/M.Qlo/O1FuqM3onh.bQT7S/R2hlSXNrhKWJyePv7ert0w/YS'),
(242, 'goku', '$2y$10$5HV6nzgN/pFIglyHwYdBi.f6wYXt/pd6FuUQb9qwWhDMwaBzgPgQC'),
(243, 'Sultanah', '$2y$10$4zMF5wpXgHsvh6QAKXcJQO13d9CM/GTbgTlHTPoPLILdQb5TMMXCK'),
(244, 'Mnb', '$2y$10$mTD3Gz3uTAq3vn5Z.jZbruIrUdGli.bnxscesuQcqxNaJKBy5Ikk6'),
(245, 'orishoSS', '$2y$10$1xFJ78dxj5nmUwSrmsM21.VW5UMrNamVIQ3fYwTEiqyhCC9ArPRee'),
(246, 'orishoA', '$2y$10$Va6tfDEro5MUsJpkOBYXEufJU8JgbbbtVuQk46gCXr3i8iAm5CSZa'),
(265, 'orishoe', '$2y$10$/bnJSOleyzc/qZ3CV.S2xuttLqU4nox8y9FcTecSbyI/YGHHCJDV6'),
(266, 'orishosq', '$2y$10$eUb4xu051MvC11LamrZDy..KLo6/38/QlUFus/ruDFD4l0FonM4Ia'),
(279, 'orisho', '$2y$10$KYRUu5Qjt4W4ZVFR.yGmNulsZfFlb9R68rEoIaril3DXl7vvamN2G'),
(280, 'Chrome', '$2y$10$8gq8XYaNUB3BtzA0d5LX/uGrU5mt7Nma6Bf6j9cd02BzpNbAgw0IG');

-- --------------------------------------------------------

--
-- بنية الجدول `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `game_id` int(11) NOT NULL,
  `game_name` varchar(255) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `voted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `votes`
--

INSERT INTO `votes` (`id`, `username`, `game_id`, `game_name`, `score`, `voted_at`) VALUES
(172, 'squeez', 1, 'AstroBot', 1, '2025-05-08 17:48:27'),
(173, 'kbze', 14, 'Tekken 8', 1, '2025-05-08 19:53:59'),
(174, 'Amoraaa', 5, 'Call of Duty: Black Ops 6', 1, '2025-05-08 19:54:40'),
(175, 'goku', 2, 'Dragon Ball: Sparking! Zero', 1, '2025-05-24 15:41:22'),
(176, 'Sultanah', 1, 'AstroBot', 1, '2025-05-25 21:26:07'),
(177, 'orishoA', 1, 'AstroBot', 1, '2025-08-21 23:31:32'),
(181, 'Chrome', 1, 'AstroBot', 1, '2025-08-22 18:07:26'),
(183, 'orisho', 2, 'Dragon Ball: Sparking! Zero', 1, '2026-02-05 22:54:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
