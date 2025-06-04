<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement des patients</title>
    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="csspatient.css">
    
</head>

<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <header>
        <nav class="navbar navbar-expand-lg navbar-light" id="nav">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.html">Acceuil</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
  
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="affichage_medecin.php"><b>Médecin</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="affichage_patient.php"><b>Patient</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="affichageconsultation.php"><b>Consultation</b></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <b>Effectuer un engregistrement</b>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="formulairemedecin.php"><b>Enregistrer un médecin</b></a></li>
            <li><a class="dropdown-item" href="formulairepatient.php"><b>Eregistrer un patient</b></a></li>
            <li><a class="dropdown-item" href="formulaireenregistrer_consultation.php"><b>Enregistrer une consultation</b></a></li>
            <li><a class="dropdown-item" href="formulairepourprescription.php"><b>Enregistrer des prescription</b></a></li>
          </ul>
        </li>



        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <b>Filtrage</b>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="formulairespecialite.php"><b>Spécialité</b></a></li>
            <li><a class="dropdown-item" href="formulairelisterconsultation.php"><b>Consultation/Patient</b></a></li>
            <li><a class="dropdown-item" href="formulairetrouverpatient1.php"><b>Trouver Patient</b></a></li>
            <li><a class="dropdown-item" href="formulaireverifier.php"><b>Vérification/Consultation</b></a></li>
          </ul>
        </li>
        
        <li><img src="img.png" width="40px" style="margin-left: 780px"></li>
      </ul>
    </div>
  </div>
</nav>
        </header><br><br><div class="container">
        <form action="dossier_patient.php" method="post">
            <fieldset>
                <div class="form-group row">
                    <label for="code" class="col-sm-2 col-form-label">Code :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="code" name="code" placeholder="Ex: 001" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nom" class="col-sm-2 col-form-label">Nom :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Ex: Dupont" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="prenom" class="col-sm-2 col-form-label">Prénom :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Sexe :</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sexe" id="homme" value="Homme" checked>
                            <label class="form-check-label" for="homme">Homme</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sexe" id="femme" value="Femme">
                            <label class="form-check-label" for="femme">Femme</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tel" class="col-sm-2 col-form-label">Téléphone :</label>
                    <div class="col-sm-10">
                        <input type="tel" class="form-control" id="tel" name="tel" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="adresse" class="col-sm-2 col-form-label">Adresse :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="adresse" name="adresse" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="date_enregistrement" class="col-sm-2 col-form-label">Date d'enregistrement :</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="date_enregistrement" name="date_enregistrement" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn bg-info">Enregistrer</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>