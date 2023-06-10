-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2023 at 11:05 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `formulaire`
--

-- --------------------------------------------------------

--
-- Table structure for table `antecedents`
--

CREATE TABLE `antecedents` (
  `id` int(11) NOT NULL,
  `type` enum('personnels','familiaux','toxiques') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `antecedents`
--

INSERT INTO `antecedents` (`id`, `type`) VALUES
(1, 'personnels'),
(2, 'familiaux'),
(3, 'toxiques');

-- --------------------------------------------------------

--
-- Table structure for table `anti_infectieux`
--

CREATE TABLE `anti_infectieux` (
  `id` int(11) NOT NULL,
  `antiInfectieux` varchar(20) DEFAULT NULL,
  `antiInfectieux_value` varchar(200) DEFAULT NULL,
  `autres` varchar(200) DEFAULT NULL,
  `traitementId` int(11) DEFAULT 3,
  `patientId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `av_adelphe`
--

CREATE TABLE `av_adelphe` (
  `id` int(11) NOT NULL,
  `AV_adelphe` varchar(50) DEFAULT NULL,
  `AV_adelphe_Value` varchar(50) DEFAULT NULL,
  `AV_adelphe_ratingValue` varchar(200) DEFAULT NULL,
  `hypertrophieGlandesLacrymales` varchar(20) DEFAULT NULL,
  `hyperhémieConjonctivale` varchar(20) DEFAULT NULL,
  `cerclePérikératique` varchar(20) DEFAULT NULL,
  `précipitésRétrodescémétique` varchar(20) DEFAULT NULL,
  `kératite` varchar(20) DEFAULT NULL,
  `tyndall` varchar(20) DEFAULT NULL,
  `hypopion` varchar(20) DEFAULT NULL,
  `fibrine` varchar(20) DEFAULT NULL,
  `hypoéma` varchar(20) DEFAULT NULL,
  `synéchiesIridocristalinienne` varchar(20) DEFAULT NULL,
  `nodules` varchar(20) DEFAULT NULL,
  `heterochromie` varchar(20) DEFAULT NULL,
  `atrophie` varchar(20) DEFAULT NULL,
  `transparent` varchar(20) DEFAULT NULL,
  `cataracte` varchar(20) DEFAULT NULL,
  `normo` varchar(20) DEFAULT NULL,
  `hypo` varchar(20) DEFAULT NULL,
  `hyper` varchar(20) DEFAULT NULL,
  `goniosynechie` varchar(20) DEFAULT NULL,
  `hyalite` varchar(20) DEFAULT NULL,
  `oeufsFourmi` varchar(20) DEFAULT NULL,
  `foyersChorioretinites` varchar(20) DEFAULT NULL,
  `oedemeMaculaire` varchar(20) DEFAULT NULL,
  `vascularite` varchar(20) DEFAULT NULL,
  `papillite` varchar(20) DEFAULT NULL,
  `sclerite` varchar(20) DEFAULT NULL,
  `reste_examens` varchar(200) DEFAULT NULL,
  `examenId` int(11) DEFAULT 2,
  `patientId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `av_atteint`
--

CREATE TABLE `av_atteint` (
  `id` int(11) NOT NULL,
  `AV_atteint` varchar(20) DEFAULT NULL,
  `AV_atteint_value` varchar(20) DEFAULT NULL,
  `AV_atteint_ratingValue` varchar(200) DEFAULT NULL,
  `examenId` int(11) DEFAULT 1,
  `patientId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `biothérapie`
--

CREATE TABLE `biothérapie` (
  `id` int(11) NOT NULL,
  `biothérapie` varchar(20) DEFAULT NULL,
  `interféron` varchar(20) DEFAULT NULL,
  `immunoglobulinesIntraveineuses` varchar(20) DEFAULT NULL,
  `ProteinesFusion` varchar(20) DEFAULT NULL,
  `ProteinesFusion_Value` varchar(200) DEFAULT NULL,
  `traitementId` int(11) DEFAULT 4,
  `patientId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clinique`
--

CREATE TABLE `clinique` (
  `id` int(11) NOT NULL,
  `type` enum('signes_dappel_oculaires','Signes_dappel_extra_oculaires') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clinique`
--

INSERT INTO `clinique` (`id`, `type`) VALUES
(1, 'signes_dappel_oculaires'),
(2, 'Signes_dappel_extra_oculaires');

-- --------------------------------------------------------

--
-- Table structure for table `consultations`
--

CREATE TABLE `consultations` (
  `id` int(11) NOT NULL,
  `modeInstallation` varchar(20) DEFAULT NULL,
  `localisation` varchar(50) DEFAULT NULL,
  `localisationAntéroPost` varchar(50) DEFAULT NULL,
  `ŒilAtteint` varchar(50) DEFAULT NULL,
  `patientId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `corticothérapie`
--

CREATE TABLE `corticothérapie` (
  `id` int(11) NOT NULL,
  `corticothérapie` varchar(20) DEFAULT NULL,
  `local` varchar(20) DEFAULT NULL,
  `general` varchar(20) DEFAULT NULL,
  `bolus` varchar(20) DEFAULT NULL,
  `voieOrale` varchar(20) DEFAULT NULL,
  `doseInitial` varchar(200) DEFAULT NULL,
  `traitementId` int(11) DEFAULT 1,
  `patientId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `etiologie_retenue`
--

CREATE TABLE `etiologie_retenue` (
  `id` int(11) NOT NULL,
  `maladieSystémique` varchar(20) DEFAULT NULL,
  `maladieSystémique_value` varchar(200) DEFAULT NULL,
  `infectieuse` varchar(20) DEFAULT NULL,
  `infectieuse_value` varchar(200) DEFAULT NULL,
  `autre` varchar(200) DEFAULT NULL,
  `args_etiologie` varchar(200) DEFAULT NULL,
  `patientId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evolutions`
--

CREATE TABLE `evolutions` (
  `id` int(11) NOT NULL,
  `rémissionComplète` varchar(20) DEFAULT NULL,
  `rémissionPartielle` varchar(20) DEFAULT NULL,
  `résistance` varchar(20) DEFAULT NULL,
  `récidive` varchar(20) DEFAULT NULL,
  `séquelles` varchar(20) DEFAULT NULL,
  `complicationIatrogène` varchar(20) DEFAULT NULL,
  `complicationIatrogène_value` varchar(200) DEFAULT NULL,
  `recul` int(11) DEFAULT NULL,
  `patientId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `examen_ophtalmologique`
--

CREATE TABLE `examen_ophtalmologique` (
  `id` int(11) NOT NULL,
  `type` enum('AV_atteint','AV_adelphe','resteExamen') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `examen_ophtalmologique`
--

INSERT INTO `examen_ophtalmologique` (`id`, `type`) VALUES
(1, 'AV_atteint'),
(2, 'AV_adelphe');

-- --------------------------------------------------------

--
-- Table structure for table `familiaux`
--

CREATE TABLE `familiaux` (
  `id` int(11) NOT NULL,
  `antécédentDuvéite` varchar(20) DEFAULT NULL,
  `antécédentDuvéite_value` varchar(50) DEFAULT NULL,
  `autres` varchar(200) DEFAULT NULL,
  `antecedentid` int(11) DEFAULT 2,
  `patientId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `immunosuppresseur`
--

CREATE TABLE `immunosuppresseur` (
  `id` int(11) NOT NULL,
  `immunosuppresseur` varchar(20) DEFAULT NULL,
  `cyclophosphamide` varchar(20) DEFAULT NULL,
  `azathioprine` varchar(20) DEFAULT NULL,
  `ciclosporine` varchar(20) DEFAULT NULL,
  `antiTNFx` varchar(20) DEFAULT NULL,
  `autre` varchar(200) DEFAULT NULL,
  `traitementId` int(11) DEFAULT 2,
  `patientId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investigations`
--

CREATE TABLE `investigations` (
  `id` int(11) NOT NULL,
  `type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `investigations`
--

INSERT INTO `investigations` (`id`, `type`) VALUES
(1, 'investigations_etiologique'),
(2, 'investigations_biologique'),
(3, 'investigations_radiologiques');

-- --------------------------------------------------------

--
-- Table structure for table `investigations_biologique`
--

CREATE TABLE `investigations_biologique` (
  `id` int(11) NOT NULL,
  `NFS` varchar(20) DEFAULT NULL,
  `NFS_Value` varchar(200) DEFAULT NULL,
  `glycémie` varchar(20) DEFAULT NULL,
  `VS` varchar(20) DEFAULT NULL,
  `VS_Value` varchar(200) DEFAULT NULL,
  `CRP` varchar(20) DEFAULT NULL,
  `CRP_Value` varchar(200) DEFAULT NULL,
  `EPP` varchar(20) DEFAULT NULL,
  `EPP_Value` varchar(200) DEFAULT NULL,
  `ECA` varchar(20) DEFAULT NULL,
  `ECA_Value` varchar(200) DEFAULT NULL,
  `bilanCalcique` varchar(20) DEFAULT NULL,
  `bilanCalcique_Value` varchar(200) DEFAULT NULL,
  `ANCA` varchar(20) DEFAULT NULL,
  `AAN` varchar(20) DEFAULT NULL,
  `HLA_B27` varchar(20) DEFAULT NULL,
  `FR` varchar(20) DEFAULT NULL,
  `IDR` varchar(20) DEFAULT NULL,
  `bilanRenalHepatique` varchar(20) DEFAULT NULL,
  `HVB` varchar(20) DEFAULT NULL,
  `HVC` varchar(20) DEFAULT NULL,
  `TPHA_VDRL` varchar(20) DEFAULT NULL,
  `serologieVIH` varchar(20) DEFAULT NULL,
  `serologieToxoplasmose` varchar(20) DEFAULT NULL,
  `serologieCMV` varchar(50) DEFAULT NULL,
  `BGSA` varchar(50) DEFAULT NULL,
  `pathergyTest` varchar(50) DEFAULT NULL,
  `investigationId` int(11) DEFAULT 2,
  `patientId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investigations_etiologique`
--

CREATE TABLE `investigations_etiologique` (
  `id` int(11) NOT NULL,
  `champVisuel` varchar(200) DEFAULT NULL,
  `testColeur` varchar(200) DEFAULT NULL,
  `echoOculaire` varchar(200) DEFAULT NULL,
  `ERG` varchar(200) DEFAULT NULL,
  `octPapille` varchar(200) DEFAULT NULL,
  `octRetine` varchar(200) DEFAULT NULL,
  `EOG` varchar(200) DEFAULT NULL,
  `PEV` varchar(200) DEFAULT NULL,
  `PCA` varchar(200) DEFAULT NULL,
  `aniographie` varchar(200) DEFAULT NULL,
  `vertDindocyanine` varchar(200) DEFAULT NULL,
  `investigationId` int(11) DEFAULT 1,
  `patientId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investigations_radiologiques`
--

CREATE TABLE `investigations_radiologiques` (
  `id` int(11) NOT NULL,
  `RX_sinus` varchar(20) DEFAULT NULL,
  `RX_sinus_Value` varchar(200) DEFAULT NULL,
  `RX_bassin` varchar(20) DEFAULT NULL,
  `RX_bassin_Value` varchar(200) DEFAULT NULL,
  `RX_rachisLombaire` varchar(20) DEFAULT NULL,
  `RX_rachisLombaire_Value` varchar(200) DEFAULT NULL,
  `RX_sacroIliaques` varchar(20) DEFAULT NULL,
  `RX_sacroIliaques_Value` varchar(200) DEFAULT NULL,
  `TDM_thoracique` varchar(20) DEFAULT NULL,
  `TDM_thoracique_Value` varchar(200) DEFAULT NULL,
  `autres` varchar(200) DEFAULT NULL,
  `investigationId` int(11) DEFAULT 3,
  `patientId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `nom` varchar(200) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `sexe` varchar(50) DEFAULT NULL,
  `origineGéographique` varchar(50) DEFAULT NULL,
  `niveauSocio_économique` varchar(50) DEFAULT NULL,
  `statutMatrimonial` varchar(50) DEFAULT NULL,
  `profession` varchar(200) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personnels`
--

CREATE TABLE `personnels` (
  `id` int(11) NOT NULL,
  `mst` varchar(20) DEFAULT NULL,
  `mst_value` varchar(50) DEFAULT NULL,
  `contactAvecLesChats` varchar(20) DEFAULT NULL,
  `priseMédicamenteuse` varchar(20) DEFAULT NULL,
  `priseMédicamenteuse_value` varchar(50) DEFAULT NULL,
  `autres` varchar(200) DEFAULT NULL,
  `antecedentid` int(11) DEFAULT 1,
  `patientId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `personnels`
--
DELIMITER $$
CREATE TRIGGER `mst_trigger` BEFORE INSERT ON `personnels` FOR EACH ROW BEGIN
  IF NEW.mst != 'oui' THEN
    SET NEW.mst_value = NULL;
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `signes_dappel_extra_oculaires`
--

CREATE TABLE `signes_dappel_extra_oculaires` (
  `id` int(11) NOT NULL,
  `Allergie` varchar(20) DEFAULT NULL,
  `signesRhumatologiques` varchar(20) DEFAULT NULL,
  `herpès` varchar(20) DEFAULT NULL,
  `vitiligo` varchar(20) DEFAULT NULL,
  `poliose` varchar(20) DEFAULT NULL,
  `erythèmeNoueux` varchar(20) DEFAULT NULL,
  `pseudoFolliculite` varchar(20) DEFAULT NULL,
  `aphtoseBuccale` varchar(20) DEFAULT NULL,
  `aphtoseGénitale` varchar(20) DEFAULT NULL,
  `signesNeurologiques` varchar(20) DEFAULT NULL,
  `signesPulmonaires` varchar(20) DEFAULT NULL,
  `signesORL` varchar(20) DEFAULT NULL,
  `signesCardioVasculaires` varchar(20) DEFAULT NULL,
  `signesGynécoUrinaires` varchar(20) DEFAULT NULL,
  `signesGastroIntestinaux` varchar(20) DEFAULT NULL,
  `cliniqueId` int(11) DEFAULT 2,
  `patientId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `signes_dappel_oculaires`
--

CREATE TABLE `signes_dappel_oculaires` (
  `id` int(11) NOT NULL,
  `larmoiement` varchar(20) DEFAULT NULL,
  `photophobie` varchar(20) DEFAULT NULL,
  `Blépharospasme` varchar(20) DEFAULT NULL,
  `douleursPériorbitaire` varchar(20) DEFAULT NULL,
  `rougeurOculaire` varchar(20) DEFAULT NULL,
  `diminutionDeLacuitéVisuelle` varchar(20) DEFAULT NULL,
  `myiodésopsie` varchar(20) DEFAULT NULL,
  `métamorphopsie` varchar(20) DEFAULT NULL,
  `céphalées` varchar(20) DEFAULT NULL,
  `flouVisuel` varchar(20) DEFAULT NULL,
  `ATCD_duvéite` varchar(20) DEFAULT NULL,
  `autres` varchar(200) DEFAULT NULL,
  `cliniqueId` int(11) DEFAULT 1,
  `patientId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `toxiques`
--

CREATE TABLE `toxiques` (
  `id` int(11) NOT NULL,
  `toxique` varchar(20) DEFAULT NULL,
  `toxique_value` varchar(200) DEFAULT NULL,
  `antecedentId` int(11) DEFAULT 3,
  `patientId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `traitements`
--

CREATE TABLE `traitements` (
  `id` int(11) NOT NULL,
  `type` enum('corticothérapie','immunosuppresseur','anti_infectieux','biothérapie') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `traitements`
--

INSERT INTO `traitements` (`id`, `type`) VALUES
(1, 'corticothérapie'),
(2, 'immunosuppresseur'),
(3, 'anti_infectieux'),
(4, 'biothérapie');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `First_name` varchar(255) NOT NULL,
  `Last_name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Mobile` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` varchar(255) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `First_name`, `Last_name`, `Email`, `Mobile`, `Username`, `Password`, `Role`) VALUES
(1, 'admin', 'admin', '', '', 'admin', 'admin@@123', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antecedents`
--
ALTER TABLE `antecedents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anti_infectieux`
--
ALTER TABLE `anti_infectieux`
  ADD PRIMARY KEY (`id`),
  ADD KEY `traitementId` (`traitementId`),
  ADD KEY `patientId` (`patientId`);

--
-- Indexes for table `av_adelphe`
--
ALTER TABLE `av_adelphe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `examenId` (`examenId`),
  ADD KEY `patientId` (`patientId`);

--
-- Indexes for table `av_atteint`
--
ALTER TABLE `av_atteint`
  ADD PRIMARY KEY (`id`),
  ADD KEY `examenId` (`examenId`),
  ADD KEY `patientId` (`patientId`);

--
-- Indexes for table `biothérapie`
--
ALTER TABLE `biothérapie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `traitementId` (`traitementId`),
  ADD KEY `patientId` (`patientId`);

--
-- Indexes for table `clinique`
--
ALTER TABLE `clinique`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consultations`
--
ALTER TABLE `consultations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patientId` (`patientId`);

--
-- Indexes for table `corticothérapie`
--
ALTER TABLE `corticothérapie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `traitementId` (`traitementId`),
  ADD KEY `patientId` (`patientId`);

--
-- Indexes for table `etiologie_retenue`
--
ALTER TABLE `etiologie_retenue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patientId` (`patientId`);

--
-- Indexes for table `evolutions`
--
ALTER TABLE `evolutions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patientId` (`patientId`);

--
-- Indexes for table `examen_ophtalmologique`
--
ALTER TABLE `examen_ophtalmologique`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `familiaux`
--
ALTER TABLE `familiaux`
  ADD PRIMARY KEY (`id`),
  ADD KEY `antecedentid` (`antecedentid`),
  ADD KEY `patientId` (`patientId`);

--
-- Indexes for table `immunosuppresseur`
--
ALTER TABLE `immunosuppresseur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `traitementId` (`traitementId`),
  ADD KEY `patientId` (`patientId`);

--
-- Indexes for table `investigations`
--
ALTER TABLE `investigations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investigations_biologique`
--
ALTER TABLE `investigations_biologique`
  ADD PRIMARY KEY (`id`),
  ADD KEY `investigationId` (`investigationId`),
  ADD KEY `patientId` (`patientId`);

--
-- Indexes for table `investigations_etiologique`
--
ALTER TABLE `investigations_etiologique`
  ADD PRIMARY KEY (`id`),
  ADD KEY `investigationId` (`investigationId`),
  ADD KEY `patientId` (`patientId`);

--
-- Indexes for table `investigations_radiologiques`
--
ALTER TABLE `investigations_radiologiques`
  ADD PRIMARY KEY (`id`),
  ADD KEY `investigationId` (`investigationId`),
  ADD KEY `patientId` (`patientId`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `personnels`
--
ALTER TABLE `personnels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `antecedentid` (`antecedentid`),
  ADD KEY `patientId` (`patientId`);

--
-- Indexes for table `signes_dappel_extra_oculaires`
--
ALTER TABLE `signes_dappel_extra_oculaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliniqueId` (`cliniqueId`),
  ADD KEY `patientId` (`patientId`);

--
-- Indexes for table `signes_dappel_oculaires`
--
ALTER TABLE `signes_dappel_oculaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliniqueId` (`cliniqueId`),
  ADD KEY `patientId` (`patientId`);

--
-- Indexes for table `toxiques`
--
ALTER TABLE `toxiques`
  ADD PRIMARY KEY (`id`),
  ADD KEY `antecedentId` (`antecedentId`),
  ADD KEY `patientId` (`patientId`);

--
-- Indexes for table `traitements`
--
ALTER TABLE `traitements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `UQ_username_column` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antecedents`
--
ALTER TABLE `antecedents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `anti_infectieux`
--
ALTER TABLE `anti_infectieux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `av_adelphe`
--
ALTER TABLE `av_adelphe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `av_atteint`
--
ALTER TABLE `av_atteint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `biothérapie`
--
ALTER TABLE `biothérapie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clinique`
--
ALTER TABLE `clinique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `consultations`
--
ALTER TABLE `consultations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `corticothérapie`
--
ALTER TABLE `corticothérapie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `etiologie_retenue`
--
ALTER TABLE `etiologie_retenue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `evolutions`
--
ALTER TABLE `evolutions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `examen_ophtalmologique`
--
ALTER TABLE `examen_ophtalmologique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `familiaux`
--
ALTER TABLE `familiaux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `immunosuppresseur`
--
ALTER TABLE `immunosuppresseur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investigations`
--
ALTER TABLE `investigations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `investigations_biologique`
--
ALTER TABLE `investigations_biologique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investigations_etiologique`
--
ALTER TABLE `investigations_etiologique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investigations_radiologiques`
--
ALTER TABLE `investigations_radiologiques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personnels`
--
ALTER TABLE `personnels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `signes_dappel_extra_oculaires`
--
ALTER TABLE `signes_dappel_extra_oculaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `signes_dappel_oculaires`
--
ALTER TABLE `signes_dappel_oculaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `toxiques`
--
ALTER TABLE `toxiques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `traitements`
--
ALTER TABLE `traitements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anti_infectieux`
--
ALTER TABLE `anti_infectieux`
  ADD CONSTRAINT `anti_infectieux_ibfk_1` FOREIGN KEY (`traitementId`) REFERENCES `traitements` (`id`),
  ADD CONSTRAINT `anti_infectieux_ibfk_2` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`);

--
-- Constraints for table `av_adelphe`
--
ALTER TABLE `av_adelphe`
  ADD CONSTRAINT `av_adelphe_ibfk_1` FOREIGN KEY (`examenId`) REFERENCES `examen_ophtalmologique` (`id`),
  ADD CONSTRAINT `av_adelphe_ibfk_2` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`);

--
-- Constraints for table `av_atteint`
--
ALTER TABLE `av_atteint`
  ADD CONSTRAINT `av_atteint_ibfk_1` FOREIGN KEY (`examenId`) REFERENCES `examen_ophtalmologique` (`id`),
  ADD CONSTRAINT `av_atteint_ibfk_2` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`);

--
-- Constraints for table `biothérapie`
--
ALTER TABLE `biothérapie`
  ADD CONSTRAINT `biothérapie_ibfk_1` FOREIGN KEY (`traitementId`) REFERENCES `traitements` (`id`),
  ADD CONSTRAINT `biothérapie_ibfk_2` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`);

--
-- Constraints for table `consultations`
--
ALTER TABLE `consultations`
  ADD CONSTRAINT `consultations_ibfk_1` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`);

--
-- Constraints for table `corticothérapie`
--
ALTER TABLE `corticothérapie`
  ADD CONSTRAINT `corticothérapie_ibfk_1` FOREIGN KEY (`traitementId`) REFERENCES `traitements` (`id`),
  ADD CONSTRAINT `corticothérapie_ibfk_2` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`);

--
-- Constraints for table `etiologie_retenue`
--
ALTER TABLE `etiologie_retenue`
  ADD CONSTRAINT `etiologie_retenue_ibfk_1` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`);

--
-- Constraints for table `evolutions`
--
ALTER TABLE `evolutions`
  ADD CONSTRAINT `evolutions_ibfk_1` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`);

--
-- Constraints for table `familiaux`
--
ALTER TABLE `familiaux`
  ADD CONSTRAINT `familiaux_ibfk_1` FOREIGN KEY (`antecedentid`) REFERENCES `antecedents` (`id`),
  ADD CONSTRAINT `familiaux_ibfk_2` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`);

--
-- Constraints for table `immunosuppresseur`
--
ALTER TABLE `immunosuppresseur`
  ADD CONSTRAINT `immunosuppresseur_ibfk_1` FOREIGN KEY (`traitementId`) REFERENCES `traitements` (`id`),
  ADD CONSTRAINT `immunosuppresseur_ibfk_2` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`);

--
-- Constraints for table `investigations_biologique`
--
ALTER TABLE `investigations_biologique`
  ADD CONSTRAINT `investigations_biologique_ibfk_1` FOREIGN KEY (`investigationId`) REFERENCES `investigations` (`id`),
  ADD CONSTRAINT `investigations_biologique_ibfk_2` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`);

--
-- Constraints for table `investigations_etiologique`
--
ALTER TABLE `investigations_etiologique`
  ADD CONSTRAINT `investigations_etiologique_ibfk_1` FOREIGN KEY (`investigationId`) REFERENCES `investigations` (`id`),
  ADD CONSTRAINT `investigations_etiologique_ibfk_2` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`);

--
-- Constraints for table `investigations_radiologiques`
--
ALTER TABLE `investigations_radiologiques`
  ADD CONSTRAINT `investigations_radiologiques_ibfk_1` FOREIGN KEY (`investigationId`) REFERENCES `investigations` (`id`),
  ADD CONSTRAINT `investigations_radiologiques_ibfk_2` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`);

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id`);

--
-- Constraints for table `personnels`
--
ALTER TABLE `personnels`
  ADD CONSTRAINT `personnels_ibfk_1` FOREIGN KEY (`antecedentid`) REFERENCES `antecedents` (`id`),
  ADD CONSTRAINT `personnels_ibfk_2` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`);

--
-- Constraints for table `signes_dappel_extra_oculaires`
--
ALTER TABLE `signes_dappel_extra_oculaires`
  ADD CONSTRAINT `signes_dappel_extra_oculaires_ibfk_1` FOREIGN KEY (`cliniqueId`) REFERENCES `clinique` (`id`),
  ADD CONSTRAINT `signes_dappel_extra_oculaires_ibfk_2` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`);

--
-- Constraints for table `signes_dappel_oculaires`
--
ALTER TABLE `signes_dappel_oculaires`
  ADD CONSTRAINT `signes_dappel_oculaires_ibfk_1` FOREIGN KEY (`cliniqueId`) REFERENCES `clinique` (`id`),
  ADD CONSTRAINT `signes_dappel_oculaires_ibfk_2` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`);

--
-- Constraints for table `toxiques`
--
ALTER TABLE `toxiques`
  ADD CONSTRAINT `toxiques_ibfk_1` FOREIGN KEY (`antecedentId`) REFERENCES `antecedents` (`id`),
  ADD CONSTRAINT `toxiques_ibfk_2` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
