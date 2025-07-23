<link rel="stylesheet" href="public/css/style.css">
<div class="container">
  <div class="panel panel-primary">
    <div class="panel-body">
      <h3 class="text-on-pannel text-primary">
        <strong class="text-uppercase">Accès gestion</strong>
      </h3>

      <form id="verif" name="verif" action="index.php?action=connexion" method="post">

        <p class="form-center">
          <label for="mail" class="form-label">Email</label>
          <input type="email" class="form-control" id="mail" name="mail" placeholder="Votre mail">
        </p>

        <p class="form-center">
          <label for="pwd" class="form-label">Mot de passe :</label>
          <input type="password" id="pwd" class="form-control" name="pwd" placeholder="Votre mot de passe">
        </p>

        <p class="form-center-full">
          <button type="submit" class="btn btn-primary btn-center" id="validation" name="validation" value="Valider">Valider</button>
        </p>

      </form>
    </div>
  </div>
</div>