<link rel="stylesheet" href="public/css/style.css">
<div class="container">
  <div class="panel panel-primary">
    <div class="panel-body">
      <h3 class="text-on-pannel text-primary">
        <strong class="text-uppercase">Accès gestion</strong>
      </h3>

      <form id="verif" name="verif" action="index.php?action=admin" method="post">

        <p class="form-center">
          <label class="form-label" for="identifiant">Email</label>
          <input class="form-control" id="identifiant" name="identifiant" value="" type="text">
        </p>

        <p class="form-center">
          <label class="form-label" for="pwd">Mot de passe :</label>
          <input class="form-control" type="password" id="pwd" name="pwd" value="">
        </p>

        <p class="form-center-full">
          <input type="submit" class="btn btn-primary btn-center" id="validation" name="validation" value="Valider">
        </p>

      </form>
    </div>
  </div>
</div>