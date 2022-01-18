-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Sty 2022, 21:44
-- Wersja serwera: 10.4.20-MariaDB
-- Wersja PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `memy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `grafiki`
--

CREATE TABLE `grafiki` (
  `id` int(11) NOT NULL,
  `adresy` text NOT NULL,
  `opis` text NOT NULL,
  `user` text NOT NULL,
  `rozszerzenie` text NOT NULL,
  `addTime` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `grafiki`
--

INSERT INTO `grafiki` (`id`, `adresy`, `opis`, `user`, `rozszerzenie`, `addTime`) VALUES
(19, 'PIC_6187d8849de67', 'siema tu opis elo', 'Konasx3', 'jpg', '2020-11-03'),
(20, 'PIC_6187d88b9bf50', 'smietnik stacha2', 'Konasx3', 'jpg', '2021-10-13'),
(21, 'PIC_6187d892df4bc', 'Maciek czarodziej', 'Konasx3', 'jpg', '2021-10-13'),
(22, 'PIC_61897c6f10c24', 'Wiesiek wszywka', 'Konasx3', 'jpg', '2021-11-09'),
(27, 'PIC_6189988d4efc2', 'Święty mikołaj', 'Konasx3', 'jpg', '2021-09-30'),
(28, 'PIC_618ac7f8756ac', 'a huj wi', 'Konasx3', 'png', '2021-11-01'),
(29, 'PIC_618ae48a8f440', '', 'Pornosy', 'png', '0000-00-00'),
(30, 'PIC_618ae86f9d70e', 'fbksfyogbcfyxyjhgyfvrkyguzdrhuzfhukzxfzugkrf', 'Konasx3', 'png', '0000-00-00'),
(31, 'PIC_6190f1912ec0c', 'kaczka maćka', 'Konasx3', 'png', '2021-11-14'),
(32, 'PIC_61b10da1f3423', 'smieszne', 'Konasx3', 'png', '2021-12-08'),
(33, 'PIC_61b10db48e1f2', 'Śmieszne hehe', 'Konasx3', 'png', '2021-12-08'),
(34, 'PIC_61b10f242a6b9', 'ale mi nogi dupia', 'Gosia123', 'jpg', '2021-12-08');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konta`
--

CREATE TABLE `konta` (
  `id` int(11) NOT NULL,
  `user` text NOT NULL,
  `pass` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `konta`
--

INSERT INTO `konta` (`id`, `user`, `pass`, `email`) VALUES
(2, 'Maciek', '$2y$10$q0aB8uivfxJnS0Zg660BoOALLjG8ORX38SD7ycBefhQM6bJK6UsCO', 'maciek@gmail.com'),
(3, 'Gosia1', '$2y$10$6GMKd93tbY7W0X05VVzJ6.UG2IclmuUqiZsnzfo/z2SydwibU6KYu', 'gosia@gmail.com'),
(4, 'Konasx3', '$2y$10$R3SfyTHRtE6mLbrWYstU9.j9SZYBZU7Xy95U4ZyC3COjhrPoa7ZHq', 'konasgpro@gmail.com'),
(5, 'Pornosy', '$2y$10$3182GP5V4p7W6auucvvjw.RlsiXEzya.FJfJcAFi5KsMgvYhkDuZe', 'pornosy@gmail.com'),
(6, 'Gosia123', '$2y$10$IJBZXsISQUQbuhNIE0U32Ock7fqzG6.cC.nkps.YsHP.aApEa2frO', 'bebok@gmail.com');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `user` text NOT NULL,
  `opis` text NOT NULL,
  `pelnyAdres` text NOT NULL,
  `nowyAdres` text NOT NULL,
  `addTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `video`
--

INSERT INTO `video` (`id`, `user`, `opis`, `pelnyAdres`, `nowyAdres`, `addTime`) VALUES
(4, 'Konasx3', 'pierwszy filmik', 'https://www.youtube.com/watch?v=a-7Li0QK8Ok', 'a-7Li0QK8Ok', '2021-12-30 20:58:36'),
(5, 'Konasx3', 'film 2', 'https://www.youtube.com/watch?v=CgZDttfdVAc&list=RDCgZDttfdVAc&start_radio=1', 'CgZDttfdVAc&list=RDCgZDttfdVAc&start_radio=1', '2021-12-30 22:15:03'),
(6, 'Konasx3', 'film3', 'https://www.youtube.com/watch?v=Wc6F5tPaHtA', 'Wc6F5tPaHtA', '2021-12-30 22:15:16'),
(7, 'Konasx3', 'film4', 'https://www.youtube.com/watch?v=11pIq5-Nm54', '11pIq5-Nm54', '2021-12-30 22:15:27'),
(8, 'Konasx3', 'film5', 'https://www.youtube.com/watch?v=xiIHDg1pRIg', 'xiIHDg1pRIg', '2021-12-30 22:15:46'),
(9, 'Konasx3', 'film 6', 'https://www.youtube.com/watch?v=VDT-Ku_pY7U', 'VDT-Ku_pY7U', '2021-12-30 22:16:05'),
(10, 'Konasx3', 'film 7', 'https://www.youtube.com/watch?v=jRmdssX9l2g', 'jRmdssX9l2g', '2021-12-30 22:16:21'),
(11, 'Konasx3', 'pyk', 'https://www.youtube.com/watch?v=dF0P-gDVZuQ', 'dF0P-gDVZuQ', '2021-12-30 22:21:32');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `grafiki`
--
ALTER TABLE `grafiki`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `konta`
--
ALTER TABLE `konta`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `grafiki`
--
ALTER TABLE `grafiki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT dla tabeli `konta`
--
ALTER TABLE `konta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
