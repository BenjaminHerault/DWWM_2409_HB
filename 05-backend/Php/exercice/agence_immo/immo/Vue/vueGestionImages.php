<!-- Vue de gestion des images d'un bien immobilier -->
<link rel="stylesheet" href="public/css/biens.css">
<link rel="stylesheet" href="public/css/gestion-images.css">

<div class="container gestion-images-container">
    <h2 class="gestion-images-title">Gestion des images du bien "<?= htmlspecialchars($bien['titre']) ?>"</h2>

    <!-- Messages de succès/erreur -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($_SESSION['success']) ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($_SESSION['error']) ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <!-- Image principale -->
    <div class="image-principale-section">
        <div class="image-principale-wrapper">
            <img src="<?= htmlspecialchars($imagePrincipale['chemin_image'] ?? 'public/img_immo/image_defaut.jpg') ?>"
                alt="Image principale"
                class="image-principale">
            <form action="index.php?action=changer_image_principale&id_bien=<?= $bien['id'] ?>"
                method="post"
                enctype="multipart/form-data"
                class="form-changer-principale">
                <label for="nouvelle_image_principale" class="btn btn-outline-primary btn-sm mb-2">
                    Remplacer l'image principale
                </label>
                <input type="file"
                    name="nouvelle_image_principale"
                    id="nouvelle_image_principale"
                    class="input-file-cache"
                    onchange="this.form.submit()">
            </form>
        </div>
    </div>

    <!-- Images secondaires -->
    <div class="images-secondaires-section">
        <h5 class="images-secondaires-title">Images secondaires</h5>
        <div class="images-secondaires-container">
            <?php foreach ($imagesSecondaires as $img): ?>
                <div class="image-secondaire-wrapper">
                    <img src="<?= htmlspecialchars($img['chemin_image']) ?>"
                        alt="Image secondaire"
                        class="image-secondaire">

                    <!-- Bouton promouvoir -->
                    <form action="index.php?action=promouvoir_image&id_bien=<?= $bien['id'] ?>&id_image=<?= $img['id_image'] ?>"
                        method="post"
                        class="btn-promouvoir">
                        <button type="submit" class="btn btn-success btn-sm" title="Définir comme principale">★</button>
                    </form>

                    <!-- Bouton supprimer -->
                    <form action="index.php?action=supprimer_image&id_bien=<?= $bien['id'] ?>&id_image=<?= $img['id_image'] ?>"
                        method="post"
                        class="btn-supprimer"
                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette image ?');">
                        <button type="submit" class="btn btn-danger btn-sm" title="Supprimer">✖</button>
                    </form>
                </div>
            <?php endforeach; ?>

            <!-- Ajout d'une nouvelle image secondaire -->
            <form action="index.php?action=ajouter_image_secondaire&id_bien=<?= $bien['id'] ?>"
                method="post"
                enctype="multipart/form-data"
                class="form-ajouter-image">
                <label for="ajout_image_secondaire" class="zone-ajout-image">
                    +
                </label>
                <input type="file"
                    name="ajout_image_secondaire"
                    id="ajout_image_secondaire"
                    class="input-file-cache"
                    onchange="this.form.submit()">
            </form>
        </div>
    </div>

    <a href="index.php?action=admin" class="btn btn-secondary btn-retour">Retour à l'espace admin</a>
</div>