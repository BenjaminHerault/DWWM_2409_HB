<!-- Vue de gestion des images d'un bien immobilier -->
<link rel="stylesheet" href="public/css/biens.css">
<div class="container mt-4">
    <h2 class="mb-4 text-center">Gestion des images du bien "<?= htmlspecialchars($bien['titre']) ?>"</h2>

    <!-- Image principale -->
    <div class="text-center mb-4">
        <div style="display:inline-block; position:relative;">
            <img src="<?= htmlspecialchars($imagePrincipale['chemin_image'] ?? 'public/img_immo/image_defaut.jpg') ?>" alt="Image principale" style="width:200px; height:200px; object-fit:cover; border-radius:16px; border:3px solid #007bff;">
            <form action="index.php?action=changer_image_principale&id_bien=<?= $bien['id'] ?>" method="post" enctype="multipart/form-data" style="margin-top:10px;">
                <label for="nouvelle_image_principale" class="btn btn-outline-primary btn-sm mb-2">Remplacer l'image principale</label>
                <input type="file" name="nouvelle_image_principale" id="nouvelle_image_principale" style="display:none;" onchange="this.form.submit()">
            </form>
        </div>
    </div>

    <!-- Images secondaires -->
    <div class="mb-4">
        <h5>Images secondaires</h5>
        <div style="display:flex; gap:16px; flex-wrap:wrap; align-items:center;">
            <?php foreach ($imagesSecondaires as $img): ?>
                <div style="position:relative; display:inline-block;">
                    <img src="<?= htmlspecialchars($img['chemin_image']) ?>" alt="Image secondaire" style="width:90px; height:90px; object-fit:cover; border-radius:10px; border:2px solid #ccc;">
                    <form action="index.php?action=promouvoir_image&id_bien=<?= $bien['id'] ?>&id_image=<?= $img['id_image'] ?>" method="post" style="position:absolute; top:4px; left:4px;">
                        <button type="submit" class="btn btn-success btn-sm" title="Définir comme principale">★</button>
                    </form>
                    <form action="index.php?action=supprimer_image&id_bien=<?= $bien['id'] ?>&id_image=<?= $img['id_image'] ?>" method="post" style="position:absolute; top:4px; right:4px;">
                        <button type="submit" class="btn btn-danger btn-sm" title="Supprimer">✖</button>
                    </form>
                </div>
            <?php endforeach; ?>
            <!-- Ajout d'une nouvelle image secondaire -->
            <form action="index.php?action=ajouter_image_secondaire&id_bien=<?= $bien['id'] ?>" method="post" enctype="multipart/form-data" style="display:inline-block;">
                <label for="ajout_image_secondaire" style="cursor:pointer; display:flex; align-items:center; justify-content:center; width:90px; height:90px; border:2px dashed #007bff; border-radius:10px; font-size:2.5rem; color:#007bff; background:#f8f9fa;">
                    +
                </label>
                <input type="file" name="ajout_image_secondaire" id="ajout_image_secondaire" style="display:none;" onchange="this.form.submit()">
            </form>
        </div>
    </div>

    <a href="index.php?action=admin" class="btn btn-secondary">Retour à l'espace admin</a>
</div>