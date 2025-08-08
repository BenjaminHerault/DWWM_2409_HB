
-- Pour supprimer la base de donner si elle existe 
DROP DATABASE IF EXISTS agence_interim;

-- Pour crée la base de donner si elle existe pas 
CREATE DATABASE IF NOT EXISTS agence_interim;

-- Pour utiliser la base de donner
USE agence_interim;

CREATE TABLE IF NOT EXISTS `institutions` (
  `identifiant` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom_resp` varchar(100) DEFAULT NULL,
  `nom_etab` varchar(100) NOT NULL,
  `type_etab` varchar(100) NOT NULL,
  `nom_tut` varchar(100) DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `cp` int(5) unsigned DEFAULT NULL,
  `ville` varchar(60) DEFAULT NULL,
  `depart` int(5) unsigned DEFAULT NULL,
  `Telephone` varchar(20) NOT NULL,
  `Fax` varchar(20) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `service` varchar(100) DEFAULT NULL,
  `desc` text,
  `mobile` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`identifiant`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;

--
-- Contenu de la table `institutions`
--
INSERT INTO `institutions` (
  `nom_resp`, `nom_etab`, `type_etab`, `nom_tut`, `adresse`, `cp`, `ville`,
  `depart`, `Telephone`, `Fax`, `email`, `service`, `desc`, `mobile`
) VALUES
-- TPE
('Mme Lopez', 'DigitStyle', 'TPE', 'CCI Lyon', '22 rue Victor Hugo', 69002, 'Lyon', 69, '0478890011', NULL, 'contact@digitstyle.fr', 'Web Design', 'Micro-entreprise spécialisée en création de sites web.', '0687001122'),
('M. Petit', 'Atelier Bois & Création', 'TPE', 'Chambre des Métiers', '5 rue des Artisans', 25000, 'Besançon', 25, '0381304567', NULL, 'atelier.bois@cm-besancon.fr', 'Menuiserie', 'Atelier artisanal bois sur mesure.', '0677563499'),

-- PME
('Mme Dubois', 'CleanAir Services', 'PME', 'Région Île-de-France', '3 rue de l’Écologie', 93100, 'Montreuil', 93, '0148992311', NULL, 'info@cleanair-idf.fr', 'Maintenance', 'PME spécialisée en purification d’air en milieu industriel.', '0668123490'),
('M. Lefranc', 'Bretagne Nutrition', 'PME', 'Chambre d’Agriculture', '10 impasse des vergers', 29000, 'Quimper', 29, '0298991010', NULL, 'contact@bret-nutrition.fr', 'Nutrition animale', 'Entreprise agroalimentaire régionale.', '0677022233'),

-- GRANDE ENTREPRISE
('Mme Cazeneuve', 'Orange SA', 'GRANDE ENTREPRISE', 'Groupe Orange', '78 rue Olivier de Serres', 75015, 'Paris', 75, '0144567890', '0144567891', 'orange@orange.fr', 'Direction Commerciale', 'Opérateur télécom international.', '0678009987'),
('M. Renault', 'Airbus Industries', 'GRANDE ENTREPRISE', 'Groupe Airbus', 'Aéroport Blagnac', 31700, 'Blagnac', 31, '0561712233', '0561712244', 'contact@airbus.com', 'Ingénierie aéronautique', 'Constructeur aéronautique mondial.', '0688120099'),

-- COLLECTIVITE TER
('Mme Garnier', 'TER Bourgogne-Franche-Comté', 'COLLECTIVITE TER', 'Conseil Régional BFC', '12 avenue du Général Leclerc', 21000, 'Dijon', 21, '0380302233', '0380302244', 'contact@ter-bfc.fr', 'Transport régional', 'Gestion des lignes TER régionales.', '0678342290'),
('M. Bertrand', 'TER Occitanie', 'COLLECTIVITE TER', 'Conseil Régional Occitanie', 'Rue du Colonel Fabien', 31000, 'Toulouse', 31, '0561234567', NULL, 'info@ter-occitanie.fr', 'Services voyageurs', 'Réseau TER régional et intermodalité.', '0688321199'),

-- ASSOCIATION
('Mme Colin', 'Les Petits Explorateurs', 'ASSOCIATION', 'Fédération Éducative', '11 rue des Marronniers', 64000, 'Pau', 64, '0559801123', NULL, 'explorateurs@asso.fr', 'Périscolaire', 'Association d’activités éducatives pour enfants.', '0667893044'),
('M. Tellier', 'Ensemble Chorale 94', 'ASSOCIATION', 'Union des Chorales', 'Centre culturel Diderot', 94000, 'Créteil', 94, '0143012299', NULL, 'contact@chorale94.fr', 'Musique', 'Chorale associative adultes & jeunes.', '0677490011'),

-- AUTRES (secteur public)
('Mme Blin', 'Archives Départementales', 'AUTRES (secteur public)', 'Département du Loiret', 'Rue des Archives', 45000, 'Orléans', 45, '0238381122', NULL, 'archives@loiret.fr', 'Conservation patrimoine', 'Service public de conservation historique.', '0667480090'),
('M. Duriez', 'Police Municipale Béziers', 'AUTRES (secteur public)', 'Ville de Béziers', 'Place de la République', 34500, 'Béziers', 34, '0467301123', NULL, 'pm@beziers.fr', 'Sécurité publique', 'Service municipal de sécurité.', '0677449988');



-- Structure de la table `departements`
--

CREATE TABLE `departements` (
  `id_dep` int(10) UNSIGNED NOT NULL,
  `Name` varchar(50) NOT NULL,
  `dep_actif` int(10) UNSIGNED NOT NULL,
  `dep_taux` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Departements';

--
-- chargement des données de la table `departements`
--

INSERT INTO `departements` (`id_dep`, `Name`, `dep_actif`, `dep_taux`) VALUES
(1, '01 - Ain', 1, 1.00),
(2, '02 - Aisne', 1, 1.00),
(3, '03 - Allier', 1, 1.00),
(4, '04 - Alpes-de-Haute-Provence', 1, 1.00),
(5, '05 - Hautes-Alpes', 1, 1.00),
(6, '06 - Alpes-Maritimes', 1, 1.00),
(7, '07 - Ardèche', 1, 1.00),
(8, '08 - Ardennes', 1, 1.00),
(9, '09 Ariège', 1, 1.00),
(10, '10 - Aube', 1, 1.00),
(11, '11 - Aude', 1, 1.00),
(12, '12 - Aveyron', 1, 1.00),
(13, '13 - Bouches-du-Rhône', 1, 1.00),
(14, '14 - Calvados', 1, 1.00),
(15, '15 - Cantal', 1, 1.00),
(16, '16 - Charente', 1, 1.00),
(17, '17 - Charente-Maritime', 1, 1.00),
(18, '18 - Cher', 1, 1.00),
(19, '19 - Corrèze', 1, 1.00),
(20, '2A 2B - Départements Corse', 1, 1.00),
(21, '21 - Côte-d Or', 1, 1.00),
(22, '22 - Côtes-d Armor', 1, 1.00),
(23, '23 - Creuse', 1, 1.00),
(24, '24 - Dordogne', 1, 1.00),
(25, '25 - Doubs', 1, 1.00),
(26, '26 - Drôme', 1, 1.00),
(27, '27 - Eure', 1, 1.00),
(28, '28 - Eure-et-Loir', 1, 1.00),
(29, '29 - Finistère', 1, 1.00),
(30, '30 - Gard', 1, 1.00),
(31, '31 - Haute-Garonne', 1, 1.00),
(32, '32 - Gers', 1, 1.00),
(33, '33 - Gironde', 1, 1.00),
(34, '34 - Hérault', 1, 1.00),
(35, '35 - Ille-et-Vilaine', 1, 1.00),
(36, '36 - Indre', 1, 1.00),
(37, '37 - Indre-et-Loire', 1, 1.00),
(38, '38 - Isère', 1, 1.00),
(39, '39 - Jura', 1, 1.00),
(40, '40 - Landes', 1, 1.00),
(41, '41 - Loir-et-Cher', 1, 1.00),
(42, '42 - Loire', 1, 1.00),
(43, '43 - Haute-Loire', 1, 1.00),
(44, '44 - Loire-Atlantique', 1, 1.00),
(45, '45 - Loiret', 1, 1.00),
(46, '46 - Lot', 1, 1.00),
(47, '47 - Lot-et-Garonne', 1, 1.00),
(48, '48 - Lozère', 1, 1.00),
(49, '49 - Maine-et-Loire', 1, 1.00),
(50, '50 - Manche', 1, 1.00),
(51, '51 - Marne', 1, 1.00),
(52, '52 - Haute-Marne', 1, 1.00),
(53, '53 - Mayenne', 1, 1.00),
(54, '54 - Meurthe-et-Moselle', 1, 1.00),
(55, '55 - Meuse', 1, 1.00),
(56, '56 - Morbihan', 1, 1.00),
(57, '57 - Moselle', 1, 1.00),
(58, '58 - Nièvre', 1, 1.00),
(59, '59 - Nord', 1, 1.00),
(60, '60 - Oise', 1, 1.00),
(61, '61 - Orne', 1, 1.00),
(62, '62 - Pas-de-Calais', 1, 1.00),
(63, '63 - Puy-de-Dôme', 1, 1.00),
(64, '64 - Pyrénées-Atlantiques', 1, 1.00),
(65, '65 - Hautes-Pyrénées', 1, 1.00),
(66, '66 - Pyrénées-Orientales', 1, 1.00),
(67, '67 - Bas-Rhin', 1, 1.00),
(68, '68 - Haut-Rhin', 1, 1.00),
(69, '69 - Rhône', 1, 1.00),
(70, '70 - Haute-Saône', 1, 1.00),
(71, '71 - Saône-et-Loire', 1, 1.00),
(72, '72 - Sarthe', 1, 1.00),
(73, '73 - Savoie', 1, 1.00),
(74, '74 - Haute-Savoie', 1, 1.00),
(75, '75 - Paris', 1, 1.00),
(76, '76 - Seine-Maritime', 1, 1.00),
(77, '77 - Seine-et-Marne', 1, 1.00),
(78, '78 - Yvelines', 1, 1.00),
(79, '79 - Deux-Sèvres', 1, 1.00),
(80, '80 - Somme', 1, 1.00),
(81, '81 - Tarn', 1, 1.00),
(82, '82 - Tarn-et-Garonne', 1, 1.00),
(83, '83 - Var', 1, 1.00),
(84, '84 - Vaucluse', 1, 1.00),
(85, '85 - Vendée', 1, 1.00),
(86, '86 - Vienne', 1, 1.00),
(87, '87 - Haute-Vienne', 1, 1.00),
(88, '88 - Vosges', 1, 1.00),
(89, '89 - Yonne', 1, 1.00),
(90, '90 - Territoire de Belfort', 1, 1.00),
(91, '91 - Essonne', 1, 1.00),
(92, '92 - Hauts-de-Seine', 1, 1.00),
(93, '93 - Seine-Saint-Denis', 1, 1.00),
(94, '94 - Val-de-Marne', 1, 1.00),
(95, '95 - Val-dOise', 1, 1.00);

--

--

--
-- Index pour la table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id_dep`);
