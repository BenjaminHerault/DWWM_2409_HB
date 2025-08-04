<?php

/**
 * FORMREPOSITORY.PHP - Classe pour gérer les opérations sur la table personnage
 * 
 * Cette classe contient toutes les méthodes pour manipuler les données
 * des personnages dans la base de données avec PDO
 */


// Inclusion du fichier de connexion à la base de données
require_once __DIR__ . '/Dbconnect.php';

/**
 * Classe FormRepository
 * 
 * Repository = Design Pattern qui centralise les accès aux données
 * Toutes les opérations CRUD (Create, Read, Update, Delete) sont ici
 */
class FormRepository
{
    /**
     * @var PDO $db Instance de connexion PDO à la base de données
     * Private = accessible seulement dans cette classe
     */
    private PDO $db;

    /**
     * CONSTRUCTEUR - Méthode appelée automatiquement à la création de l'objet
     * 
     * Initialise la connexion à la base de données via le Singleton
     * Singleton = Une seule instance de connexion pour toute l'application
     */
    public function __construct()
    {
        // Récupération de l'instance unique de connexion PDO
        $this->db = Dbconnexion::getInstance();
    }

    /**
     * READ - LIRE TOUS LES PERSONNAGES
     * 
     * Méthode pour récupérer tous les personnages de la base de données
     * 
     * @return array Tableau associatif contenant tous les personnages
     *               Chaque élément = un personnage avec ses propriétés
     */
    public function searchAll(): array
    {
        // Requête SQL pour sélectionner les champs voulus
        // Pas besoin de prepare() car aucun paramètre utilisateur
        $stmt = $this->db->query("SELECT id, nom, prenom, id_departement_naissance
                                        FROM personnage");

        // fetchAll() = récupère TOUS les résultats dans un tableau
        // PDO::FETCH_ASSOC par défaut = tableau associatif [colonne => valeur]
        return $stmt->fetchAll();
    }

    /**
     * CREATE - CRÉER UN NOUVEAU PERSONNAGE
     * 
     * Ajoute un nouveau personnage dans la base de données
     * 
     * @param string $nom Le nom du personnage
     * @param string $prenom Le prénom du personnage  
     * @param int $departement L'ID du département de naissance
     * @return bool True si ajout réussi, False sinon
     */
    public function createCandidate(
        string $nom,
        string $prenom,
        int $departement
    ): bool {
        // Requête SQL avec des placeholders (?) pour éviter l'injection SQL
        // Les ? seront remplacés par les valeurs lors de l'execution
        $sql = "INSERT INTO personnage (nom, prenom, id_departement_naissance)
                VALUES (?, ?, ?)";

        // prepare() = prépare la requête (sécurité anti-injection SQL)
        $stmt = $this->db->prepare($sql);

        // execute() = exécute avec les vraies valeurs dans l'ordre des ?
        // Retourne true si réussi, false si échec
        return $stmt->execute([$nom, $prenom, $departement]);
    }

    /**
     * UPDATE - MODIFIER UN PERSONNAGE EXISTANT
     * 
     * Met à jour les informations d'un personnage dans la base
     * 
     * @param int $id L'ID du personnage à modifier
     * @param string $nom Le nouveau nom
     * @param string $prenom Le nouveau prénom
     * @param int $departement Le nouvel ID de département
     * @return bool True si modification réussie, False sinon
     */
    public function updateCandidate(
        int $id,
        string $nom,
        string $prenom,
        int $departement
    ): bool {
        // Requête UPDATE avec WHERE pour cibler un personnage précis
        // SET = définit les nouvelles valeurs
        // WHERE = condition pour identifier quel enregistrement modifier
        $sql = "UPDATE personnage
                SET nom = ?, prenom = ?, id_departement_naissance = ?
                WHERE id = ?";

        // Préparation sécurisée de la requête
        $stmt = $this->db->prepare($sql);

        // Exécution avec les valeurs : ordre important !
        // Les 3 premiers ? = SET, le dernier ? = WHERE
        return $stmt->execute([$nom, $prenom, $departement, $id]);
    }

    /**
     * DELETE - SUPPRIMER UN PERSONNAGE
     * 
     * Supprime définitivement un personnage de la base de données
     * ⚠️ ATTENTION : Suppression définitive !
     * 
     * @param int $id L'ID du personnage à supprimer
     * @return bool True si suppression réussie, False sinon
     */
    public function deleltCandidate(int $id): bool
    {
        // Requête DELETE avec WHERE pour supprimer UN seul enregistrement
        // Sans WHERE, ça supprimerait TOUTE la table ! ⚠️
        $sql = "DELETE FROM personnage 
                WHERE id = ?";

        // Préparation et exécution sécurisées
        $stmt = $this->db->prepare($sql);

        // Une seule valeur à passer : l'ID du personnage à supprimer
        return $stmt->execute([$id]);
    }




    // ========================================
    // AJOUTS SIMPLES - Méthodes utiles
    // ========================================

    /**
     * RECHERCHE PAR ID - Récupère UN personnage précis
     * 
     * Trouve un personnage spécifique grâce à son ID unique
     * 
     * @param int $id L'ID du personnage recherché
     * @return array|null Le personnage trouvé, ou null si pas trouvé
     */
    public function getById(int $id): ?array
    {
        // SELECT * = sélectionne TOUTES les colonnes de la table
        // WHERE id = ? = trouve l'enregistrement avec cet ID précis
        $sql = "SELECT * FROM personnage WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        // fetch() = récupère UN SEUL résultat (pas fetchAll qui récupère tout)
        $result = $stmt->fetch();

        // Opérateur ternaire : si $result existe, le retourner, sinon retourner null
        // ?: = version courte de ? $result : null
        return $result ?: null;
    }

    /**
     * RECHERCHE PAR NOM - Recherche floue avec LIKE
     * 
     * Trouve tous les personnages dont le nom contient la chaîne recherchée
     * Ex: "Jean" trouvera "Jean", "Jean-Pierre", "Marie-Jean", etc.
     * 
     * @param string $nom Partie du nom à rechercher
     * @return array Tableau de tous les personnages trouvés
     */
    public function searchByName(string $nom): array
    {
        // LIKE = opérateur SQL pour recherche avec motifs
        // % = joker qui remplace n'importe quels caractères
        // %jean% = trouve "jean" n'importe où dans le texte
        $sql = "SELECT * FROM personnage WHERE nom LIKE ?";
        $stmt = $this->db->prepare($sql);

        // On entoure la recherche avec % pour chercher partout
        // '%' . $nom . '%' = ajoute % avant et après
        $stmt->execute(['%' . $nom . '%']);

        // fetchAll() car on peut avoir plusieurs résultats
        return $stmt->fetchAll();
    }

    /**
     * COMPTAGE - Nombre total de personnages
     * 
     * Compte combien de personnages sont dans la base de données
     * Utile pour afficher "5 personnages trouvés" par exemple
     * 
     * @return int Le nombre total de personnages
     */
    public function countAll(): int
    {
        // COUNT(*) = fonction SQL qui compte le nombre de lignes
        // Pas besoin de prepare() car pas de paramètres utilisateur
        $stmt = $this->db->query("SELECT COUNT(*) FROM personnage");

        // fetchColumn() = récupère seulement la première colonne du premier résultat
        // Plus simple que fetch() quand on veut juste une valeur
        // (int) = conversion en entier pour être sûr du type
        return (int)$stmt->fetchColumn();
    }

    /**
     * VÉRIFICATION D'EXISTENCE - Teste si un ID existe
     * 
     * Vérifie qu'un personnage avec cet ID existe dans la base
     * Pratique avant de faire un UPDATE ou DELETE
     * 
     * @param int $id L'ID à vérifier
     * @return bool True si existe, False sinon
     */
    public function exists(int $id): bool
    {
        // COUNT(*) avec WHERE = compte seulement les lignes qui matchent
        // Si l'ID existe : COUNT retourne 1
        // Si l'ID n'existe pas : COUNT retourne 0
        $sql = "SELECT COUNT(*) FROM personnage WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        // fetchColumn() récupère le nombre
        // > 0 convertit en booléen : 1 = true, 0 = false
        return (int)$stmt->fetchColumn() > 0;
    }
}

/*
 ========================================
 📚 RÉSUMÉ DES CONCEPTS UTILISÉS :
 ========================================
 
 🔗 PDO (PHP Data Objects) :
 - Interface standardisée pour accéder aux bases de données
 - Fonctionne avec MySQL, PostgreSQL, SQLite, etc.
 
 🛡️ REQUÊTES PRÉPARÉES :
 - prepare() + execute() = protection contre injection SQL
 - Les ? sont remplacés de manière sécurisée
 
 📊 MÉTHODES PDO :
 - query() : pour requêtes sans paramètres (SELECT simple)
 - prepare() : pour requêtes avec paramètres (sécurité)
 - fetch() : récupère UNE ligne
 - fetchAll() : récupère TOUTES les lignes
 - fetchColumn() : récupère UNE valeur
 
 🎯 CRUD COMPLET :
 - CREATE : INSERT INTO avec VALUES
 - READ : SELECT avec ou sans WHERE
 - UPDATE : UPDATE avec SET et WHERE
 - DELETE : DELETE avec WHERE (important !)
 
 ⚡ BONNES PRATIQUES :
 - Toujours utiliser WHERE dans UPDATE/DELETE
 - Utiliser les types de retour (array, bool, int)
 - Commenter le code pour la compréhension
 - Centraliser les accès base dans un Repository
 */
