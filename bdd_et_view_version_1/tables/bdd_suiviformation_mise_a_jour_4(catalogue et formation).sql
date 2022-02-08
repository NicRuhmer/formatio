CREATE TABLE domaines (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nom_domaine varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO domaines (id, nom_domaine, created_at, updated_at) VALUES
(1, 'Bureautique', '2021-11-16 10:22:43', '2021-11-16 10:22:43'),
(2, 'Développement Personnel', '2021-11-16 10:22:43', '2021-11-16 10:22:43'),
(3, 'Management', '2021-11-16 10:22:43', '2021-11-16 10:22:43'),
(4, 'Projet', '2021-11-16 10:22:43', '2021-11-16 10:22:43'),
(5, 'Ressources Humaines', '2021-11-16 10:22:43', '2021-11-16 10:22:43'),
(6, 'Communication - WebMarketing', '2021-11-16 10:22:43', '2021-11-16 10:22:43');

CREATE TABLE formations (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nom_formation varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  domaine_id int(11) NOT NULL REFERENCES domaines(id) ON DELETE CASCADE,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  status boolean not null default true
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO formations (id, nom_formation, domaine_id, created_at, updated_at) VALUES
(1, 'MS Excel', 1, NULL, NULL),
(2, 'Ms Power BI', 1, NULL, NULL),
(5, 'Autres logiciels', 1, '2021-11-17 04:00:01', '2021-11-17 04:00:01'),
(6, 'Affirmation de soi et changement', 2, '2021-11-17 04:00:27', '2021-11-17 04:00:27'),
(7, 'Gestion du stress et des émotions', 2, '2021-11-17 04:00:41', '2021-11-17 04:00:41'),
(8, 'Leadership', 2, '2021-11-17 04:06:54', '2021-11-17 04:06:54'),
(9, "Management d'équipe", 3, '2021-11-17 04:07:18', '2021-11-17 04:07:18'),
(10, 'Leadership, changement, gestion des conflits', 3, '2021-11-17 04:07:28', '2021-11-17 04:07:28'),
(11, 'Gestion de projet', 4, '2021-11-17 04:07:45', '2021-11-17 04:07:45'),
(12, 'Management de projet', 4, '2021-11-17 04:07:55', '2021-11-17 04:07:55'),
(13, 'Paie', 5, '2021-11-17 04:08:21', '2021-11-17 04:08:21'),
(14, 'Droit social', 5, '2021-11-17 04:08:31', '2021-11-17 04:08:31'),
(15, 'Webmarketing', 6, '2021-11-17 04:08:53', '2021-11-17 04:08:53'),
(16, 'PAO et Multimédia', 6, '2021-11-17 04:09:04', '2021-11-17 04:09:04');


CREATE TABLE modules (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  reference varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  nom_module varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  formation_id bigint(20) UNSIGNED NOT NULL REFERENCES formations(id) ON DELETE CASCADE,
  cfp_id bigint(20) NOT NULL REFERENCES cfps(id) ON DELETE CASCADE,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  prix int(11) NOT NULL,
  duree int(11) NOT NULL,
  duree_jour int(11) NOT NULL,
  prerequis TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
  objectif TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
  modalite_formation varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  description TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
  niveau_id bigint(20) NOT NULL REFERENCES niveaux(id) ON DELETE CASCADE,
  materiel_necessaire varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  cible varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  min int(11) NOT NULL,
  max int(11) NOT NULL,
  bon_a_savoir TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
  prestation TEXT COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO modules (id, reference, nom_module, formation_id, created_at, updated_at, prix, duree,duree_jour,prerequis, objectif, modalite_formation, description ,niveau_id,materiel_necessaire,cible,min,max,bon_a_savoir,prestation,cfp_id) VALUES
(2, 'MOD_EX02', 'NII.Calculs et Fonctions', 1, NULL, NULL, 300000, 12,4, '', '', '','',1,'pc','RH',0,0,'','',1),
(3, 'MOD_EX03', 'NIII.Organisation et gestion des données', 1, NULL, NULL, 300000, 12, 4,'', '', '','',1,'pc','RH',0,0,'','',1),
(4, 'MOD_EX04', 'NIV.Business Intelligence', 1, NULL, NULL, 350000, 12, 4,'', '', '','',1,'pc','RH',0,0,'','',1),
(5, 'MOD_EX05', 'NV.VBA', 1, NULL, NULL, 450000, 18,4,'', '', '','',1,'pc','RH',0,0,'','',1),
(6, 'MOD_BI01', 'NI.Fondamentaux', 2, NULL, '2021-08-31 09:07:56', 450000, 18,5, '', '', '','',1,'pc','RH',0,0,'','',1),
(7, 'MOD_BI02', 'NII.Perfectionnement Dax', 2, NULL, NULL, 450000, 18,5, '', '', '','',1,'pc','RH',0,0,'','',1),
(8, 'MOD_BI03', 'NIII.Dataviz et analytics', 2, NULL, NULL, 450000, 18,5, '', '', '','',1,'pc','RH',0,0,'','',1),
(9, 'MOD_EX01', 'NI.Fondamentaux', 1, '2021-09-01 03:25:44', '2021-09-01 03:25:44', 300000, 12,4, '', '', '','',1,'pc','RH',0,0,'','',1);


CREATE TABLE programmes (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  titre varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  module_id bigint(20) UNSIGNED NOT NULL REFERENCES modules(id) ON DELETE CASCADE,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE cours (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  titre_cours varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  programme_id bigint(20) UNSIGNED NOT NULL REFERENCES programmes(id) ON DELETE CASCADE,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO programmes (id, titre, module_id, created_at, updated_at) VALUES
(3, 'Reference', 9, NULL, NULL),
(4, 'Operateur', 9, NULL, NULL),
(5, 'Valeurs', 9, NULL, NULL),
(7, 'Fonctions ', 9, NULL, NULL),
(9, 'Date et heure', 9, NULL, NULL),
(18, 'Validation des donnees', 3, NULL, NULL),
(19, 'Mise en forme conditionnelle', 3, NULL, NULL),
(20, 'Tri et filtre', 3, NULL, NULL),
(23, 'Tableau croise dynamique', 3, NULL, NULL),
(24, 'Graphique', 3, NULL, NULL),
(32, 'Variables', 5, NULL, NULL),
(33, 'Procedures', 5, NULL, NULL),
(34, 'Fonctions', 5, NULL, NULL),
(41, 'Enregistreur macro', 5, NULL, NULL),
(42, 'Boucle', 5, NULL, NULL),
(43, 'Conditions', 5, NULL, NULL),
(44, 'Feuille cellule', 5, NULL, NULL),
(45, 'Boites de dialogue', 5, NULL, NULL),
(46, 'Evenements', 5, NULL, NULL),
(47, 'Formulaire', 5, NULL, NULL),
(48, 'Extraction via une source de donnees', 6, NULL, NULL),
(49, 'Transformation de données ', 6, NULL, NULL),
(50, 'Ajout de colonne', 6, NULL, NULL),
(51, 'Data cleansing', 6, NULL, NULL),
(52, 'Database structure', 6, NULL, NULL),
(53, 'combinaison de requetes', 6, NULL, NULL),
(54, 'Optimisation de traitement de donnees', 6, NULL, NULL),
(55, 'Language M', 6, NULL, NULL),
(56, 'Modelisation de donnees ', 6, NULL, NULL),
(57, 'Notion de table', 6, NULL, NULL),
(58, 'Notion de cle', 6, NULL, NULL),
(59, 'Colonne calculee', 6, NULL, NULL),
(60, 'Mesure', 6, NULL, NULL),
(61, 'Fonctions logiques', 7, NULL, NULL),
(62, 'Fonction agregateur', 7, NULL, NULL),
(63, 'Fonctions statistiques', 7, NULL, NULL),
(64, 'Fonctions iteratives', 7, NULL, NULL),
(65, 'Notion de filtre', 8, NULL, NULL),
(66, 'Interaction des visuels', 8, NULL, NULL),
(67, 'Mise en forme Conditionnelle', 8, NULL, NULL),
(68, 'Tableau', 8, NULL, NULL),
(69, 'Filtre', 8, NULL, NULL),
(70, 'Comparaison', 8, NULL, NULL),
(71, 'Synthèse', 8, NULL, NULL),
(72, 'Visuel d\'indicateur', 8, NULL, NULL),
(73, 'Analyse en fonction de temps', 8, NULL, NULL),
(74, 'Visuel a valeur unique', 8, NULL, NULL),
(75, 'Cartes', 8, NULL, NULL),
(76, 'Test Logique', 2, NULL, NULL),
(77, 'Condition', 2, NULL, NULL),
(78, 'Recupération', 2, NULL, NULL),
(79, 'Segment', 3, NULL, NULL),
(80, 'Extraction de données', 4, NULL, NULL),
(81, 'Transformation de base', 4, NULL, NULL),
(82, 'Combinaison de requêtes', 4, NULL, NULL),
(83, 'Structuration de données', 4, NULL, NULL),
(84, 'AJOUT COLONNE', 4, '2021-10-20 05:36:51', '2021-10-20 05:36:51'),
(88, 'Segment', 3, NULL, NULL),
(89, 'Organisation de données', 4, NULL, NULL),
(90, 'Initiation Dataviz', 6, NULL, NULL),
(91, 'Fonctions filtres', 7, NULL, NULL),
(92, 'Time intelligence', 7, NULL, NULL),
(93, 'Date,time', 7, NULL, NULL),
(94, 'Visuels intelligent', 8, NULL, NULL),
(95, 'Info bulle', 8, NULL, NULL),
(96, 'Insertion d\'objet', 8, NULL, NULL),
(97, 'Format', 8, NULL, NULL),
(98, 'Analytique', 8, NULL, NULL),
(99, 'Fonctions textes', 7, NULL, NULL);



INSERT INTO cours (id, titre_cours, programme_id, created_at, updated_at) VALUES
(8, '$', 3, '2021-10-18 09:55:04', '2021-10-18 09:55:04'),
(12, 'Référence nommée', 3, '2021-10-18 10:56:11', '2021-10-18 10:56:11'),
(15, 'Mathématique', 4, '2021-10-19 03:45:41', '2021-10-19 03:45:41'),
(16, 'Comparaison', 4, '2021-10-19 03:45:51', '2021-10-19 03:45:51'),
(17, 'Concaténation', 4, '2021-10-19 03:45:59', '2021-10-19 03:45:59'),
(18, 'Référence', 4, '2021-10-19 03:46:08', '2021-10-19 03:46:08'),
(19, 'Erreur', 5, '2021-10-19 03:46:27', '2021-10-19 03:46:27'),
(20, 'Vide', 5, '2021-10-19 03:46:35', '2021-10-19 03:46:35'),
(21, 'Logique', 5, '2021-10-19 03:46:47', '2021-10-19 03:46:47'),
(22, 'Texte', 5, '2021-10-19 03:46:56', '2021-10-19 03:46:56'),
(23, 'Numérique', 5, '2021-10-19 03:47:06', '2021-10-19 03:47:06'),
(24, 'Syntaxe', 7, '2021-10-19 03:47:31', '2021-10-19 03:47:31'),
(25, 'Fonctions de bases', 7, '2021-10-19 03:47:40', '2021-10-19 03:47:40'),
(26, 'SI() simple', 7, '2021-10-19 03:47:49', '2021-10-19 03:47:49'),
(27, 'Format', 9, '2021-10-19 03:48:05', '2021-10-19 03:48:05'),
(28, 'Diverses fonctions', 9, '2021-10-19 03:48:13', '2021-10-19 03:48:13'),
(29, 'Comparaison', 76, '2021-10-19 03:49:50', '2021-10-19 03:49:50'),
(30, 'Diverses fonctions logiques', 76, '2021-10-19 03:49:58', '2021-10-19 03:49:58'),
(31, 'SI() imbriquée', 77, '2021-10-19 03:50:12', '2021-10-19 03:50:12'),
(32, 'NB.SI() / NB.SI.ENS()', 77, '2021-10-19 03:50:21', '2021-10-19 03:50:21'),
(33, 'SOMME.SI() / SOMME.SI.ENS()', 77, '2021-10-19 03:50:30', '2021-10-19 03:50:30'),
(34, 'RECHERCHEV()', 78, '2021-10-19 03:50:46', '2021-10-19 03:50:46'),
(35, 'RECHERCHEH()', 78, '2021-10-19 03:50:56', '2021-10-19 03:50:56'),
(36, 'INDEX() et EQUIV()', 78, '2021-10-19 03:51:04', '2021-10-19 03:51:04'),
(37, 'Validation de données', 18, '2021-10-19 03:51:26', '2021-10-19 03:51:26'),
(38, 'Tri simple et avancé', 20, '2021-10-19 03:51:41', '2021-10-19 03:51:41'),
(39, 'Filtre simple et avancé', 20, '2021-10-19 03:51:50', '2021-10-19 03:51:50'),
(40, 'Mise en forme conditionnelle prédéfinie', 19, '2021-10-19 03:52:02', '2021-10-19 03:52:02'),
(41, 'Création de propre règle', 19, '2021-10-19 03:52:11', '2021-10-19 03:52:11'),
(42, 'Base TCD', 23, '2021-10-19 03:52:33', '2021-10-19 03:52:33'),
(43, 'Divers TCD', 23, '2021-10-19 03:52:42', '2021-10-19 03:52:42'),
(44, 'Base Graphique', 24, '2021-10-19 03:52:53', '2021-10-19 03:52:53'),
(46, 'Divers Graphiques', 24, '2021-10-19 03:53:09', '2021-10-19 03:53:09'),
(47, 'Graphiques personnalisés', 24, '2021-10-19 03:53:21', '2021-10-19 03:53:21'),
(48, 'Connexion de liaison', 79, '2021-10-19 03:53:35', '2021-10-19 03:53:35'),
(49, 'Excel', 80, '2021-10-19 03:53:59', '2021-10-19 03:53:59'),
(50, 'Texte', 80, '2021-10-19 03:54:07', '2021-10-19 03:54:07'),
(51, 'CSV', 80, '2021-10-19 03:54:15', '2021-10-19 03:54:15'),
(52, 'Base de données', 80, '2021-10-19 03:54:22', '2021-10-19 03:54:22'),
(53, 'Web', 80, '2021-10-19 03:54:31', '2021-10-19 03:54:31'),
(54, 'Dossier', 80, '2021-10-19 03:54:40', '2021-10-19 03:54:40'),
(55, 'Fraction', 81, '2021-10-19 03:54:53', '2021-10-19 03:54:53'),
(56, 'Fusion', 81, '2021-10-19 03:55:01', '2021-10-19 03:55:01'),
(57, 'Reduction des lignes', 81, '2021-10-19 03:55:09', '2021-10-19 03:55:09'),
(58, 'Gérer les colonnes', 81, '2021-10-19 03:55:18', '2021-10-19 03:55:18'),
(59, 'En tête promus', 81, '2021-10-19 03:55:25', '2021-10-19 03:55:25'),
(60, 'Nettoyage', 81, '2021-10-19 03:55:33', '2021-10-19 03:55:33'),
(61, 'Typage', 81, '2021-10-19 03:55:40', '2021-10-19 03:55:40'),
(62, 'Filtre', 81, '2021-10-19 03:55:49', '2021-10-19 03:55:49'),
(63, 'Ajouter des requêtes', 82, '2021-10-19 03:56:02', '2021-10-19 03:56:02'),
(64, 'Fusionner des requêtes', 82, '2021-10-19 03:56:11', '2021-10-19 03:56:11'),
(65, 'Combiner des fichiers', 82, '2021-10-19 03:56:21', '2021-10-19 03:56:21'),
(66, 'Pivoter', 83, '2021-10-19 03:56:33', '2021-10-19 03:56:33'),
(67, 'Dépivoter', 83, '2021-10-19 03:56:43', '2021-10-19 03:56:43'),
(68, 'Transposer', 83, '2021-10-19 03:56:50', '2021-10-19 03:56:50'),
(69, 'Remplissage', 83, '2021-10-19 03:56:58', '2021-10-19 03:56:58'),
(70, 'TXT', 80, NULL, NULL),
(71, 'Extraction', 81, NULL, NULL),
(72, 'Ajout colonne d\'exemple', 50, NULL, NULL),
(73, 'Ajout colonne conditionnelle', 50, NULL, NULL),
(74, 'Ajout colonne conditionnelle', 50, NULL, NULL),
(75, 'Ajout colonne d\'index', 50, NULL, NULL),
(76, 'Ajout colonne personalisé', 50, NULL, NULL),
(77, 'IF', 61, NULL, NULL),
(78, 'Switch', 61, NULL, NULL),
(79, 'OR', 61, NULL, NULL),
(80, 'AND', 61, NULL, NULL),
(81, 'SUM', 62, NULL, NULL),
(82, 'MIN', 62, NULL, NULL),
(83, 'MAX', 62, NULL, NULL),
(84, 'AVERAGE', 62, NULL, NULL),
(85, 'COUNT', 63, NULL, NULL),
(86, 'COUNTBLANK', 63, NULL, NULL),
(87, 'COUNTROWS', 63, NULL, NULL),
(88, 'DISTINCTCOUNT', 63, NULL, NULL),
(89, 'SUMX', 64, NULL, NULL),
(90, 'AVERAGEX', 64, NULL, NULL),
(91, 'MAXX', 64, NULL, NULL),
(92, 'MINX', 64, NULL, NULL),
(93, 'FIND', 99, NULL, NULL),
(94, 'LEFT', 99, NULL, NULL),
(95, 'CONCATENATE', 99, NULL, NULL),
(96, 'SEARCH', 99, NULL, NULL),
(97, 'LEN', 99, NULL, NULL),
(98, 'FORMAT', 99, NULL, NULL),
(99, 'CALCULATE', 91, NULL, NULL),
(100, 'ALL', 91, NULL, NULL),
(101, 'DISTINCT', 91, NULL, NULL),
(102, 'FILTER', 91, NULL, NULL),
(103, 'ALLSELECTED', 91, NULL, NULL),
(104, 'ALLEXCEPT', 91, NULL, NULL),
(105, 'DATEADD', 92, NULL, NULL),
(106, 'DATEYTD', 92, NULL, NULL),
(107, 'DATEMTD', 92, NULL, NULL),
(108, 'DATEQTD', 92, NULL, NULL),
(109, 'DATEDIFF', 92, NULL, NULL),
(110, 'TOTALMTD', 92, NULL, NULL),
(111, 'TOTALYTD', 92, NULL, NULL),
(112, 'PREVIOUSMONTH', 92, NULL, NULL),
(113, 'PREVIOUSQUARTER', 92, NULL, NULL),
(114, 'PREVIOUSDAY', 92, NULL, NULL),
(115, 'CALENDAR', 93, NULL, NULL),
(116, 'YEAR', 93, NULL, NULL),
(117, 'MONTH', 93, NULL, NULL),
(118, 'DAY', 93, NULL, NULL),
(119, 'QUARTER', 93, NULL, NULL),
(120, 'WEEKDAY', 93, NULL, NULL),
(121, 'WEEKNUM', 93, NULL, NULL),
(122, 'HOUR', 93, NULL, NULL),
(123, 'MINUTE', 93, NULL, NULL),
(124, 'SECOND', 93, NULL, NULL),
(125, 'Filtre sur le visuel', 65, NULL, NULL),
(126, 'Filtre sur le rapport', 65, NULL, NULL),
(127, 'Filtre sur les pages', 65, NULL, NULL),
(128, 'Modifier interactions', 66, NULL, NULL),
(129, 'Couleur arrière-plan', 67, NULL, NULL),
(130, 'Couleur police', 67, NULL, NULL),
(131, 'Barres de données', 67, NULL, NULL),
(132, 'Icônes', 67, NULL, NULL),
(133, 'Tableau', 68, NULL, NULL),
(134, 'Matrice', 68, NULL, NULL),
(135, 'Segment', 69, NULL, NULL),
(136, 'Barre et Histogramme', 69, NULL, NULL),
(137, 'Secteur', 69, NULL, NULL),
(138, 'Anneau', 69, NULL, NULL),
(139, 'Treemap', 69, NULL, NULL),
(140, 'Graphiques combinés', 69, NULL, NULL),
(141, 'Entonnoir', 71, NULL, NULL),
(142, 'Cascade', 71, NULL, NULL),
(143, 'Jauge', 72, NULL, NULL);


