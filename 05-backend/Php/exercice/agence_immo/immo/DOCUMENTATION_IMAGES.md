# 📚 DOCUMENTATION - SYSTÈME DE GESTION D'IMAGES

## 🎯 OBJECTIF

Comprendre comment résoudre le problème de modification d'images dans une application web PHP avec architecture MVC.

## ⚠️ PROBLÈME INITIAL

**Symptôme** : Les images ne se modifiaient pas quand on cliquait sur les boutons.
**Erreur** : "Cannot modify header information - headers already sent"

## 🔍 ANALYSE DU PROBLÈME

### 1. Actions manquantes

```php
// AVANT : Dans index.php, ces actions n'existaient pas
case 'changer_image_principale':  // ❌ Manquant
case 'promouvoir_image':         // ❌ Manquant
case 'supprimer_image':          // ❌ Manquant
case 'ajouter_image_secondaire': // ❌ Manquant
```

### 2. Problème de headers HTTP

```php
// PROBLÈME : HTML envoyé AVANT la redirection
include_once 'Vue/vueHeader.php';  // ← Envoie du HTML
// ...
header('Location: ...');           // ← ERREUR ! Headers déjà envoyés
```

### 3. Erreur SQL

```sql
-- AVANT (incorrect)
WHERE id_bien = :idBien  -- ❌ Colonne inexistante

-- APRÈS (correct)
WHERE id = :idBien       -- ✅ Bon nom de colonne
```

## 🛠️ SOLUTIONS APPLIQUÉES

### 1. Architecture de routage améliorée

```php
// PRINCIPE : Séparer les actions avec redirection des actions avec affichage

// ÉTAPE 1 : Traiter les redirections AVANT tout HTML
$actionsAvecRedirection = ['changer_image_principale', ...];
if (in_array($action, $actionsAvecRedirection)) {
    // Traitement + redirection
    header('Location: ...');
    exit;
}

// ÉTAPE 2 : Seulement APRÈS, inclure les vues HTML
include_once 'Vue/vueHeader.php';
```

### 2. Gestion des fichiers d'images

```php
// PRINCIPE : Gérer à la fois la base de données ET les fichiers physiques

public function supprimerImage($idBien, $idImage) {
    // 1. Récupérer le chemin avant suppression
    $image = $this->imgRepo->getImageById($idImage);

    // 2. Supprimer de la base de données
    if ($this->imgRepo->deleteImage($idImage)) {
        // 3. Supprimer le fichier physique
        if ($image && file_exists($image['chemin_image'])) {
            unlink($image['chemin_image']);
        }
    }
}
```

### 3. Transactions pour cohérence des données

```php
// PRINCIPE : Tout ou rien (éviter les données incohérentes)

public function deleteImage(int $idImage): bool {
    try {
        $this->db->beginTransaction();

        // 1. Supprimer l'association
        $this->db->prepare("DELETE FROM association_img WHERE id_image = ?")
                 ->execute([$idImage]);

        // 2. Supprimer l'image
        $this->db->prepare("DELETE FROM images WHERE id_image = ?")
                 ->execute([$idImage]);

        $this->db->commit();
        return true;
    } catch (Exception $e) {
        $this->db->rollBack();
        return false;
    }
}
```

## 📊 STRUCTURE DE LA BASE DE DONNÉES

```sql
-- Table des images
CREATE TABLE images (
    id_image INT PRIMARY KEY AUTO_INCREMENT,
    titre_image VARCHAR(250),
    chemin_image VARCHAR(300),
    texte_alternatif VARCHAR(250),
    extension VARCHAR(5)
);

-- Table d'association (relation N-N)
CREATE TABLE association_img (
    id INT,              -- FK vers biens_immobiliers.id
    id_image INT,        -- FK vers images.id_image
    img_ppal TINYINT,    -- 0=secondaire, 1=principale
    PRIMARY KEY (id, id_image)
);
```

## 🔄 FLUX DE DONNÉES

### Ajouter une image principale :

1. **Upload** → Valider le fichier
2. **Stockage** → Déplacer vers dossier public/img_immo/
3. **Base** → Insérer dans table `images`
4. **Association** → Mettre toutes les autres en secondaires
5. **Association** → Créer nouvelle association avec img_ppal=1
6. **Retour** → Rediriger avec message de succès

### Promouvoir une image :

1. **Réinitialiser** → Mettre toutes les images en secondaires (img_ppal=0)
2. **Promouvoir** → Mettre l'image choisie en principale (img_ppal=1)
3. **Retour** → Rediriger avec message de succès

## 🎨 INTERFACE UTILISATEUR

### Formulaires avec auto-submit :

```html
<form method="post" enctype="multipart/form-data">
    <input
        type="file"
        name="image"
        style="display:none;"
        onchange="this.form.submit()"
    />
    <label for="image">Choisir une image</label>
</form>
```

### Confirmations JavaScript :

```html
<form onsubmit="return confirm('Êtes-vous sûr ?')">
    <button type="submit">Supprimer</button>
</form>
```

## 🔒 SÉCURITÉ

### Validation des fichiers :

```php
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
if (!in_array($file['type'], $allowedTypes)) {
    throw new Exception("Type de fichier non autorisé");
}
```

### Noms de fichiers uniques :

```php
$newName = 'photo' . uniqid() . '.' . $extension;
// Exemple : photo507f1f77bcf86cd799439011.jpg
```

### Contrôle d'accès :

```php
if (!isset($_SESSION['user']) || $_SESSION['user']['id_niveau'] != 1) {
    header('Location: index.php?action=connexion');
    exit;
}
```

## 🎯 CONCEPTS CLÉS À RETENIR

1. **Ordre d'exécution** : Redirections AVANT affichage HTML
2. **Buffer de sortie** : `ob_start()` pour éviter les conflits de headers
3. **Transactions** : Cohérence des données en cas d'erreur
4. **Validation** : Toujours vérifier les données utilisateur
5. **Sécurité** : Contrôle d'accès et validation des fichiers
6. **UX** : Messages de feedback et confirmations

## 🚀 POUR ALLER PLUS LOIN

-   **AJAX** : Éviter les rechargements de page
-   **Resize automatique** : Optimiser les images uploadées
-   **Validation côté client** : JavaScript pour UX immédiate
-   **Logging** : Tracer les actions pour debugging
-   **Tests** : Vérifier le bon fonctionnement

---

_Cette documentation vous aidera à reproduire et améliorer ce système dans vos futurs projets !_ 🎓
