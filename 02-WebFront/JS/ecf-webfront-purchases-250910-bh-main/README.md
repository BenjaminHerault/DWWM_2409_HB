# ecf-webfront-purchases

![Logo CRM](./www/img/logo-centre-de-readaptation-de-mulhouse-colors.svg)

1. Forker le dépôt sur votre compte Github
    - Lors du fork , ajoutez la date de l'évaluation et vos initiales au nom du dépôt
    - Format attendu : `ecf-webfront-purchases-MD-2025-07-31`
2. Cloner votre Fork sur votre machine locale
2. Lire les consignes du fichier **README.md**
3. Effectuer les tâches demandées
4. Pousser votre travail sur Github
5. Transmettez le lien de votre dépôt à l'évaluateur


# Formulaire de demande d'achats

**Objectif :** Créer un formulaire de demande d'achats d'une entreprise en utilisant HTML pour la structure et CSS pour le style. Vous devrez respecter les couleurs imposées et concevoir une mise en page sobre et moderne.

### 

# 1. Fichiers Fournis
- **Un fichier HTML (www/purchases.html)**. Il contient la structure de base de la page à implémenter.
    - Le `<header>` et le `<footer>` ne doivent pas être modifiés
    - Le logo est stocké dans le répertoire `img`
- **Un fichier CSS (www/css/purchases.css)**. Il contient les couleurs à utiliser pour votre formulaire. Vous ne devez pas modifier les valeurs de ces couleurs dans ce fichier.
    - Renseignez votre Nom et Prénom à l'endroit approprié
    - Utilisez uniquement les couleurs définies dans les variables (aucune autre couleur acceptée).
    - Utilisez **obligatoirement** les 2 couleurs : `--crm-primary` et `--crm-secondary`.
    - Les autres couleurs sont optionnelles mais recommandées pour une meilleure expérience utilisateur.

> Aucun des fichiers fournis ne doit être renommé 

# 2. Contenu du Formulaire

Votre formulaire doit inclure les champs suivants pour une demande d'achat :

### Informations de l'émetteur de la demande :

- Nom, prénom
- Adresse e-mail
- Service (liste déroulante `<select>` dont les options sont: `Comptabilité`, `Ressources humaines`, `Service informatique`)

### Détails de l'article demandé :

- Nom de l'article
- Description de l'article (champ multi-lignes `<textarea>`)
- Quantité (min: 1, max: 1000)
- Prix unitaire arrondi à l'Euro supérieur
- Date de livraison souhaitée

### Justification de la demande :

- Champ multi-lignes pour expliquer la nécessité de l'achat.

## Boutons :

- Un bouton de soumission ("Envoyer la demande")
- Un bouton pour réinitialiser le formulaire ("Annuler")

# Mise en page du formulaire 

- `<header>`
    - Largeur: 100%
    - Logo et Titre H1 alignés (logo à gauche du titre ou inversement)
- `<main>`
    - Largeur: 1200px
    - Largeur max: 100%
    - Centré sur la page
- `<footer>`
    - Largeur: 1200px
    - Largeur max: 100%
    - Titre H2 centré
    - Texte justifié

# 4. Recommandations HTML / CSS

Commencez par structurer la page HTML avant de passer à la mise en forme CSS.

Testez régulièrement votre formulaire dans un navigateur pour voir le rendu.

Concentrez-vous sur la fonctionnalité et la clarté avant l'esthétique "extraordinaire".

Durant l'examen, l'évaluateur peut vous accompagner pour les opérations GIT.

---

# 5. Contrôles de saisies

Ajoutez quelques fonctionnalités au formulaire en utilisant JavaScript (avec  ou sans framework, à votre guise).

### Ajouter un évènement lorsque le formulaire est soumis: 

1. Annuler le comportement par défaut avec `preventDefault()`
2. Vérifier que le nom et prénom contiennent au moins 3 caractères
3. Vérifier que la date de livraison est au moins 8 jours dans le futur
4. Calculer le montant total de la commande et l'afficher sous le formulaire dans une balise `<aside>`
5. Si le montant de la commande est supérieur à 1000€, afficher le message "*[NOM PRENOM], Votre demande a été transmise au service financier pour validation*", Sinon afficher "*Merci [NOM PRENOM], votre demande a été transmise au service des achats*"

En cas d'erreur, afficher un message approprié sous le formulaire. Ce message doit aparaître avec la couleur `--crm-alert` (couleur de texte OU couleur d'arrière plan, au choix).

# 6. Critères de Réalisation et d'évaluation

Votre travail sera évalué sur les navigateurs *Google Chrome* et *Mozilla Firefox*. Les points suivants seront particulièrement étudiés :

### Structure HTML sémantique :

- Utilisation appropriée des balises HTML (ex: `<form>`, `<label>`, `<input>`, `<textarea>`, `<fieldset>`, `<legend>`, etc...).

- Chaque champ de formulaire est obligatoire et doit être associé à son libellé via les attributs `for` et `id`.

- Types d'inputs pertinents :
    - Choisissez le type d'input HTML le plus adapté à chaque champ (text, email, number, date, textarea, submit, reset...).

- Intégration du CSS fourni :
    - Assurez-vous d'inclure correctement le fichier CSS fourni dans votre document HTML.
    - Appliquez les couleurs définies dans le fichier CSS à votre formulaire et à ses éléments.

- Mise en page sobre et moderne :
    - Bien qu'aucune maquette ne soit imposée, la présentation doit être claire, aérée et intuitive.

Recherchez une esthétique épurée : alignement cohérent des éléments, espacement suffisant entre les champs, tailles de police lisibles.

Évitez les éléments décoratifs superflus ou les mises en page trop complexes. L'objectif est la simplicité et l'efficacité.
