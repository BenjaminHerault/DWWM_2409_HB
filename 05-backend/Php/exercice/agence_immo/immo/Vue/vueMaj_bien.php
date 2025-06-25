<form action="index.php?action=modifier&id_bien=<?= $id ?>" method="POST" name="maj">
    <label for="img">
        Ajouter une image au logement
    </label>
    <input type="file" name="img" id="img">
    <input type="submit" value="modifier" name="maj" id="maj">


</form>